<?php

namespace App\Http\Controllers;

// Importing required models
use App\Models\Forum;
use App\Models\ForumTopic;
use Illuminate\Http\Request;

class ForumTopicController extends Controller
{
	// Display a specific forum topic
	public function show(Request $request, $id)
	{
		$topicToShow =  ForumTopic::findOrFail($id);
		$topicToShow->load('posts', 'posts.user');

		if($request->wantsJson()) {
			return json_encode($topicToShow);
		}

		return view('topic.show')->with('topic', $topicToShow);
	}

	// Store a new forum topic in the database
	public function store(Request $request, $id)
	{
		$request->validate([
			'title' => 'required|string|max:255',
		]);

		if($request->has('forum_id')) {
			$id = $request->forum_id;
		}

		$forum = Forum::findOrFail($id);

		$newTopic = new ForumTopic();
		$newTopic->title = $request->title;

		if($request->has('description')) {
			$newTopic->description = $request->description;
		}

		$forum->topics()->save($newTopic);

		return $newTopic;
	}

	// Retrieve all posts for a specific forum topic
	public function posts($id)
	{
		$topic = ForumTopic::findOrFail($id);
		return $topic->posts;
	}

	// Show all forum topics
	public function index(Request $request)
	{
		return view('forum_topic.index');
	}

	// Display form for creating a new forum topic
	public function update(Request $request, $id)
	{
		$request->validate([
			'title' => 'required|string|max:255',
		]);

		$topicToUpdate = ForumTopic::findOrFail($id);
		$topicToUpdate->title = $request->title;

		if($request->has('description')) {
			$topicToUpdate->description = $request->description;
		}

		$topicToUpdate->save();

		return redirect()->route('forum_topic.index');
	}

	// Display form for editing a specific forum topic
	public function edit($id)
	{
		$topicToEdit = ForumTopic::findOrFail($id);

		return view('forum_topic.edit')->with('topic', $topicToEdit);
	}

	// Delete a specific forum topic
	public function destroy($id)
	{
		$topicToDelete = ForumTopic::findOrFail($id);
		$topicToDelete->delete();

		return redirect()->route('forum_topic.index');
	}
}
