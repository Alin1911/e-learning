<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::all()->take(10);
        return view('index')->with('courses', $courses);
    }

    public function team()
    {
        return view('general.team');
    }

    public function contact()
    {
        return view('general.contact');
    }

    public function term()
    {
        return view('general.term');
    }
}
