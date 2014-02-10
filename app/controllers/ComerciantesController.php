<?php

/*
 *	Controlador de las operaciones con comerciantes
 */
 

class ComerciantesController extends BaseController {
	
	
	
	//procesa la pagina prin
	public function principal() {
		
		return View::make('comerciantes/principal');
	}
	
	//registro
	public function registro() {
		return View::make('comerciantes/registro');
	}
	
	//registrar persona
	public function registrar() {
		
		
		
	}
	
}

?>