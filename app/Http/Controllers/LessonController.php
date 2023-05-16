<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $courses->load('lessons');
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
        if ($request->has('video_url')) {
            $lesson->video_url = $request->input('video_url');
        }
        $lesson->order = Lesson::where('course_id', $lesson->course_id)->count() + 1;
        $lesson->save();
        $lessons = Lesson::where('course_id', $lesson->course_id)->get();
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
        $request->validate([
            'course_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'video_url' => 'required',
        ]);
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
        if ($request->has('video_url')) {
            $lesson->video_url = $request->input('video_url');
        }
        $lesson->save();
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
}
