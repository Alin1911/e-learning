<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application index.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		$user = Auth::user();
		$user->load('learningCourses', 'posts', 'posts.topic', 'posts.topic.forum', 'role', 'problems');
		return view('home')->with(['user' => $user]);
	}
}
