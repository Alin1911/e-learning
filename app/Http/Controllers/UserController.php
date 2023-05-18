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

	public function edit($id)
	{
		$user = auth()->user();
		return view('account.edit')->with(['user' => $user]);
	}

	public function update(Request $request, $id)
	{
		$user = auth()->user();
		$user->update($request->all());
		return redirect()->route('account.edit', $user->id);
	}

	public function destroy($id)
	{
		$user = auth()->user();
		$user->delete();
		return redirect()->route('home');
	}
}
