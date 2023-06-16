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
		Schema::create('exercise_fill_in_the_blank_items', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('exercise_id');
			$table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
			$table->text('word');
			$table->integer('position');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down() : void
	{
		Schema::dropIfExists('exercise_fill_in_the_blank_items');
	}
};
