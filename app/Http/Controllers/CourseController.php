<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
                ->orWhere('description', 'like', '%' . $search . '%')->get();
        }
        if ($request->has('nivel')) {
            $courses = $courses->where('level', $request->nivel);
        }

        return view('course.index')->with('courses', $courses);
    }

    public function create()
    {
        $categories = Category::all();

        return view('course.create')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $course = new Course();
        $course->title = $request->get('title', '');
        $course->description = $request->get('description', '');
        $course->category_id = $request->get('category_id', '');
        $course->price = $request->get('price', 'free');
        $course->level = $request->get('level', 'beginner');
        $course->duration = $request->get('duration', 'anytime');
        $course->discount = $request->get('discount', '0');
        $course->additional_info = $request->get('additional_info', '');
        $course->instructor_id = $request->get('instructor_id', '1');
        $course->language = $request->get('language', 'english');
        $course->save();

        return $course->id;
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
        if ($request->has('category_id'))
            $course->category_id = $request->category_id;
        if ($request->has('price'))
            $course->price = $request->price;
        if ($request->has('level'))
            $course->level = $request->level;
        if ($request->has('duration'))
            $course->duration = $request->duration;
        if ($request->has('discount'))
            $course->discount = $request->discount;
        if ($request->has('additional_info'))
            $course->additional_info = $request->additional_info;
        if ($request->has('instructor_id'))
            $course->instructor_id = $request->instructor_id;
        if ($request->has('language'))
            $course->language = $request->language;

        $course->save();

        return $course->id;

    }

    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return redirect()->route('course.index');
    }

}