<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up()
	{
		DB::unprepared("
        CREATE PROCEDURE SearchCourseMetaTags(IN text VARCHAR(255))
        BEGIN
            SELECT course_id FROM course_meta_tags
            WHERE MATCH(title, description, keywords, language, author, duration, level)
            AGAINST(text IN NATURAL LANGUAGE MODE);
        END
        ");
	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		DB::unprepared('DROP PROCEDURE IF EXISTS SearchCourseMetaTags');
	}
};
