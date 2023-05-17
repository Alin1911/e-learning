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
		Schema::table('courses', function (Blueprint $table) {
			$table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
			$table->foreignId('instructor_id')->nullable()->constrained('instructors')->onDelete('set null');
			$table->string('language')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 */
	public function down() : void
	{
		Schema::table('courses', function (Blueprint $table) {
			//
		});
	}
};
