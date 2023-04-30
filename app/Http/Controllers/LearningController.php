<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function index(Request $request)
    {
        return view('index');
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