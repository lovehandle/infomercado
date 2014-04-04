<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddEstacionamientoToMercadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mercados', function(Blueprint $table) {
			$table->boolean('estacionamiento');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mercados', function(Blueprint $table) {
			$table->dropColumn('estacionamiento');
		});
	}

}
