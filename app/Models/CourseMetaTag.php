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

		$query = DB::table('course_meta_tags');

		$totalCounts = [];
		foreach ($segments as $index => $segment) {
			$countColumn = '(
                (LENGTH(title) - LENGTH(REPLACE(title, "'.$segment.'", "")))/'.$segmentLength.' +
                (LENGTH(description) - LENGTH(REPLACE(description, "'.$segment.'", "")))/'.$segmentLength.' +
                (LENGTH(keywords) - LENGTH(REPLACE(keywords, "'.$segment.'", "")))/'.$segmentLength.' +
                (LENGTH(language) - LENGTH(REPLACE(language, "'.$segment.'", "")))/'.$segmentLength.' +
                (LENGTH(author) - LENGTH(REPLACE(author, "'.$segment.'", "")))/'.$segmentLength.'
            )';
			$query->addSelect(DB::raw($countColumn.' as count'.$index));
			$totalCounts[] = $countColumn;
		}
		$query->addSelect('course_id', DB::raw('('.implode(' + ', $totalCounts).') as totalCount'))
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
