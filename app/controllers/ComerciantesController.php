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
		
		return 1
		
	}
	
	
}

?>