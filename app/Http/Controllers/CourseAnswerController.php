<?php

namespace App\Http\Controllers;

use App\Models\CourseAnswer;
use Illuminate\Http\Request;

class CourseAnswerController extends Controller
{
    public function index(Request $request)
    {

        $answers = CourseAnswer::all();
        if ($request->has('question_id')) {
            $answers = CourseAnswer::where('question_id', $request->question_id)->get();
        } elseif ($request->has('user_id')) {
            $answers = CourseAnswer::where('user_id', $request->user_id)->get();
        }
        return view('courseanswer.index')->with(['answers' => $answers]);
    }

    public function create()
    {
        return view('courseanswer.create');
    }

    public function show($id)
    {
        $answer = CourseAnswer::find($id);
        return view('courseanswer.show')->with(['answer' => $answer]);
    }

    public function store(Request $request)
    {
        $answer = new CourseAnswer();
        $answer->question_id = $request->question_id;
        $answer->user_id = $request->user_id;
        $answer->answer = $request->answer;
        $answer->save();
        return redirect()->route('courseanswer.index');
    }

    public function edit($id)
    {
        $answer = CourseAnswer::find($id);
        return view('courseanswer.edit')->with(['answer' => $answer]);
    }

    public function update(Request $request)
    {
        $answer = CourseAnswer::find($request->id);
        if ($request->has('question_id')) {
            $answer->question_id = $request->question_id;
        }
        if ($request->has('user_id')) {
            $answer->user_id = $request->user_id;
        }
        if ($request->has('answer')) {
            $answer->answer = $request->answer;
        }
        $answer->save();
        return redirect()->route('courseanswer.index');
    }

    public function destroy($id)
    {
        $answer = CourseAnswer::find($id);
        $answer->delete();
        return redirect()->route('courseanswer.index');
    }
}
