<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseQuestionController extends Controller
{
    public function index()
    {
        return view('course_question.index');
    }

    public function create()
    {
        return view('course_question.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('course_question.index');
    }

    public function edit($id)
    {
        return view('course_question.edit');
    }

    public function update(Request $request)
    {
        return redirect()->route('course_question.index');
    }

    public function destroy($id)
    {
        return redirect()->route('course_question.index');
    }
}