<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	public function currentUser()
	{
		if (! auth()->user()) {
			return json_encode(['error' => 'Not logged in']);
		}
		return json_encode(auth()->user());
	}

	public function edit($id)
	{
		$user = auth()->user();
		if(empty($user)) {
			abort(404);
		}
		return view('account.edit')->with(['user' => $user]);
	}

	public function update(Request $request, $id)
	{
		$user = auth()->user();
		if(empty($user)) {
			abort(404);
		}
		if ($request->has('name')) {
			$user->name = $request->input('name');
		}

		if ($request->has('email')) {
			$user->email = $request->input('email');
		}

		if ($request->has('birthdate')) {
			$user->birthdate = $request->input('birthdate');
		}

		if ($request->has('profession')) {
			$user->profession = $request->input('profession');
		}

		if ($request->has('interests')) {
			$user->interests = $request->input('interests');
		}

		if ($request->has('phone')) {
			$user->phone = $request->input('phone');
		}

		if ($request->has('country')) {
			$user->country = $request->input('country');
		}

		$user->save();
		return redirect()->route('account.edit', $user->id);
	}

	public function destroy($id)
	{
		$user = auth()->user();
		$user->delete();
		return redirect()->route('home');
	}
}
