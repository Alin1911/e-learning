<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function userLessons()
    {
        return $this->hasMany(UserLesson::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }


}