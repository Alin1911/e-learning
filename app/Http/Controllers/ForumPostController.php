<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use Illuminate\Http\Request;

class ForumPostController extends Controller
{
    public function index(Request $request)
    {
        return view('forum_post.index');
    }

    public function create(Request $request)
    {
        return view('forum_post.create');
    }

    public function update(Request $request)
    {
        $forum_post = ForumPost::find($request->id);
        if ($request->has('title'))
            $forum_post->title = $request->title;
        if ($request->has('description'))
            $forum_post->description = $request->description;
        $forum_post->save();

        return redirect()->route('forum_post.index');
    }
    public function store(Request $request)
    {
        $forum_post = new ForumPost();
        $forum_post->title = $request->title;
        $forum_post->description = $request->description;
        $forum_post->save();

        return redirect()->route('forum_post.index');
    }

    public function edit($id)
    {
        $forum_post = ForumPost::find($id);
        return view('forum_post.edit', compact('forum_post'));
    }

}