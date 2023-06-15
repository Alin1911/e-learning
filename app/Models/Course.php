<?php

namespace App\Models;

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
	public function tests()
	{
		return $this->hasMany(Test::class);
	}
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function completedLessonsForUser(int $userId)
	{
		$completedLessons = UserActivity::where('activity_model', 'App\Models\Lesson')
			->where('user_id', $userId)
			->whereIn('activity_id', $this->lessons->pluck('id'))
			->pluck('activity_id');
		$completedCourseLessons = Lesson::whereIn('id', $completedLessons)->where('course_id', $this->id)->get();
		return $completedCourseLessons;

	}
	public function completedTestsForUser(int $userId)
	{
		$ids = [];
		foreach ($this->lessons as $lesson) {
			foreach ($lesson->tests as $test) {
				$ids[] = $test->id;
			}
		}
		$ids = array_merge($ids, $this->tests->pluck('id')->toArray());
		$completedTests = UserActivity::where('activity_model', 'App\Models\Test')
			->where('user_id', $userId)
			->whereIn('activity_id', $ids)
			->pluck('activity_id');
		$completedCourseTests = Test::whereIn('id', $completedTests)->where('course_id', $this->id)->get();
		return $completedCourseTests;
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
			->sum('rating');
		$lessonIds = $this->lessons->pluck('id');
		$userPoints += UserActivity::where('activity_model', 'App\Models\Lesson')
			->where('user_id', $user->id)
			->whereIn('activity_id', $lessonIds)
			->sum('rating');
		$testIds = $this->tests?->pluck('id');
		$userPoints += UserActivity::where('activity_model', 'App\Models\Test')
			->where('user_id', $user->id)
			->whereIn('activity_id', $testIds)
			->sum('rating');
		foreach ($this->lessons as $lesson) {
			$testIds = $lesson->tests?->pluck('id');
			$userPoints += UserActivity::where('activity_model', 'App\Models\Test')
				->where('user_id', $user->id)
				->whereIn('activity_id', $testIds)
				->sum('rating');
		}
		return $userPoints;
	}
}
