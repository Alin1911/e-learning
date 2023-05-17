<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
		if ($request->has('title')) {
			$forum_post->title = $request->title;
		}
		if ($request->has('description')) {
			$forum_post->description = $request->description;
		}
		$forum_post->save();

		return redirect()->route('forum_post.index');
	}
	public function store(Request $request, $id)
	{
		$user = Auth::user();
		$request->validate([
			'content' => 'required|string',
		]);

		$topic = ForumTopic::findOrFail($id);

		$post = new ForumPost();
		$post->content = $request->content;
		$post->likes = 0;
		$post->forum_topic_id = $topic->id;
		$post->user()->associate($user);
		$post->save();

		return $post;
	}

	public function edit($id)
	{
		$forum_post = ForumPost::find($id);
		return view('forum_post.edit', compact('forum_post'));
	}

}
