<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		$user = Auth::user();
		$course_id = $request->input('course_id');
		$course = $user->courses->find($course_id);
		$lessons = $course->lessons;
		return view('lesson.index')->with(['course' => $course, 'lessons' => $lessons, 'user' => $user]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$user = Auth::user();
		$courses = $user->courses;
		$courses->load('lessons', 'lessons.tests', 'lessons.user');

		return view('lesson.create', compact('courses'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$request->validate([
			'course_id' => 'required',
			'title' => 'required',
			'description' => 'required',
		]);
		$lesson = new Lesson();
		if ($request->has('course_id')) {
			$lesson->course_id = $request->input('course_id');
		}
		if ($request->has('title')) {
			$lesson->title = $request->input('title');
		}
		if ($request->has('description')) {
			$lesson->description = $request->input('description');
		}
		if($request->has('content')) {
			$lesson->content = $request->input('content');
		}
		if($request->has('argumente')) {
			$lesson->argumente = $request->input('argumente');
		}
		if($request->has('duration')) {
			$lesson->duration = $request->input('duration');
		}
		if($request->has('is_published')) {
			$lesson->is_published = $request->input('is_published') ? 1 : 0;
		}
		if($request->has('order')) {
			$lesson->order = $request->input('order');
		}
		if(isset($request->video)) {
			if(isset($lesson->video_url)) {
				$video = substr($lesson->video_url, 22);
				Storage::disk('public')->delete($video);
			}
			$video = $request->file('video')->store('lessons/videos', 'public');
			$lesson->video_url = asset('storage/' . $video);
		}
		$user = Auth::user();
		if($user->id != $lesson->course->user_id) {
			$lesson->user_id = $user->id;
			if($request->has('argumente')) {
				$lesson->argumente = $request->input('argumente');
			}
		}
		$lesson->order = Lesson::where('course_id', $lesson->course_id)->count() + 1;
		$lesson->is_published = 0;
		$lesson->save();
		$lessons = Lesson::where('course_id', $lesson->course_id)->get();
		if($user->id != $lesson->course->user_id) {
			return redirect()->back();
		}
		return response()->json($lessons, 200);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		$lesson = Lesson::findOrFail($id);
		$user = Auth::user();
		$course = $user->courses->find($lesson->course_id);
		return view('lesson.show')->with(['course' => $course, 'lesson' => $lesson, 'user' => $user]);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$lesson = Lesson::findOrFail($id);
		$user = Auth::user();
		$course = $user->courses->find($lesson->course_id);
		return view('lesson.edit')->with(['course' => $course, 'lesson' => $lesson, 'user' => $user]);

	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$lesson = Lesson::findOrFail($id);
		if ($request->has('course_id')) {
			$lesson->course_id = $request->input('course_id');
		}
		if ($request->has('title')) {
			$lesson->title = $request->input('title');
		}
		if ($request->has('description')) {
			$lesson->description = $request->input('description');
		}
		if($request->has('content')) {
			$lesson->content = $request->input('content');
		}
		if($request->has('duration')) {
			$lesson->duration = $request->input('duration');
		}
		if($request->has('is_published')) {
			$lesson->is_published = $request->input('is_published') ? 1 : 0;
		}
		if($request->has('order')) {
			$lesson->order = $request->input('order');
		}
		if(isset($request->video)) {
			if(isset($lesson->video_url)) {
				$video = substr($lesson->video_url, 22);
				Storage::disk('public')->delete($video);
			}
			$video = $request->file('video')->store('lessons/videos', 'public');
			$lesson->video_url = asset('storage/' . $video);
		}
		$lesson->save();
		return redirect('/lesson/'. $lesson->id);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$lesson = Lesson::findOrFail($id);
		$lesson->delete();
	}

	public function learnLesson(Request $request, $id)
	{
		$lesson = Lesson::findOrFail($id);
		$lesson->load('course', 'course.user', 'tests');
		return view('lesson.learn')->with(['lesson' => $lesson]);
	}

	public function propune($id)
	{
		if(!auth()->check()) {
			abort(403);
		}
		$user =  Auth::user();
		$course = Course::findOrFail($id);
		if($user->id != $course->user_id) {
			return view('lesson.propune')->with(['course' => $course, 'user' => $user]);
		}
		return redirect('/lesson/create');
	}

	public function finish(Request $request)
	{
		$request->validate([
			'lessonId' => 'required',
		]);
		$lesson = Lesson::findOrFail($request->input('lessonId'));
		$user = Auth::user();
		$userActivity = $lesson->addPointsForUser($user->id);

		return response()->json($userActivity, 200);
	}
}
