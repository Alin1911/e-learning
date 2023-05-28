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
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
	public function index(Request $request)
	{
		$segmentLength = 3;
		$perPage = 12;
		if (! empty($request->input('search', ''))) {
			$search = $request->input('search');
		} else {
			$courses = Course::paginate($perPage);
			return view('course.index')->with('courses', $courses);
		}
		try {
			$searchTerm = $search;

			$results = DB::table('course_meta_tags')
				->select('course_id')
				->whereRaw("MATCH (title, description, keywords, language, author, duration, level) AGAINST (? IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION)", [$searchTerm])
				->get()->toArray();

			if (count($results) >= $perPage) {
				$results = DB::table('course_meta_tags')
					->select('course_id')
					->whereRaw("MATCH (title, description, keywords, language, author, duration, level) AGAINST (? IN NATURAL LANGUAGE MODE)", [$searchTerm])
					->get()->toArray();
			}
			array_column($results, 'course_id');
			$results = CourseMetaTag::countSegmentOccurrences($request->input('search', ''), $segmentLength);
			$courses = Course::whereIn('id', $results)->paginate($perPage);
		} catch (\Exception $e) {
			$courses = Course::search($search)->paginate(10);
		} finally {
			if(!isset($courses) || $courses->total() == 0) {
				$courses = Course::search($search)->paginate(10);
			}
		}

		if ($request->has('nivel')) {
			$courses = $courses->where('level', $request->nivel);
		}

		$exercise = Exercise::where('question', 'like', '%' . $search . '%')
			->orWhere('exercise_type', 'like', '%' . $search . '%')
			->where('public', 1)
			->paginate(10);

		$forums = Forum::where('title', 'like', '%' . $search . '%')
			->orWhere('description', 'like', '%' . $search . '%')
			->paginate(10);

		return view('course.index')->with(['courses' => $courses, 'exercises' => $exercise, 'forums' => $forums, 'search' => $search]);
	}

	public function create()
	{
		$user = Auth::user();
		$courses = $user->courses;
		$categories = Category::all();

		return view('course.create')->with('categories', $categories)->with('courses', $courses);
	}

	public function store(Request $request)
	{
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
		$course->instructor_id = 1;
		$course->language = $request->get('language', 'english');
		$course->points = $request->get('points', '0');
		if ($request->has('image')) {
			$path = $request->file('image')->store('public/courses');
			$course->image = asset('storage/' . substr($path, 7));
		} else {
			$course->image = asset('storage/images/2.png');
		}
		$course->save();
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

		$metaTag->save();

		$forum = new Forum();
		$forum->title = $course->title;
		$forum->description = $course->description;
		$forum->course_id = $course->id;
		$forum->save();
		$topic = new ForumTopic();
		$topic->title = $course->title;
		$topic->forum_id = $forum->id;
		$topic->save();

		return $course->id;
	}

	public function show(Request $request, $id)
	{
		$course = Course::find($id);
		if (empty($course)) {
			return redirect()->route('course.index');
		}
		$course->load('forum', 'category', 'lessons', 'lessons.tests', 'tests', 'questions', 'instructor', 'metaTag', 'exercises');
		if(!Auth::check()) {
			return view('course.show')->with(['course' => $course]);
		}
		$userId = Auth::user()->id;
		$completedLessons = $course->completedLessonsForUser($userId);
		if ($request->wantsJson()) {
			return json_encode(['course' => $course, 'completedLessons' => $completedLessons]);
		}
		return view('course.show')->with(['course' => $course, 'completedLessons' => $completedLessons]);
	}

	public function edit($id)
	{
		$course = Course::find($id);
		if (empty($course)) {
			return redirect()->route('course.index');
		}
		$categories = Category::all();
		$user = Auth::user();
		$courses = $user->courses;
		return view('course.edit', compact('course', 'categories', 'courses'));
	}

	public function update(Request $request)
	{
		$course = Course::find($request->id);
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
		if ($request->has('instructor_id')) {
			$course->instructor_id = $request->instructor_id;
		}
		if ($request->has('language')) {
			$course->language = $request->language;
		}
		if ($request->has('points')) {
			$course->points = $request->points;
		}

		$course->save();

		return $course->id;

	}

	public function destroy($id)
	{
		$course = Course::find($id);
		$course->delete();
		return redirect()->route('course.index');
	}
	public function enroll($id)
	{
		if (! auth()->check()) {
			abort(401, 'Unauthorized action.');
		}

		$course = Course::find($id);
		$user = auth()->user();

		// Verificați dacă utilizatorul este deja înscris la curs
		if ($user->learningCourses->contains($course->id)) {
			// Returnați un mesaj de eroare sau redirecționați către o pagină de eroare
			return response()->json(['message' => 'User is already enrolled in this course'], 400);
		}

		$user->learningCourses()->attach($course, ['enrollment_date' => now()]);
		return $course->id;
	}
	public function learnCourse($id, Request $request)
	{
		$course = Course::find($id);
		$course->load('lessons');
		$course->load('tests');
		$course->load('questions');
		$course->load('category');
		$course->load('forum');
		$course->load('instructor', 'forum');
		return view('course.learn')->with(['course' => $course, 'forum' => $course->forum]);
	}

	public function courses()
	{
		$user = auth()->user();
		$user->load('courses', 'courses.lessons', 'courses.exercises', 'courses.tests', 'courses.questions');
		$courses = $user->courses;
		return json_encode($courses);
	}
}
