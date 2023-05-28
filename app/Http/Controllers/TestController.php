<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
	//
	public function index(Request $request)
	{
		$user = Auth::user();
		if ($request->has('course_id')) {
			$course_id = $request->input('course_id');
			$tests = Test::where('course_id', $course_id)->get();
		} elseif ($request->has('lesson_id')) {
			$tests = Test::where('lesson_id', $request->input('lesson_id'))->get();
		} else {
			$tests = Test::all();
		}
		if ($request->has('user_id')) {
			$user_id = $request->input('user_id');
			$tests = $tests->where('user_id', $user_id)->get();
		}
		return view('test.index')->with(['tests' => $tests, 'user' => $user]);
	}
	public function store(Request $request)
	{
		$test = new Test();
		if ($request->has('course_id')) {
			$test->course_id = $request->input('course_id');
		}
		if ($request->has('lesson_id')) {
			$test->lesson_id = $request->input('lesson_id');
		}
		if ($request->has('title')) {
			$test->title = $request->input('title');
		}
		if ($request->has('description')) {
			$test->description = $request->input('description');
		}
		$test->time = $request->get('time', 10);

		$test->save();
		return response()->json($test, 200);
	}
	public function create(Request $request)
	{
		$user = Auth::user();
		$course = $user->courses;
		$course->load('lessons', 'tests', 'lessons.tests');
		if($request->wantsJson()) {
			return response()->json($course, 200);
		}
		return view('test.create')->with(['courses' => $course]);
	}

	public function edit($id)
	{
		$test = Test::find($id);
		$test->load('course', 'lesson', 'exercises');
		return view('test.edit')->with(['test' => $test]);
	}

	public function show(Request $request, $id)
	{
		$test = Test::find($id);
		if ($request->wantsJson()) {
			return response()->json($test, 200);
		}
		return view('test.show')->with(['test' => $test]);
	}

	public function verify($id, Request $request)
	{
		$test = Test::find($id);
		$test->load('course', 'lesson', 'exercises', 'exercises.options', 'exercises.orderingItems', 'exercises.fillInTheBlankItems');
		if ($request->wantsJson()) {
			return json_encode(['test' => $test]);
		}
		return view('test.learn')->with(['test' => $test]);
	}

	public function check($id, Request $request)
	{
		$test = Test::find($id);
		$user = Auth::user();
		$points  = 0;
		foreach($request->all() as $exercise) {
			$e = Exercise::find($exercise['exercise_id']);
			if($e->exercise_type  == 'multiple_choice_single_answer') {
				$answer = $e->checkMultipleChoiceSingleAnswer($exercise['selected_answers'][0]);
				if($answer) {
					$points += $e->points;
				}
			}
			if($e->exercise_type  == 'multiple_choice_multiple_answers') {
				$answer = $e->checkMultipleChoiceMultipleAnswers($exercise['selected_answers']);
				if($answer) {
					$points += $e->points;
				}

			}
		}
		$total = $test->exercises->sum('points');
		$result = $test->setUserAcivity($points, $total);
		if(isset($test->lesson)) {
			$cours_id = $test->lesson->course->id;
		} else {
			$cours_id = $test->course->id;
		}
		return response()->json(['result' => $result, 'course_id' => $cours_id], 200);
	}
}
