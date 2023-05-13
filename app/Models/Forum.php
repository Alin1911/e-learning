<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Forum extends Model
{
    use HasFactory;

    public function courses()
    {
        return $this->belongsTo(Course::class);
    }

    public function forum_topics()
    {
        return $this->hasMany(ForumTopic::class);
    }
    public function forum_posts()
    {
        return $this->hasMany(ForumPost::class);
    }
}