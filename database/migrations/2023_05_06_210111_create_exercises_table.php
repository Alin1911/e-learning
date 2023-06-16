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
		Schema::create('exercises', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('test_id')->nullable();
			$table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
			$table->string('question');
			$table->text('exercise_type');
			$table->integer('points');
			$table->json('options')->nullable();
			$table->json('ordering_items')->nullable();
			$table->json('fill_in_the_blank_items')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down() : void
	{
		Schema::dropIfExists('exercises');
	}
};
