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
        $validatedData = $request->validate([
            'user_id' => 'required',
            'topic_id' => 'required',
            'content' => 'required',
            'likes' => 'integer'
        ]);

        $post = new ForumPost();
        $post->user_id = $request->user_id;
        $post->topic_id = $request->topic_id;
        $post->content = $request->content;
        $post->likes = $request->likes ?? 0;
        $post->save();

        return response()->json(['message' => 'Postarea a fost adaugată cu succes', 'post' => $post]);
    }
    public function edit($id)
    {
        $forum_post = ForumPost::find($id);
        return view('forum_post.edit', compact('forum_post'));
    }

}