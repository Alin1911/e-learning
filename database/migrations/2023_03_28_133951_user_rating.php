<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::dropIfExists('user_ratings');
	
		Schema::create('user_activity', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->string('activity_model');
			$table->unsignedBigInteger('activity_id');
			$table->decimal('rating', 3, 2)->default(0.00);
			$table->text('review_text')->nullable();
			$table->timestamps();
	
			$table->foreign('user_id')->references('id')->on('users');
			$table->index('user_id');
		});
	}
	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		//
	}
};
