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
    public function store(Request $request)
    {
        $test = new Test();
        if ($request->has('course_id')) {
            $test->course_id = $request->input('course_id');
        }
        if ($request->has('lesson_id')) {
            $test->lesson_id = $request->input('lesson_id');
        }
        if ($request->has('title')) {
            $test->title = $request->input('title');
        }
        if ($request->has('description')) {
            $test->description = $request->input('description');
        }
        $test->save();
        return response()->json($test, 200);
    }
    public function create(Request $request)
    {
        $user = Auth::user();
        $course = $user->courses;
        $course->load('lessons', 'tests', 'lessons.tests');
        return view('test.create')->with(['courses' => $course]);
    }

    public function edit($id)
    {
        $test = Test::find($id);
        return view('test.edit')->with(['test' => $test]);
    }

    public function show(Request $request, $id)
    {
        $test = Test::find($id);
        if ($request->wantsJson()) {
            return response()->json($test, 200);
        }
        return view('test.show')->with(['test' => $test]);
    }
}