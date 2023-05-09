<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMetaTag extends Model
{
    use HasFactory;

    protected $table = 'course_meta_tags';

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'keywords',
        'language',
        'author',
        'publish_date',
        'duration',
        'level',
        'price',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}