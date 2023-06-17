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
	];

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public static function countSegmentOccurrences($searchString, $segmentLength)
	{
		$segments = self::splitStringIntoSegments($searchString, $segmentLength);

		// Interogare pentru tabela course_meta_tags
		$metaQuery = self::buildQueryForCourseMetaTags($segments, $segmentLength);

		// Interogare pentru tabela lessons
		$lessonsQuery = self::buildQueryForLessons($segments, $segmentLength);

		// Adună scorurile din ambele interogări pentru fiecare course_id
		$combinedScores = [];
		foreach ($metaQuery->get() as $result) {
			$combinedScores[$result->course_id] = $result->totalCount;
		}

		foreach ($lessonsQuery->get() as $result) {
			if (isset($combinedScores[$result->course_id])) {
				$combinedScores[$result->course_id] += $result->totalCount;
			} else {
				$combinedScores[$result->course_id] = $result->totalCount;
			}
		}

		// Sortează rezultatele în funcție de scorul total
		arsort($combinedScores);

		return array_keys($combinedScores);
	}

	private static function buildQueryForCourseMetaTags($segments, $segmentLength)
	{
		$query = DB::table('course_meta_tags');
		$totalCounts = [];
		foreach ($segments as $segment) {
			$lowerSegment = strtolower($segment);
			$countColumn = '(
				(LENGTH(LOWER(title)) - LENGTH(REPLACE(LOWER(title), "' . $lowerSegment . '", "")))/' . $segmentLength . ' +
				(LENGTH(LOWER(description)) - LENGTH(REPLACE(LOWER(description), "' . $lowerSegment . '", "")))/' . $segmentLength . ' +
				(LENGTH(LOWER(keywords)) - LENGTH(REPLACE(LOWER(keywords), "' . $lowerSegment . '", "")))/' . $segmentLength . ' +
				(LENGTH(LOWER(language)) - LENGTH(REPLACE(LOWER(language), "' . $lowerSegment . '", "")))/' . $segmentLength . ' +
				(LENGTH(LOWER(author)) - LENGTH(REPLACE(LOWER(author), "' . $lowerSegment . '", "")))/' . $segmentLength . '
			)';
			$totalCounts[] = $countColumn;
		}
		return $query->select('course_id', DB::raw('(' . implode(' + ', $totalCounts) . ') as totalCount'))
			->where(DB::raw('(' . implode(' + ', $totalCounts) . ')'), '>', 0);
	}

	private static function buildQueryForLessons($segments, $segmentLength)
	{
		$query = DB::table('lessons');
		$totalCounts = [];
		foreach ($segments as $segment) {
			$lowerSegment = strtolower($segment);
			$countColumn = '(
				(LENGTH(LOWER(title)) - LENGTH(REPLACE(LOWER(title), "' . $lowerSegment . '", "")))/' . $segmentLength . ' +
				(LENGTH(LOWER(description)) - LENGTH(REPLACE(LOWER(description), "' . $lowerSegment . '", "")))/' . $segmentLength . ' +
				(LENGTH(LOWER(content)) - LENGTH(REPLACE(LOWER(content), "' . $lowerSegment . '", "")))/' . $segmentLength . '
			)';
			$totalCounts[] = $countColumn;
		}
		return $query->select('course_id', DB::raw('SUM(' . implode(' + ', $totalCounts) . ') as totalCount'))
			->where(DB::raw('(' . implode(' + ', $totalCounts) . ')'), '>', 0)
			->groupBy('course_id');
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
