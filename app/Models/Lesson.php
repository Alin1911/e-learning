<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
	use HasFactory;

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public function userLessons() : HasMany
	{
		return $this->hasMany(UserLesson::class, 'lesson_id');
	}

	public function tests()
	{
		return $this->hasMany(Test::class);
	}

	public function points()
	{
		return 5;
	}

	public function addPointsForUser(int $userId)
	{
		$user = User::find($userId);
		$userPoints = UserActivity::where('activity_model', 'App\Models\Lesson')
			->where('activity_id', $this->id)
			->where('user_id', $userId)
			->first();
		if(!$userPoints) {
			$userPoints = new UserActivity();
			$userPoints->user_id = $userId;
			$userPoints->activity_model = 'App\Models\Lesson';
			$userPoints->activity_id = $this->id;
			$userPoints->review_text = 'Lesson completed';
		}
		$user->points += $this->points();
		$userPoints->save();
		return $userPoints;
	}

}
