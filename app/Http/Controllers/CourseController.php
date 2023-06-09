<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\CourseMetaTag;
use App\Models\Exercise;
use App\Models\Forum;
use App\Models\ForumTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
	/**
	 * Display a listing of the courses.
	 *
	 * @param  Request  $request
	 * @return \Illuminate\Contracts\View\View
	 */
	public function index(Request $request)
	{
		// Set default values
		$segmentLength = 3;
		$perPage = 12;

		// Check if search input is provided
		if (!empty($request->input('search', ''))) {
			$search = $request->input('search');
		} else {
			// Fetch all courses and return the view
			$courses = Course::paginate($perPage);
			return view('course.index')->with('courses', $courses);
		}

		// Search for courses based on the provided search input
		$results = CourseMetaTag::countSegmentOccurrences($search, $segmentLength);
		$courses = Course::whereIn('id', $results)->paginate($perPage);

		// Filter courses by level if 'nivel' parameter is present
		if ($request->has('nivel')) {
			$courses = $courses->where('level', $request->nivel);
		}


		// Return the view with the search results
		return view('course.index')->with([
			'courses' => $courses,
			'search' => $search
		]);
	}

	/**
	 * Show the form for creating a new course.
	 *
	 * @return \Illuminate\Contracts\View\View
	 */
	public function create()
	{
		// Fetch user, user's courses, and all categories
		$user = Auth::user();
		$courses = $user->courses;
		$categories = Category::all();

		// Return the view with the necessary data
		return view('course.create')->with([
			'categories' => $categories,
			'courses' => $courses
		]);
	}

	/**
	 * Store a newly created course in storage.
	 *
	 * @param  Request  $request
	 * @return int
	 */
	public function store(Request $request)
	{
		// Create a new course instance and set its properties
		$course = new Course();
		$user = Auth::user();
		$course->user_id = $user->id;
		$course->title = $request->get('title', '');
		$course->description = $request->get('description', '');
		$course->category_id = $request->get('category_id', '');
		$course->price = $request->get('price', '0');
		$course->level = $request->get('level', 'beginner');
		$course->duration = $request->get('duration', 'anytime');
		$course->discount = $request->get('discount', '0');
		$course->additional_info = $request->get('additional_info', '');
		$course->language = $request->get('language', 'english');
		$course->points = $request->get('points', '0');

		// Check if an image is uploaded
		if ($request->has('image')) {
			$path = $request->file('image')->store('public/courses');
			$course->image = asset('storage/' . substr($path, 7));
		} else {
			$course->image = asset('storage/images/2.png');
		}

		// Save the course to the database
		$course->save();

		// Create a new CourseMetaTag instance and set its properties
		$metaTag = new CourseMetaTag();
		$metaTag->course_id = $course->id;
		$metaTag->title = $course->title;
		$metaTag->description = $course->description;
		$metaTag->price = $course->price;
		$metaTag->keywords = implode(', ', array_slice(explode(' ', $course->description), 0, 10));
		$metaTag->language = $course->language;
		$metaTag->author = $user->name;
		$metaTag->publish_date = date('Y-m-d');
		$metaTag->duration = $course->duration;
		$metaTag->level = $course->level;

		// Save the meta tag to the database
		$metaTag->save();

		// Create a new forum and topic for the course
		$forum = new Forum();
		$forum->title = $course->title;
		$forum->description = $course->description;
		$forum->course_id = $course->id;
		$forum->save();
		$topic = new ForumTopic();
		$topic->title = $course->title;
		$topic->forum_id = $forum->id;
		$topic->save();

		// Return the ID of the created course
		return $course->id;
	}

	/**
	 * Display the specified course.
	 *
	 * @param  Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Contracts\View\View|string
	 */
	public function show(Request $request, $id)
	{
		// Find the specified course
		$course = Course::find($id);

		// Return 404 error if course is not found
		if (empty($course)) {
			abort(404);
		}

		// Load relationships for the course
		$course->load('forum', 'category', 'lessons', 'lessons.tests', 'tests', 'metaTag', 'exercises');

		// Check if user is authenticated
		if (!Auth::check()) {
			return view('course.show')->with([
				'course' => $course
			]);
		}

		// Retrieve user ID and completed lessons/tests for the course
		$userId = Auth::user()->id;
		$completedLessons = $course->completedLessonsForUser($userId)->pluck('id')->toArray();
		$completedTests = $course->completedTestsForUser($userId)->pluck('id')->toArray();

		// Calculate total points, user points, and minimal points for the course
		$course->totalPoints = $course->totalPoints();
		$course->userPoints = $course->getUserPoints();
		$course->minimalPoints = $course->minimalPoints();

		// Return JSON response if requested
		if ($request->wantsJson()) {
			return json_encode([
				'course' => $course,
				'completedLessons' => $completedLessons,
				'completedTests' => $completedTests,
			]);
		}

		// Return the view with the necessary data
		return view('course.show')->with([
			'course' => $course,
			'completedLessons' => $completedLessons,
			'completedTests' => $completedTests
		]);
	}

	/**
	 * Show the form for editing the specified course.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function edit($id)
	{
		// Find the specified course
		$course = Course::find($id);

		// Redirect to course index if course is not found
		if (empty($course)) {
			return redirect()->route('course.index');
		}

		// Retrieve all categories and user's courses
		$categories = Category::all();
		$user = Auth::user();
		$courses = $user->courses;

		// Return the view with the necessary data
		return view('course.edit')->with([
			'course' => $course,
			'categories' => $categories,
			'courses' => $courses
		]);
	}

	/**
	 * Update the specified course in storage.
	 *
	 * @param  Request  $request
	 * @return int
	 */
	public function update(Request $request)
	{
		// Find the specified course
		$course = Course::find($request->id);

		// Update the course properties if provided
		if ($request->has('title')) {
			$course->title = $request->title;
		}
		if ($request->has('description')) {
			$course->description = $request->description;
		}
		if ($request->has('category_id')) {
			$course->category_id = $request->category_id;
		}
		if ($request->has('price')) {
			$course->price = $request->price;
		}
		if ($request->has('level')) {
			$course->level = $request->level;
		}
		if ($request->has('duration')) {
			$course->duration = $request->duration;
		}
		if ($request->has('discount')) {
			$course->discount = $request->discount;
		}
		if ($request->has('additional_info')) {
			$course->additional_info = $request->additional_info;
		}
		if ($request->has('language')) {
			$course->language = $request->language;
		}
		if ($request->has('points')) {
			$course->points = $request->points;
		}

		// Save the updated course to the database
		$course->save();

		// Return the ID of the updated course
		return $course->id;
	}

	/**
	 * Remove the specified course from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy($id)
	{
		// Find the specified course
		$course = Course::find($id);

		// Delete the course
		$course->delete();

		// Redirect to course index
		return redirect()->route('course.index');
	}

	/**
	 * Enroll the user in the specified course.
	 *
	 * @param  int  $id
	 * @return int|\Illuminate\Http\JsonResponse
	 */
	public function enroll($id)
	{
		// Check if user is authenticated
		if (!auth()->check()) {
			abort(401, 'Unauthorized action.');
		}

		// Find the specified course
		$course = Course::find($id);
		$user = auth()->user();

		// Check if user is already enrolled in the course
		if ($user->learningCourses->contains($course->id)) {
			return response()->json(['message' => 'User is already enrolled in this course'], 400);
		}

		// Attach the course to the user with the enrollment date
		$user->learningCourses()->attach($course, ['enrollment_date' => now()]);

		// Return the ID of the enrolled course
		return $course->id;
	}

	/**
	 * Display the specified course for learning.
	 *
	 * @param  int  $id
	 * @param  Request  $request
	 * @return \Illuminate\Contracts\View\View
	 */
	public function learnCourse($id, Request $request)
	{
		// Find the specified course and load its relationships
		$course = Course::find($id);
		$course->load('lessons');
		$course->load('tests');
		$course->load('category');
		$course->load('forum');

		// Return the view with the necessary data
		return view('course.learn')->with([
			'course' => $course,
			'forum' => $course->forum
		]);
	}

	/**
	 * Get the courses for the authenticated user.
	 *
	 * @return string
	 */
	public function courses()
	{
		// Retrieve the authenticated user and load their courses and related models
		$user = auth()->user();
		$user->load('courses', 'courses.lessons', 'courses.exercises', 'courses.tests');
		$courses = $user->courses;

		// Return the courses as JSON
		return json_encode($courses);
	}
}
