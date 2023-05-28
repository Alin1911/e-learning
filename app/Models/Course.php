<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	use HasFactory;

	public function forum()
	{
		return $this->hasMany(Forum::class);
	}

	public function category()
	{
		return $this->hasOne(Category::class, 'id', 'category_id');
	}
	public function learningUsers()
	{
		return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
	}
	public function lessons()
	{
		return $this->hasMany(Lesson::class);
	}
	public function questions()
	{
		return $this->hasMany(CourseQuestion::class);
	}
	public function exercises()
	{
		return $this->hasMany(Exercise::class);
	}
	public function tests()
	{
		return $this->hasMany(Test::class);
	}
	public function instructor()
	{
		return $this->hasOne(Instructor::class, 'id', 'instructor_id');
	}
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function scopeSearch(Builder $query, string $searchTerm)
	{
		return $query->where(function (Builder $query) use ($searchTerm) {
			$query->where('title', 'LIKE', '%' . $searchTerm . '%')
				->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
				->orWhereHas('metaTag', function (Builder $query) use ($searchTerm) {
					$query->where('keywords', 'LIKE', '%' . $searchTerm . '%')
						->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
						->orWhere('title', 'LIKE', '%' . $searchTerm . '%')
						->orWhere('author', 'LIKE', '%' . $searchTerm . '%')
						->orWhere('language', 'LIKE', '%' . $searchTerm . '%')
						->orWhere('level', 'LIKE', '%' . $searchTerm . '%')
						->orWhere('duration', 'LIKE', '%' . $searchTerm . '%')
						->orWhere('publish_date', 'LIKE', '%' . $searchTerm . '%')
						->orWhere('price', 'LIKE', '%' . $searchTerm . '%');
				});
		});
	}
	public function completedLessonsForUser(int $userId)
	{
		$completedLessons = UserActivity::where('activity_model', 'App\Models\Lesson')
			->where('user_id', $userId)
			->where('activity_id', 'IN', $this->lessons->pluck('id'))
			->pluck('activity_id');
		$completedCourseLessons = Lesson::whereIn('id', $completedLessons)->where('course_id', $this->id)->get();
		return $completedCourseLessons;

	}

	public function metaTag()
	{
		return $this->hasOne(CourseMetaTag::class);
	}

	public function addPointsForUser(int $userId)
	{
		$userPoints = UserActivity::where('activity_model', 'App\Models\Course')
			->where('activity_id', $this->id)
			->where('user_id', $userId)
			->first();
		if (!$userPoints) {
			$userPoints = new UserActivity();
			$userPoints->user_id = $userId;
			$userPoints->activity_model = 'App\Models\Course';
			$userPoints->activity_id = $this->id;
			$userPoints->review_text = 'Course completed';
		}
		$user->points += $this->points();
		$userPoints->save();
		return $userPoints;
	}
	public function totalPoints() : int
	{
		$totalPoint = 0;
		foreach ($this->lessons as $lesson) {
			$totalPoint += $lesson->points();
			foreach ($lesson->tests as $test) {
				foreach ($test->exercises as $exercise) {
					$totalPoint += $exercise->points;
				}
			}
		}
		foreach($this->tests as $test) {
			foreach($test->exercises as $exercise) {
				$totalPoint += $exercise->points;
			}
		}
		return $totalPoint;
	}

	public function minimalPoints() : int
	{
		$totalPoint = $this->totalPoints();
		if(isset($this->points)) {
			return $totalPoint * $this->points /100;
		}
		return $totalPoint * 0.6;
	}

	public function getUserPoints() : int
	{
		$user = auth()->user();
		$userPoints = UserActivity::where('activity_model', 'App\Models\Course')
			->where('activity_id', $this->id)
			->where('user_id', $user->id)
			->sum('points');
		$coursesId = $this->courses->pluck('id');
		$userPoints += UserActivity::where('activity_model', 'App\Models\Lesson')
			->where('user_id', $user->id)
			->where('activity_id', 'IN', $coursesId)
			->sum('points');
		$testIds = $this->tests->pluck('id');
		$userPoints += UserActivity::where('activity_model', 'App\Models\Test')
			->where('user_id', $user->id)
			->where('activity_id', 'IN', $testIds)
			->sum('points');
		foreach ($this->lessons as $lesson) {
			$testIds = $lesson->tests->pluck('id');
			$userPoints += UserActivity::where('activity_model', 'App\Models\Test')
				->where('user_id', $user->id)
				->where('activity_id', 'IN', $testIds)
				->sum('points');
		}
		return $userPoints;
	}

}
