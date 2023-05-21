<?php

namespace App\Http\Controllers;

use App\Models\ForumTopic;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumTopicController extends Controller
{
	public function show(Request $request, $id)
	{
		$topic =  ForumTopic::findOrFail($id);
		$topic->load('posts', 'posts.user');
		if($request->wantsJson()) {
			return json_encode($topic);
		}
		return view('topic.show')->with('topic', $topic);
	}

	public function store(Request $request, $id)
	{
		$request->validate([
			'title' => 'required|string|max:255',
		]);
		if($request->has('forum_id')){
			$id = $request->forum_id;
		}
		$forum = Forum::findOrFail($id);
		$topic = new ForumTopic(['title' => $request->title]);
		$forum->topics()->save($topic);

		return $topic;
	}

	public function posts($id)
	{
		$topic = ForumTopic::findOrFail($id);
		return $topic->posts;
	}
	public function index(Request $request)
	{
		return view('forum_topic.index');
	}

	public function create(Request $request)
	{
		return view('forum_topic.create');
	}

	public function update(Request $request)
	{
		return redirect()->route('forum_topic.index');
	}

	public function edit($id)
	{
		return view('forum_topic.edit');
	}

	public function destroy($id)
	{
		return redirect()->route('forum_topic.index');
	}
}
