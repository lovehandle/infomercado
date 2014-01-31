<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		//hace la consulta con los mercados aleatorios para la prueba
		$results = DB::select('SELECT * FROM mercados ORDER BY RANDOM() LIMIT 5');	
		
		//genera la vista
		return View::make('hello', array("results"=>$results));
	}

}
