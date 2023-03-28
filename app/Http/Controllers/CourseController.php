<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('course.index')->with('courses', $courses);
    }

    public function create()
    {
        return view('course.create');
    }

    public function store(Request $request)
    {
        $course = new Course();
        $course->title = $request->title;
        $course->description = $request->description;
        $course->save();

        return redirect()->route('course.index');
    }

    public function show($id)
    {
        $course = Course::find($id);
        return view('course.show', compact('course'));
    }

    public function edit($id)
    {
        $course = Course::find($id);
        return view('course.edit', compact('course'));
    }

    public function update(Request $request)
    {

    }

}