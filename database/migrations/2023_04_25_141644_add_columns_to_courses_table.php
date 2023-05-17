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
			$table->decimal('price', 8, 2)->nullable();
			$table->decimal('discount', 5, 2)->nullable();
			$table->string('level')->nullable();
			$table->text('additional_info')->nullable();
			$table->string('duration')->nullable();
		});
	}
	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::table('courses', function (Blueprint $table) {
			$table->dropColumn(['price', 'discount', 'level', 'additional_info', 'duration']);
		});
	}
};
