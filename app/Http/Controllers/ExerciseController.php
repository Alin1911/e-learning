<?php

namespace App\Http\Controllers;

use App\Models\ExerciseOption;
use App\Models\ExerciseOrderingItem;
use App\Models\ExerciseFillInTheBlankItem;


use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::where('public', 1)->get();
        return view('exercise.index')->with('exercises', $exercises);
    }

    public function create()
    {
        return view('exercise.create');
    }

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
        $exercise->save();

        if ($request->has('options')) {
            $options = json_decode($request->options, true);
            foreach ($options as $option) {
                $exerciseOption = new ExerciseOption();
                $exerciseOption->exercise_id = $exercise->id;
                $exerciseOption->answer = $option['answer'];
                $exerciseOption->correct = $option['correct'];
                $exerciseOption->save();
            }
        }

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

        return redirect()->route('exercise.index');
    }

    public function edit($id)
    {
        $exercise = Exercise::find($id);
        return view('exercise.edit', compact('exercise'));
    }

    public function update(Request $request)
    {
        $exercise = Exercise::find($request->id);
        if ($request->has('title'))
            $exercise->title = $request->title;
        if ($request->has('description'))
            $exercise->description = $request->description;
        $exercise->save();

        return redirect()->route('exercise.index');
    }

    public function destroy($id)
    {
        $exercise = Exercise::find($id);
        $exercise->delete();
    }

    public function checkAnswer(Request $request, $exercise_id)
    {
        $exercise = Exercise::find($exercise_id);

        if (! $exercise) {
            return response()->json(['message' => 'Exercise not found'], 404);
        }

        $isCorrect = false;

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

        return response()->json(['isCorrect' => $isCorrect]);
    }

}