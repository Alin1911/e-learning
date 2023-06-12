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
			['name' => 'user'],
			['name' => 'teacher'],
			['name' => 'student']
		]);
		DB::table('categories')->insert([
			['name' => 'Programare'],
			['name' => 'Sport'],
			['name' => 'Natura'],
			['name' => 'Muzica'],
			['name' => 'Arta'],
			['name' => 'Culinar'],
			['name' => 'Jocuri'],
			['name' => 'Afaceri'],
			['name' => 'Educatie'],
			['name' => 'Sanatate'],
			['name' => 'Religie'],
			['name' => 'Filme'],
			['name' => 'Moda'],
			['name' => 'Auto'],
			['name' => 'Calatorii'],
			['name' => 'Fotografie'],
			['name' => 'Dans'],
			['name' => 'Teatru'],
			['name' => 'Literatura'],
			['name' => 'Psihologie'],
			['name' => 'Psihanaliza'],
			['name' => 'Psihiatrie'],
			['name' => 'Medicina'],
			['name' => 'Drept'],
			['name' => 'Marketing'],
			['name' => 'Finante'],
			['name' => 'Economie'],
			['name' => 'Politica'],
			['name' => 'Istorie'],
			['name' => 'Geografie'],
			['name' => 'Biologie'],
			['name' => 'Chimie'],
			['name' => 'Fizica'],
			['name' => 'Matematica'],
			['name' => 'Informatica'],
			['name' => 'Electronica'],
			['name' => 'Electrotehnica'],
			['name' => 'Mecanica'],
			['name' => 'Mecatronica'],
			['name' => 'Cursuri'],
			['name' => 'Altele']
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
