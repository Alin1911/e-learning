<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $courses = Course::all();
        if ($request->has('search')) {
            $courses = Course::where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->get();
        }

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

        return json_encode($course);
    }

    public function show($id)
    {
        $course = Course::find($id);
        return view('course.show')->with('course', $course);
    }

    public function edit($id)
    {
        $course = Course::find($id);
        return view('course.edit', compact('course'));
    }

    public function update(Request $request)
    {
        $course = Course::find($request->id);
        if ($request->has('title'))
            $course->title = $request->title;
        if ($request->has('description'))
            $course->description = $request->description;
        $course->save();

        return redirect()->route('course.index');

    }

    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return redirect()->route('course.index');
    }

}