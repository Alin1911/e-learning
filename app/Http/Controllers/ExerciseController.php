<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\ExerciseFillInTheBlankItem;
use App\Models\ExerciseOption;
use App\Models\ExerciseOrderingItem;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
	// Fetch all public exercises and display on the index page
	public function index()
	{
		$publicExercises = Exercise::where('public', 1)->get();
		return view('exercise.index')->with('exercises', $publicExercises);
	}

	// Display form to create a new exercise
	public function create()
	{
		return view('exercise.create');
	}

	// Store a newly created exercise in the database
	public function store(Request $request)
	{
		$exercise = new Exercise();
		if ($request->has('test_id')) {
			$exercise->test_id = $request->test_id;
		}
		if ($request->has('question')) {
			$exercise->question = $request->question;
		}
		if ($request->has('exercise_type')) {
			$exercise->exercise_type = $request->exercise_type;
		}
		if ($request->has('points')) {
			$exercise->points = $request->points;
		}
		if ($request->has('public')) {
			$exercise->public = $request->public;
		}
		$exercise->points = $request->get('points', 1);
		$exercise->save();

		// Store options for the exercise if any
		if ($request->has('options')) {
			$options = $request->options;
			foreach ($options as $key => $option) {
				$exerciseOption = new ExerciseOption();
				$exerciseOption->exercise_id = $exercise->id;
				$exerciseOption->option_text = $option['answer'];
				if (isset($option['correct'])) {
					$exerciseOption->is_correct = $option['correct'];
				} else {
					$correctOptionIndex = $request->correctIndex;
					if ($key == $correctOptionIndex) {
						$exerciseOption->is_correct = 1;
					} else {
						$exerciseOption->is_correct = 0;
					}
				}
				$exerciseOption->save();
			}
		}

		// Store ordering items for the exercise if any
		if ($request->has('ordering_items')) {
			$orderingItems = json_decode($request->ordering_items, true);
			foreach ($orderingItems as $item) {
				$orderingItem = new ExerciseOrderingItem();
				$orderingItem->exercise_id = $exercise->id;
				$orderingItem->item = $item['item'];
				$orderingItem->correct_order = $item['correct_order'];
				$orderingItem->save();
			}
		}

		// Store fill in the blank items for the exercise if any
		if ($request->has('fill_in_the_blank_items')) {
			$fillInTheBlankItems = json_decode($request->fill_in_the_blank_items, true);
			foreach ($fillInTheBlankItems as $item) {
				$fillInTheBlankItem = new ExerciseFillInTheBlankItem();
				$fillInTheBlankItem->exercise_id = $exercise->id;
				$fillInTheBlankItem->word = $item['word'];
				$fillInTheBlankItem->position = $item['position'];
				$fillInTheBlankItem->save();
			}
		}

		// Return the newly created exercise's id as a JSON response
		return response()->json(['exercise_id' => $exercise->id]);
	}

	// Display form to edit an existing exercise
	public function edit($id)
	{
		$exercise = Exercise::find($id);
		return view('exercise.edit', compact('exercise'));
	}

	// Update the specified exercise in the database
	public function update(Request $request)
	{
		$exercise = Exercise::find($request->id);
		if ($request->has('title')) {
			$exercise->title = $request->title;
		}
		if ($request->has('description')) {
			$exercise->description = $request->description;
		}
		$exercise->save();

		// Redirect to the exercise index page
		return redirect()->route('exercise.index');
	}

	// Remove the specified exercise from the database
	public function destroy($id)
	{
		$exercise = Exercise::find($id);
		$exercise->delete();
	}

	// Check the answer for the specified exercise
	public function checkAnswer(Request $request, $exercise_id)
	{
		$exercise = Exercise::find($exercise_id);

		if (! $exercise) {
			return response()->json(['message' => 'Exercise not found'], 404);
		}

		$isCorrect = false;

		// Check answer based on exercise type
		switch ($exercise->exercise_type) {
			case 'multiple_choice_multiple_answers':
				$isCorrect = $exercise->checkMultipleChoiceMultipleAnswers($request->answers);
				break;

			case 'multiple_choice_single_answer':
				$isCorrect = $exercise->checkMultipleChoiceSingleAnswer($request->answer);
				break;

			case 'numeric':
				$isCorrect = $exercise->checkNumericAnswer($request->answer);
				break;

			case 'ordering':
				$isCorrect = $exercise->checkOrdering($request->ordering);
				break;

			case 'fill_in_the_blank':
				$isCorrect = $exercise->checkFillInTheBlank($request->words);
				break;
		}

		// Return whether the answer is correct or not as a JSON response
		return response()->json(['isCorrect' => $isCorrect]);
	}

}
