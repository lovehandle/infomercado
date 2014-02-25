<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/ 

//ruta principal
Route::get('/', 'HomeController@showWelcome');

//ruta para informacion de PHP
Route::get('info', function() {
	phpinfo();
});

Route::get('dump-ubicaciones', function () {
	
	$results = DB::select('select * from mercados');
	
	//var_dump($results);
	print("<pre>");
	print("INSERT INTO ubicaciones(nombre, id_delegacion, direccion, id_categoria, dataset, coordenadas)\n VALUES\n"); 
	
	foreach($results as $mercado) {
		print("('MERCADO ".$mercado->nombre."', ".$mercado->delegacion.", '".$mercado->numero."', 2, 'mercados', ST_GeomFromText('SRID=4326; POINT(".$mercado->longitud." ".$mercado->latitud.")')),\n");
	}
	print("</pre>");
	
});

//ruta para el mercado
Route::get('mercados/{numero}', 'MercadoController@showMercado')->where('numero', '[0-9]+');

//ruta para listado de mercados
Route::get('mercados/{ruta}','MercadoController@listaMercados')->where('ruta','[A-Za-z\-]+');

//ruta para comerciantes
Route::get('comerciantes','ComerciantesController@principal');

//registro de comerciantes
Route::post('comerciantes/registro','ComerciantesController@registro');

//login de comerciantes
Route::post('comerciantes/login','ComerciantesController@login');

//logout
Route::get('comerciantes/logout',function(){
	Auth::logout();
	 return Redirect::to('comerciantes');
});

//login de comerciantes
Route::post('comerciantes/update','ComerciantesController@saveSettings');



/*
	Rutas para Twilio
*/

//Welcome
Route::get('twilio-connect/welcome','TwilioController@welcome');

//Procesar el input del menu inicial
Route::post('twilio-connect/start','TwilioController@start');

//Procesar una grabacion de opinion
Route::post('twilio-connect/opiniones','TwilioController@opiniones');

//Procesar una transcripcion
Route::post('twilio-connect/transcripcion','TwilioController@transcripciones');


