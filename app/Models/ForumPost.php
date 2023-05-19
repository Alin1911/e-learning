<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
	use HasFactory;
	protected $fillable = ['content', 'likes'];

	public function topic()
	{
		return $this->belongsTo(ForumTopic::class, 'forum_topic_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
