<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up() : void
	{
		Schema::create('tests', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->text('description');
			$table->integer('time');
			$table->unsignedBigInteger('course_id')->nullable();
			$table->foreign('course_id')->nullable()->references('id')->on('courses')->onDelete('cascade');
			$table->unsignedBigInteger('lesson_id')->nullable();
			$table->foreign('lesson_id')->nullable()->references('id')->on('lessons')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down() : void
	{
		Schema::dropIfExists('test');
	}
};
