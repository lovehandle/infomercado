<?php

class Mercado extends Eloquent {
	
	protected $table = 'mercados';

	//factory
	public static $factory = array(
		'numero' =>'integer',
		'nombre' => 'string',
		'fid' => 'integer',
		'locales'=>'integer',
		'tipo'=>'integer',
		'tipo_desc'=>'string',
		'latitud'=>'string',
		'longitud'=>'string',
		'delegacion'=>'integer',
		'delegacion_nombre'=>'string',
		'actualizado'=>'datetime',
		'direccion'=>'string',
		'cp'=>'integer',
		'horario'=>'string',
		'estacionamiento'=>'boolean',
		'aniversario'=>'datetime'
	);

}