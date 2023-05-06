<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function options()
    {
        return $this->hasMany(ExerciseOption::class);
    }

    public function orderingItems()
    {
        return $this->hasMany(ExerciseOrderingItem::class);
    }

    public function fillInTheBlankItems()
    {
        return $this->hasMany(ExerciseFillInTheBlankItem::class);
    }

    public function checkMultipleChoiceMultipleAnswers($answers)
    {
        $correctOptions = $this->options()->where('correct', true)->pluck('id')->toArray();
        sort($correctOptions);
        sort($answers);
        return $correctOptions === $answers;
    }

    public function checkMultipleChoiceSingleAnswer($answer)
    {
        $correctOption = $this->options()->where('correct', true)->first();
        return $correctOption->id === $answer;
    }

    public function checkNumericAnswer($answer)
    {
        return $this->numeric_answer == $answer;
    }

    public function checkOrdering($ordering)
    {
        $correctOrdering = $this->orderingItems()->orderBy('correct_order')->pluck('id')->toArray();
        return $correctOrdering === $ordering;
    }

    public function checkFillInTheBlank($words)
    {
        $correctWords = $this->fillInTheBlankItems()->orderBy('position')->pluck('word')->toArray();
        return $correctWords === $words;
    }

}