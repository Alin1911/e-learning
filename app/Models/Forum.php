<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
	use HasFactory;

	public function courses()
	{
		return $this->belongsTo(Course::class);
	}

	public function topics()
	{
		return $this->hasMany(ForumTopic::class);
	}
}
