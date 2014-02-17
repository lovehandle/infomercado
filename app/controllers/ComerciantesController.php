<?php

/*
 *	Controlador de las operaciones con comerciantes
 */
 

class ComerciantesController extends BaseController {

	
	//procesa la pagina principal de comerciantes
	public function principal() {
		
		//checar si el comerciante esta logueado
		if(Auth::check()) {
		
			//checar si el comerciante ya completo su registro
			if(Auth::user()->mercado_number == 0){
				return View::make('comerciantes/completareg');
			}else {
			
				//obtener la info adicional del comerciante
				$mercado = DB::select("select numero, nombre from mercados where numero=?",array(Auth::user()->mercado_number));
				
				return View::make('comerciantes/dashboard',array("mercado_datos"=>$mercado));
			}
			
		} else {
		
			return View::make('comerciantes/principal');	
		}
	}
	
	//procesar un registro
	public function registro() {
	
		
		//checar si la operacion es completar
		if(Auth::check()) {
			if(Input::has('mercado') && Input::has('local') && Input::has('cat')) {
			
				//preparar la entrada
				$updateData = array(
					rand(1,228),
					Input::has('cat')	
				);				
				
				//malditas excepciones
				try {
					
					//actualizar, devuelve el numero de rows afectados
					if(DB::update("UPDATE comerciantes SET mercado_number=?,local=10,categoria_principal=?", $updateData) > 0) {
						
						return "1";
						
					} else {
						return "0";
					}
					
					return "1";

				} catch (Exception $ex) {
					return "0";
				}
							
			} else {
				
				return "0";
			}	
			
		} else {
			
			//checar que existan datos
			if(Input::has('nombre') && Input::has('usuario') && Input::has('pass')) {
				
				//sacar los datos del POST
				$nombre = Input::get('nombre');
				$usuario = strtolower(Input::get('usuario'));
				$password = Hash::make(Input::get('pass'));
				
				//insertar en la db
				try {
					DB::insert('INSERT INTO comerciantes(nombre, password, mercado_number, local, categoria_principal, categoria_adicional, username) VALUES(?,?,0,0,0,0,?)',array($nombre,$password,$usuario));
					
					//devolver
					return "1";
					
				} catch (Exception $ex) {
					return "0";
				}
			} else {
				return "0";
			}
			
		}
		
		//si pasa algo y llegamos a este punto
		return "0";
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