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
		Schema::create('forum_topics', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->text('description')->nullable();
			$table->unsignedBigInteger('forum_id');
			$table->foreign('forum_id')->references('id')->on('forums')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('test_forum_topics');
	}
};
