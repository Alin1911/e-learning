<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
	use HasFactory;

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public function lesson()
	{
		return $this->belongsTo(Lesson::class);
	}

	public function exercises()
	{
		return $this->hasMany(Exercise::class);
	}

	public function setUserAcivity($points, $total)
	{
		$user = auth()->user();
		$activity = UserActivity::where('user_id', $user->id)->where('activity_model', 'App\Models\Test')->where('activity_id', $this->id)->first();
		if(!$activity) {
			$activity = new UserActivity();
		}
		$activity->user_id = $user->id;
		$activity->activity_model = 'App\Models\Test';
		$activity->activity_id = $this->id;
		$activity->rating = $points;
		$activity->review_text = 'Ai obtinut ' . $points . ' din ' . $total . ' puncte pentru testul ' . $this->title;
		$activity->save();

		return $activity;
	}
}
