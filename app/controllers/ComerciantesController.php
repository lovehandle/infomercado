<?php

/*
 *	Controlador de las operaciones con comerciantes
 */
 

class ComerciantesController extends BaseController {

	
	//procesa la pagina prin
	public function principal() {
		
		return View::make('comerciantes/principal');
	}
	
	//procesar un registro
	public function registro() {
	
		//sacar los datos del POST
		$nombre = Input::get('nombre');
		$usuario = Input::get('usuario');
		$password = Hash::make(Input::get('pass'));
		
		//insertar en la db
		try {
			DB::insert('INSERT INTO comerciantes(nombre, hash, mercado_number, local, categoria_principal, categoria_adicional, usuario) VALUES(?,?,0,0,0,0,?)',array($nombre,$password,$usuario));
			
			//devolver
			return "1";
			
		} catch (Exception $ex) {
			return "0";
		}
		
	}
	
	
}

?>