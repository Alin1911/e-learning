<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('id'))
            $forum = Forum::find($request->id);
        else
            $forum = Forum::find(1);
        return view('forum.index')->with('forum', $forum);
    }
}