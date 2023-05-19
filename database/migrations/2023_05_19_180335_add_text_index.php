<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		DB::statement('ALTER TABLE course_meta_tags ADD FULLTEXT fulltext_index (title, description, keywords, language, author, duration, level)');
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		//
	}
};
