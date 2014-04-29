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

//home
Route::get('/', 'HomeController@home');

Route::get('/home', 'HomeController@home_ab');

/*
 * Rutas para Mercados /////////////////////////////////////////////////////////////////////////////
 */

//listado de tipos
Route::get('mercados/tipos', 'MercadoController@lista_tipos');

//listado de delegaciones
Route::get('mercados/delegaciones', 'MercadoController@lista_delegaciones');

//ubicador de rutas mixtas
Route::get('mercados/{ruta}','MercadoController@lista_mercados')->where('ruta','[A-Za-z\-]+');

//ruta para el mercado
Route::get('mercados/{mercado}', 'MercadoController@show_mercado')->where('mercado', '[0-9]{1,3}-[A-Za-z0-9\-]+');



////////////////////////////////////////////////////////////////////////////////////////////////////



Route::get('explora', 'HomeController@explora');

//mercado mas cercano segun lat+lng
Route::get('mercados/cercano', 'MercadoController@mercadoCercanoView');





//ruta para las ofertas
Route::get('mercados/{numero}/ofertas','MercadoController@ofertas_por_mercado')->where('numero', '[0-9]+');



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
 *  #########################################################################################
	Rutas para Twilio
*/

//endpoint inicial
Route::get('twilio-connect/welcome','TwilioController@welcome');

//Procesar el input del menu inicial
Route::post('twilio-connect/start','TwilioController@start');

//Procesar una grabacion de opinion
Route::post('twilio-connect/opiniones','TwilioController@opiniones');

//Registro de comerciantes via telefonica
Route::any('twilio-connect/registro/{id}','TwilioController@registro');


// termina twilio ###############################################################################


//ruta para informacion de PHP
Route::get('info', function() {
	phpinfo();
});

//########### Rutas para pruebas ############################
Route::get('nombres',function(){

    $mercados = DB::table("mercados")->get();

    print("<pre>");
    foreach($mercados as $mercado) {
        print($mercado->nombre."\n");
    }
    print("</pre>");

});

Route::get('data.json', function () {

    //$results = DB::select('select *  from mercados where tipo = 1');
	$results = DB::select('select distinct tipo, tipo_desc from mercados order by tipo asc');

    return Response::json($results);



	//var_dump($results);
	//print("<pre>");
	//print("INSERT INTO ubicaciones(nombre, id_delegacion, direccion, id_categoria, dataset, coordenadas)\n VALUES\n");
	
	//foreach($results as $mercado) {
		//print("('MERCADO ".$mercado->nombre."', ".$mercado->delegacion.", '".$mercado->numero."', 2, 'mercados', ST_GeomFromText('SRID=4326; POINT(".$mercado->longitud." ".$mercado->latitud.")')),\n");
	//}

	//print("</pre>");
	
});



