<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

public static function countSegmentOccurrences($searchString, $segmentLength)
{
    $segments = self::splitStringIntoSegments($searchString, $segmentLength);

    $query = DB::table('course_meta_tags')
        ->leftJoin('lessons', 'course_meta_tags.course_id', '=', 'lessons.course_id');

    $totalCounts = [];
    $bindings = [];

    foreach ($segments as $index => $segment) {
        $countColumn = '(
            (LENGTH(course_meta_tags.title) - LENGTH(REPLACE(course_meta_tags.title, "'.$segment.'", "")))/'.$segmentLength.' +
            (LENGTH(course_meta_tags.description) - LENGTH(REPLACE(course_meta_tags.description, "'.$segment.'", "")))/'.$segmentLength.' +
            (LENGTH(course_meta_tags.keywords) - LENGTH(REPLACE(course_meta_tags.keywords, "'.$segment.'", "")))/'.$segmentLength.' +
            (LENGTH(course_meta_tags.language) - LENGTH(REPLACE(course_meta_tags.language, "'.$segment.'", "")))/'.$segmentLength.' +
            (LENGTH(course_meta_tags.author) - LENGTH(REPLACE(course_meta_tags.author, "'.$segment.'", "")))/'.$segmentLength.' +
            (LENGTH(lessons.title) - LENGTH(REPLACE(lessons.title, "'.$segment.'", "")))/'.$segmentLength.' +
            (LENGTH(lessons.description) - LENGTH(REPLACE(lessons.description, "'.$segment.'", "")))/'.$segmentLength.' +
            (LENGTH(lessons.content) - LENGTH(REPLACE(lessons.content, "'.$segment.'", "")))/'.$segmentLength.'
        )';

        $query->addSelect(DB::raw($countColumn.' as count'.$index));
        $totalCounts[] = $countColumn;
    }

    $query->addSelect('course_meta_tags.course_id', DB::raw('('.implode(' + ', $totalCounts).') as totalCount'))
        ->where(DB::raw('('.implode(' + ', $totalCounts).')'), '>', 0)
        ->orderBy('totalCount', 'desc');

    return $query->get()->pluck('course_id');
}
	

	private static function splitStringIntoSegments($string, $segmentLength)
	{
		$segments = [];
		$length = strlen($string);

		for ($i = 0; $i <= $length - $segmentLength; $i++) {
			$segments[] = substr($string, $i, $segmentLength);
		}

		return $segments;
	}
}
