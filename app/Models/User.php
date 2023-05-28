<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function role()
	{
		return $this->belongsTo(Role::class);
	}
	public function hasRole($role)
	{
		if ($this->role->name === $role) {
			return true;
		}
		return false;
	}
	public function isAdmin()
	{
		if ($this->role->name === 'admin') {
			return true;
		}
		return false;
	}
	public function learningCourses()
	{
		return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id');
	}
	public function userLessons() : HasMany
	{
		return $this->hasMany(UserLesson::class, 'user_id');
	}
	public function courses()
	{
		return $this->hasMany(Course::class);
	}
	public function problems()
	{
		return $this->hasMany(Problem::class);
	}
	public function posts()
	{
		return $this->hasMany(ForumPost::class);
	}
	public function topics()
	{
		return $this->hasMany(ForumTopic::class);
	}
	public function activities()
	{
		return $this->hasMany(UserActivity::class);
	}
	public function likes($id)
	{
		return $this->activities()->where('activity_id', $id)->where('activity_model', 'App\Models\ForumPost')->get();
	}

	public function getLikesAttribute()
	{
		$likes = UserActivity::where('activity_model', 'App\Models\ForumPost')
			->where('activity_id', $this->id)
			->count();
		return $likes;
	}

	public function likesCount()
	{
		$post = $this->posts()->pluck('id');
		$likes = UserActivity::where('activity_model', 'App\Models\ForumPost')
			->whereIn('activity_id', $post)
			->count();
		return $likes;
	}

	public function points()
	{
		$point = $this->likesCount() * 10;
		return $point;
	}
}
