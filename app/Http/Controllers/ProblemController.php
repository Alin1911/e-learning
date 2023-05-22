<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProblemController extends Controller
{
	public function index(Request $request)
	{
		$exercises = Problem::all();
		if($request->wantsJson()) {
			return json_encode($exercises);
		}
		return view('problems.index', compact('exercises'));
	}

	public function show($id)
	{
		$problem = Problem::find($id);
		return view('problems.show', compact('problem'));
	}

	public function create()
	{
		if (!auth()->check()) {
			return redirect()->route('login');
		}

		return view('problems.create');
	}

	public function store(Request $request)
	{
		// Validarea datelor din formular
		$user = Auth::user();
		if (! auth()->check()) {
			redirect()->route('login');
			abort(403);
		}
		if(!$user->hasRole('admin')) {
			abort(403);
		}
		$request->validate([
			'title' => 'required',
			'description' => 'required',
		]);

		// Crearea problemei
		$problem = new Problem();
		$problem->title = $request->title;
		$problem->description = $request->description;
		$problem->user_id = $user->id;
		if($request->has('pairs')) {
			$problem->pairs = json_encode($request->pairs);
		}
		if($request->has('results')) {
			$problem->results = json_encode($request->results);
		}
		if($request->has('restrictions')) {
			$problem->restrictions = $request->restrictions;
		}
		if($request->has('example')) {
			$problem->example = $request->example;
		}
		if($request->has('hints')) {
			$problem->hints = $request->hints;
		}
		if($request->has('similar_problems')) {
			$problem->similar_problems = $request->similar_problems;
		}

		$problem->save();

		// Redirecționarea către pagina de probleme cu mesaj de succes
		return redirect('/problem');
	}

	public function edit($id)
	{
		$problem = Problem::find($id);
		return view('problems.edit', compact('problem'));
	}

	public function update(Request $request, $id)
	{
		$problem = Problem::findOrFail($id);
		// Validarea datelor din formular
		$request->validate([
			'title' => 'required',
			'description' => 'required',
			// Adăugați aici și alte câmpuri necesare pentru validare
		]);

		// Actualizarea problemei
		$problem->update($request->all());

		// Redirecționarea către pagina de probleme cu mesaj de succes
		return redirect('/problem');
	}

	public function destroy($id)
	{
		$problem = Problem::find($id);
		$problem->delete();
		return 204;
	}
}
