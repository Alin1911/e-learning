<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $instructores = Instructor::all();
        return view('instructor.index', compact('instructores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('instructor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $instructore = Instructor::find($id);
        if ($request->has('name')) {
            $instructore->name = $request->name;
        }
        $instructore->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $instructore = Instructor::find($id);
        return view('instructor.show', compact('instructore'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $instructore = Instructor::find($id);
        return view('instructor.edit', compact('instructore'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $instructore = Instructor::find($id);
        if ($request->has('name')) {
            $instructore->name = $request->name;
        }
        $instructore->save();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $instructore = Instructor::find($id);
        $instructore->delete();
    }
}