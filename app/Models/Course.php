<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function users()
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
}