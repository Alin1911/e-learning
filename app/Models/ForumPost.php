<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
	use HasFactory;
	protected $fillable = ['content'];
	protected $appends = ['likes', 'liked'];

	public function topic()
	{
		return $this->belongsTo(ForumTopic::class, 'forum_topic_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function getLikesAttribute()
	{
		$likes = UserActivity::where('activity_model', 'App\Models\ForumPost')
			->where('activity_id', $this->id)
			->count();
		return $likes;
	}

	public function getLikedAttribute()
	{
		if(!auth()->check()) {
			return false;
		}
		$liked = UserActivity::where('activity_model', 'App\Models\ForumPost')
			->where('activity_id', $this->id)
			->where('user_id', auth()->user()->id)
			->exists();
		return $liked;
	}
}
