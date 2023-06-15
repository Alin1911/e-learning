<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up()
	{
		Schema::create('course_meta_tags', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('course_id');
			$table->string('title');
			$table->text('description');
			$table->string('keywords');
			$table->string('language');
			$table->string('author');
			$table->date('publish_date');
			$table->string('duration');
			$table->string('level');
			$table->decimal('price', 8, 2);
			$table->timestamps();

			$table->foreign('course_id')
				->references('id')
				->on('courses')
				->onDelete('cascade');
		});
		DB::statement('ALTER TABLE course_meta_tags ADD FULLTEXT fulltext_index (title, description, keywords, language, author, duration, level)');
	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::dropIfExists('course_meta_tags');
	}
};
