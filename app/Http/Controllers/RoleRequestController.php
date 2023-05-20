<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleRequestController extends Controller
{
	public function index(Request $request)
	{
		$requests = RoleRequest::all();
		$requests->load('user', 'role');
		if($request->wantsJson()) {
			return response()->json($requests);
		}
		return view('role.index')->with(['requests' =>$requests]);
	}
public function store(Request $request)
{
	$requestRole = new RoleRequest();
	$user = Auth::user();
	$requestRole->user_id = $user->id;
	$requestRole->role_id = $request->rol;
	$requestRole->approved = 0;
	$requestRole->motivation = $request->motivation;
	$requestRole->save();
	return response()->json($requestRole, 201);
}

public function show($id)
{
	$request = RoleRequest::find($id);
	return response()->json($request);
}

public function update(Request $request)
{
	$request->validate([
		'role_id' => 'required',
		'user_id' => 'required',
		'appoved' => 'required'
	]);
	if(!Auth::user()->hasRole('admin')) {
		return response()->json(['error' => 'You are not authorized to approve role requests'], 403);
	}
	$roleRequest = RoleRequest::where('user_id', $request->user_id)->where('role_id', $request->role_id)->first();
	$roleRequest->update($request->all());
	if($roleRequest->approved) {
		$user = User::find($roleRequest->user_id);
		$user->roles()->attach($roleRequest->role_id);
	}
	return response()->json($roleRequest);
}
	public function create()
	{
		$user = auth()->user();
		$roles = Role::all();
		return view('role.create')->with(['roles' => $roles, 'user' => $user]);
	}
}
