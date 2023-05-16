<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request)
    {

        $forums = Forum::whereNull('course_id')->get();
        return view('forum.index')->with('forums', $forums);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $courses = $user->courses;
        return view('forum.create')->with(['courses' => $courses]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $forum = new Forum();
        if ($request->has('title')) {
            $forum->title = $request->input('title');
        }
        if ($request->has('description')) {
            $forum->description = $request->input('description');
        }
        $forum->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $forum = Forum::find($id);
        $forum->load('courses', 'forum_posts', 'forum_posts.user');
        return view('forum.show')->with('forum', $forum);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $forum = Forum::find($id);
        return view('forum.edit')->with('forum', $forum);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $forum = Forum::find($id);
        if ($request->has('title')) {
            $forum->title = $request->input('title');
        }
        if ($request->has('description')) {
            $forum->description = $request->input('description');
        }
        $forum->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $forum = Forum::find($id);
        $forum->delete();
    }
}
