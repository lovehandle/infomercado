<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMercadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('mercados', function(Blueprint $table) {
         //   $table->increments('id');
			$table->integer('numero');
			$table->string('nombre');
			$table->integer('fid');
			$table->integer('locales');
			$table->integer('tipo');
			$table->text('tipo_desc');
			$table->text('latitud');
			$table->text('longitud');
			$table->integer('delegacion');
			$table->text('delegacion_nombre');
			$table->datetime('actualizado');
			$table->text('direccion');
			$table->integer('cp');
			$table->textcd('horario');
	//		$table->timestamps();
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('mercados');
	}

}
