<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumTopicController extends Controller
{
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
    public function store(Request $request)
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
