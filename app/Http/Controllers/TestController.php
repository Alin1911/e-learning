<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($request->has('course_id')) {
            $course_id = $request->input('course_id');
            $tests = Test::where('course_id', $course_id)->get();
        } else if ($request->has('lesson_id')) {
            $tests = Test::where('lesson_id', $request->input('lesson_id'))->get();
        } else {
            $tests = Test::all();
        }
        if ($request->has('user_id')) {
            $user_id = $request->input('user_id');
            $tests = $tests->where('user_id', $user_id)->get();
        }
        return view('test.index')->with(['tests' => $tests, 'user' => $user]);
    }

    public function create(Request $request)
    {
        $course = null;
        $lesson = null;
        $user = Auth::user();
        if ($request->has('course_id')) {
            $course_id = $request->input('course_id');
            $course = Course::find($course_id);
        }
        if ($request->has('lesson_id')) {
            $lesson_id = $request->input('lesson_id');
            $lesson = Lesson::find($lesson_id);
        }
        return view('test.create')->with(['course' => $course, 'lesson' => $lesson, 'user' => $user]);
    }

    public function edit($id)
    {
        $test = Test::find($id);
        return view('test.edit')->with(['test' => $test]);
    }
}