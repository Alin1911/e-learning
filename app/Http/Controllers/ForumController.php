<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{

	// Fetch and return all topics of a specific forum
	public function topics(Request $request, $id)
	{
		$specificForum = Forum::with(['topics', 'topics.posts'])->findOrFail($id);

		if ($request->wantsJson()) {
			return json_encode($specificForum);
		}

		return $specificForum;
	}

	// Fetch and display all forums that are not linked with any course
	public function index(Request $request)
	{
		$standaloneForums = Forum::whereNull('course_id')->get();
		$standaloneForums->load('topics', 'topics.posts');

		// Send data to the view
		return view('forum.index')->with('forums', $standaloneForums);
	}
	public function jsonIndex(Request $request)
	{
		$standaloneForums = Forum::whereNull('course_id')->get();
		$standaloneForums->load('topics', 'topics.posts');

		// Return data as JSON if required
		if($request->wantsJson()) {
			return json_encode($standaloneForums);
		}
	}


	// Display form for creating a new forum
	public function create()
	{
		$user = auth()->user();
		$courses = $user->courses;
		return view('forum.create')->with(['courses' => $courses]);
	}

	// Store a newly created forum in the database
	public function store(Request $request)
	{
		$newForum = new Forum();
		if ($request->has('title')) {
			$newForum->title = $request->input('title');
		}
		if ($request->has('description')) {
			$newForum->description = $request->input('description');
		}
		$newForum->save();
	}

	// Display a specific forum
	public function show(string $id)
	{
		$forum = Forum::find($id);
		$forum->load('topics');
		return view('topic.index')->with('forum', $forum);
	}

	// Display form for editing a specific forum
	public function edit(string $id)
	{
		$forumToEdit = Forum::find($id);
		return view('forum.edit')->with('forum', $forumToEdit);
	}

	// Update the specified forum in the database
	public function update(Request $request, string $id)
	{
		$forumToUpdate = Forum::find($id);
		if ($request->has('title')) {
			$forumToUpdate->title = $request->input('title');
		}
		if ($request->has('description')) {
			$forumToUpdate->description = $request->input('description');
		}
		$forumToUpdate->save();
	}

	// Remove the specified forum from the database
	public function destroy(string $id)
	{
		$forumToDelete = Forum::find($id);
		$forumToDelete->delete();
	}
}
