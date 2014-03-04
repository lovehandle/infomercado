<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComerciantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('comerciantes', function(Blueprint $table) {
            		$table->increments('id');
			$table->string('nombre');
			$table->string('password');
			$table->integer('mercado_number');
			$table->integer('local');
			$table->integer('categoria_principal');
			$table->integer('categoria_adicional');
			$table->string('username');
			$table->text('servicios');
			$table->timestamps();
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('comerciantes');
	}

}
