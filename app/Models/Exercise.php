<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
	use HasFactory;

	public function tests()
	{
		return $this->belongsToMany(Test::class);
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
		$correctOptions = $this->options()->where('is_correct', true)->pluck('id')->toArray();
		sort($correctOptions);
		sort($answers);
		return $correctOptions === $answers;
	}

	public function checkMultipleChoiceSingleAnswer($answer)
	{
		$correctOption = $this->options()->where('is_correct', true)->first();
		return $correctOption->id === $answer;
	}

	public function checkNumeric($answer)
	{
		if(count($answer) > 0) {
			return $this->options->first()->option_text == $answer[0];
		}
		return false;
	}

	public function checkOrdering($ordering)
	{
		$order = $this->orderingItems->pluck('correct_order')->sortBy('correct_order');
		;
		foreach($order as $i => $o) {
			if(isset($ordering[$i])) {
				if($ordering[$i] != $o) {
					return false;
				}
			} else {
				return false;
			}
		}
		return true;
	}

	public function checkFillInTheBlank($words)
	{
		$answers = $this->fillInTheBlankItems->pluck('word')->sortBy('position');
		foreach($answers as $i => $w) {
			if(!isset($words[$i])) {
				return false;
			}
			if($w != $words[$i]) {
				return false;
			}

		}
		return true;
	}

}
