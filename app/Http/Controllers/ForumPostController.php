<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumTopic;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumPostController extends Controller
{
	// Show all forum posts
	public function index(Request $request)
	{
		return view('forum_post.index');
	}

	// Display form for creating a new forum post
	public function create(Request $request)
	{
		return view('forum_post.create');
	}

	// Update a specific forum post
	public function update(Request $request)
	{
		$postToUpdate = ForumPost::find($request->id);

		if ($request->has('title')) {
			$postToUpdate->title = $request->title;
		}
		if ($request->has('description')) {
			$postToUpdate->description = $request->description;
		}

		$postToUpdate->save();

		return redirect()->route('forum_post.index');
	}

	// Store a new forum post in the database
	public function store(Request $request, $id)
	{
		if(!auth()->check()) {
			abort(401, 'Unauthorized');
		}

		$user = Auth::user();
		$request->validate([
			'content' => 'required|string',
		]);

		$topic = ForumTopic::findOrFail($id);

		$newPost = new ForumPost();
		$newPost->content = $request->content;
		$newPost->forum_topic_id = $topic->id;
		$newPost->user()->associate($user);
		$newPost->save();

		return $newPost;
	}

	// Display form for editing a specific forum post
	public function edit($id)
	{
		$postToEdit = ForumPost::find($id);
		return view('forum_post.edit', compact('postToEdit'));
	}

	// Handle likes for a specific forum post
	public function likes($id)
	{
		if (!auth()->check()) {
			abort(401, 'Unauthorized');
		}

		$user = Auth::user();
		$user->load('activities');
		$post = ForumPost::findOrFail($id);
		$userLikes = $user->likes($id);

		if ($userLikes->isNotEmpty()) {
			$userLikes->first()->delete();
		} else {
			$userActivity = new UserActivity();
			$userActivity->user_id = $user->id;
			$userActivity->activity_id = $post->id;
			$userActivity->activity_model = 'App\Models\ForumPost';
			$userActivity->rating = 1;
			$userActivity->save();
		}

		return $post;
	}
}
