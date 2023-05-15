<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{

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

    public function edit(Problem $problem)
    {
        return view('problems.edit', compact('problem'));
    }

    public function update(Request $request, Problem $problem)
    {
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
}