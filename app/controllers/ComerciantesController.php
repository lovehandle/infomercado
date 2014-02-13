<?php

/*
 *	Controlador de las operaciones con comerciantes
 */
 

class ComerciantesController extends BaseController {

	
	//procesa la pagina prin
	public function principal() {
		
		if(Auth::check()) {
		
			return View::make('comerciantes/dashboard');
			
		} else {
		
			return View::make('comerciantes/principal');	
		}
	}
	
	//procesar un registro
	public function registro() {
	
		//sacar los datos del POST
		$nombre = Input::get('nombre');
		$usuario = Input::get('usuario');
		$password = Hash::make(Input::get('pass'));
		
		//insertar en la db
		try {
			DB::insert('INSERT INTO comerciantes(nombre, password, mercado_number, local, categoria_principal, categoria_adicional, username) VALUES(?,?,0,0,0,0,?)',array($nombre,$password,$usuario));
			
			//devolver
			return "1";
			
		} catch (Exception $ex) {
			return "0";
		}
		
	}
	
	//login
	public function login() {
		
		//ejecutar la autentificacion
		
		if(Auth::attempt(array('username'=>Input::get('usuario'),'password'=>Input::get('pass')))){
			
			return '1';
			
		} else {
			
			return '00'.Input::get('usuario')."::".Input::get('pass');
		}
		
	}
	
	
}

?>