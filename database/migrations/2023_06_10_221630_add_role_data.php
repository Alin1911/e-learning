<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up()
	{
		// Adăugarea de date inițiale
		DB::table('roles')->insert([
			['name' => 'admin'],
			['name' => 'user']
		]);
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		//
	}
};
