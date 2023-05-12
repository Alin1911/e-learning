<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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

    public function completedLessonsByUser(int $userId) : HasManyThrough
    {
        return $this->hasManyThrough(
            Lesson::class,
            UserLesson::class,
            'lesson_id', // cheia străină pe tabela intermediară
            'id', // cheia străină pe tabela finală
            'id', // cheia locală pe tabela parent
            'id' // cheia locală pe tabela intermediară
        )->where('user_id', $userId)->whereNotNull('completed_at');
    }

}