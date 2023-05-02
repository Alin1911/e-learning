<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::where('public', 1)->get();
        return view('exercise.index')->with('exercises', $exercises);
    }

    public function create()
    {
        return view('exercise.create');
    }

    public function store(Request $request)
    {
        $exercise = new Exercise();
        $exercise->title = $request->title;
        $exercise->description = $request->description;
        $exercise->save();

        return redirect()->route('exercise.index');
    }

    public function edit($id)
    {
        $exercise = Exercise::find($id);
        return view('exercise.edit', compact('exercise'));
    }

    public function update(Request $request)
    {
        $exercise = Exercise::find($request->id);
        if ($request->has('title'))
            $exercise->title = $request->title;
        if ($request->has('description'))
            $exercise->description = $request->description;
        $exercise->save();

        return redirect()->route('exercise.index');
    }
}