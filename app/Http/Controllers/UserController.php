<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
	public function currentUser()
	{
		if (! auth()->user()) {
			return json_encode(['error' => 'Not logged in']);
		}
		return json_encode(auth()->user());
	}
}
