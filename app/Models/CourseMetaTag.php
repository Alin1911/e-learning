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
	
		// Counting occurrences in course_meta_tags
		$query = DB::table('course_meta_tags');
		$totalCountsMetaTags = [];
		foreach ($segments as $index => $segment) {
			$countColumn = '(
				(LENGTH(title) - LENGTH(REPLACE(title, "'.$segment.'", "")))/'.$segmentLength.' +
				(LENGTH(description) - LENGTH(REPLACE(description, "'.$segment.'", "")))/'.$segmentLength.' +
				(LENGTH(keywords) - LENGTH(REPLACE(keywords, "'.$segment.'", "")))/'.$segmentLength.' +
				(LENGTH(language) - LENGTH(REPLACE(language, "'.$segment.'", "")))/'.$segmentLength.' +
				(LENGTH(author) - LENGTH(REPLACE(author, "'.$segment.'", "")))/'.$segmentLength.'
			)';
			$totalCountsMetaTags[] = $countColumn;
		}
		
		// Subquery for counting occurrences in lessons
		$lessonsSubquery = DB::table('lessons')
			->select('course_id', DB::raw('SUM(
				(LENGTH(title) - LENGTH(REPLACE(title, "'.$searchString.'", "")))/'.$segmentLength.' +
				(LENGTH(description) - LENGTH(REPLACE(description, "'.$searchString.'", "")))/'.$segmentLength.' +
				(LENGTH(content) - LENGTH(REPLACE(content, "'.$searchString.'", "")))/'.$segmentLength.'
			) as lessonsCount'))
			->groupBy('course_id');
		
		// Joining the results and calculating the total count
		$query->leftJoinSub($lessonsSubquery, 'lesson_counts', function ($join) {
			$join->on('course_meta_tags.course_id', '=', 'lesson_counts.course_id');
		});
	
		$totalCountColumn = '('.implode(' + ', $totalCountsMetaTags).'+ COALESCE(lesson_counts.lessonsCount, 0))';
		$query->addSelect('course_meta_tags.course_id', DB::raw($totalCountColumn.' as totalCount'))
			  ->where(DB::raw($totalCountColumn), '>', 0)
			  ->orderBy('totalCount', 'desc');
	
		return $query->get()->pluck('course_meta_tags.course_id');
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
