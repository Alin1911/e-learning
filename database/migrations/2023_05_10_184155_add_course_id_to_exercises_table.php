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
		Schema::table('exercises', function (Blueprint $table) {
			$table->unsignedBigInteger('course_id')->nullable()->after('id');

			// Crearea cheii străine dacă este necesar
			$table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::table('exercises', function (Blueprint $table) {
			// Ștergerea cheii străine dacă a fost creată în metoda `up()`
			$table->dropForeign(['course_id']);

			$table->dropColumn('course_id');
		});
	}

};
