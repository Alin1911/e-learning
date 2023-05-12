<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Course extends Model
{
    use HasFactory;

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
    public function completedLessonsForUser(int $userId) : Builder
    {
        return Lesson::query()
            ->join('user_lessons', 'lessons.id', '=', 'user_lessons.lesson_id')
            ->where('lessons.course_id', $this->id)
            ->where('user_lessons.user_id', $userId)
            ->whereNotNull('user_lessons.completed_at')
            ->select('lessons.*');
    }
    public function metaTag()
    {
        return $this->hasOne(CourseMetaTag::class);
    }
}