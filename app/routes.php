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

//explora
Route::get('explora', 'HomeController@explora');
Route::get('/', 'HomeController@home');

//mercado mas cercano segun lat+lng
Route::get('mercados/cercano', 'MercadoController@mercadoCercanoView');

//ruta para el mercado
Route::get('mercados/{numero}', 'MercadoController@showMercado')->where('numero', '[0-9]+');

//ruta para las ofertas
Route::get('mercados/{numero}/ofertas','MercadoController@ofertas_por_mercado')->where('numero', '[0-9]+');

//ruta para listado de mercados
Route::get('mercados/{ruta}','MercadoController@listaMercados')->where('ruta','[A-Za-z\-]+');

Route::post('mercados/cercano.json','MercadoController@mercadoCercano');



//rutas para comerciantes

//principal
Route::get('comerciantes','ComerciantesController@principal');

//registro de comerciantes
Route::post('comerciantes/registro','ComerciantesController@registro');

//login de comerciantes
Route::post('comerciantes/login','ComerciantesController@login');

//postear una promocion
Route::post('comerciantes/nuevaoferta','OfertasController@create');

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

//Registro de comerciantes via telefonica
//Route::get('/registro/{step}','TwilioController@registro');

Route::any('twilio-connect/registro/{id}','TwilioController@registro');
//Route::pattern('id', '[0-9]+');

/*
Route::any('twilio-connect/registro/{id}', function($id)
{
    // Only called if {id} is numeric.
    return Redirect::action('TwilioController@registro', array($id));
});*/

//Test
Route::get('twilio-connect/test','TwilioController@test');

//Welcome
Route::get('twilio-connect/welcome','TwilioController@welcome');

//Procesar el input del menu inicial
Route::post('twilio-connect/start','TwilioController@start');

//Procesar una grabacion de opinion
Route::post('twilio-connect/opiniones','TwilioController@opiniones');

//ruta para informacion de PHP
Route::get('info', function() {
	phpinfo();
});

//########### Rutas para pruebas ############################

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



