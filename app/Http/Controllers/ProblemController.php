<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;

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
		return view('problems.create');
	}

	public function store(Request $request)
	{
		// Validarea datelor din formular
		$request->validate([
			'title' => 'required',
			'description' => 'required',
			// Adăugați aici și alte câmpuri necesare pentru validare
		]);

		// Crearea problemei
		$problem = new Problem($request->all());
		$problem->save();

		// Redirecționarea către pagina de probleme cu mesaj de succes
		return redirect()->route('problems.index')->with('success', 'Problem created successfully');
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
		return redirect()->route('problems.index')->with('success', 'Problem updated successfully');
	}

	public function destroy($id)
	{
		$problem = Problem::find($id);
		$problem->delete();
		return redirect()->route('problems.index')->with('success', 'Problem deleted successfully');
	}
}
