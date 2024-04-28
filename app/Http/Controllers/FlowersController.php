use Illuminate\Http\Request;

<?php

namespace App\Http\Controllers;


class FlowersController extends Controller
{
	public function index()
	{
		return view('flowers.index');
	}
}
