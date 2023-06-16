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
			$table->foreignId('category_id')->nullable()->constrained()->onDelete('set null')->after('description');
			$table->string('language')->nullable()->after('description');
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
