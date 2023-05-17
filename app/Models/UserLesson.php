<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLesson extends Model
{
	use HasFactory;
	protected $fillable = [
		'user_id',
		'lesson_id',
		'completed_at',
	];

	protected $table = 'user_lessons';

	public function user() : BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function lesson() : BelongsTo
	{
		return $this->belongsTo(Lesson::class, 'lesson_id');
	}
}
