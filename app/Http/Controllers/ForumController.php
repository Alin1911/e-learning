<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        return view('forum.index');
    }
}