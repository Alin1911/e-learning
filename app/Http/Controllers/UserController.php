<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function currentUser()
    {
        if (! auth()->user())
            return json_encode(['error' => 'Not logged in']);
        return json_encode(auth()->user());
    }
}