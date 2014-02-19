<?php

/*
 *	Controlador de las operaciones con comerciantes
 */
 

class ComerciantesController extends BaseController {

	//funcion para manejar un array de settings
	function arrayOfSettings($number) {
	
		if($number>999 || $number < 100) {
			//invalido
			return array(0,0,0);
		}
		
		$centenas = floor($number / 100);
		$centenas = $centenas * 100;
		
		$decenas = floor(($number - $centenas) / 10);
		$decenas = $decenas * 10;
		
		$unidades = ($number - $centenas) - $decenas;
	
		return array($centenas/100,$decenas/10,$unidades);
		
	}
	
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
				
				//settings
				$settings = json_decode(Auth::user()->servicios,true);
				
				return View::make('comerciantes/dashboard',array("mercado_datos"=>$mercado,"settings"=>$settings));
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
					DB::insert('INSERT INTO comerciantes(nombre, password, mercado_number, local, categoria_principal, categoria_adicional, username, servicios) VALUES(?,?,0,0,0,0,?,0)',array($nombre,$password,$usuario));
					
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
	
	//guardar settings
	public function saveSettings() {
	
		if(Auth::check()) {
			
			$domicilio = Input::get("domicilio");
			$tarjetas = Input::get("tarjetas");
			$vales = Input::get("vales");
			$precios = Input::get("precios");
			
			$settings = json_encode(array($domicilio,$tarjetas,$vales, $precios),true);
			

			DB::update("update comerciantes set servicios=? where id=?",array($settings,Auth::user()->id));
			
			return "1";
			
		}
		
		return "0";
		
	}
	
}

?>