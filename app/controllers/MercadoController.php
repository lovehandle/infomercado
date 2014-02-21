<?php
class MercadoController extends BaseController {

    /**
     * Muestra la informacion base del mercado seleccionado
     */
    public function showMercado($id)
    {
		//hacer el query al mercado
        //$mercado = DB::select("SELECT * FROM mercados WHERE numero=?",array($id));
        
        $mercado = Mercado::find($id);

        $locatarios = DB::select("select * from comerciantes where mercado_number=?",array($id));
		
		//var_dump($mercado[0]);
		
		//armar la vista
       return View::make('mercado', array('mercado' => $mercado[0],'locatarios'=>$locatarios));
    }
    
    /**
    *	Lista mercados correspondientes a una ruta (delegacion, tipo, 
    */
    
    public function listaMercados($ruta) {
	    
	    //checar la ruta del mercado
	    
	    //rutas por delegacion
	    $mercados = DB::select("SELECT * FROM mercados WHERE replace(lower(delegacion_nombre),' ','-')=?",array($ruta));
	    
	    //checar si existen o si la ruta no refleja nada
	    
	    if(sizeof($mercados) <= 0) {
	    	//buscar por categoria
			$mercados = DB::select("SELECT * FROM mercados WHERE replace(lower(tipo_desc),' ','-')=?",array($ruta));		  
	    }
	    
	    //checar nuevamente y lanzar la respuesta correcta
	    if(sizeof($mercados) > 0){
	    	$delegacion = str_replace("-"," ",strtoupper($ruta));
	    	return View::make('lista-mercados', array('mercados' => $mercados,'delegacion'=>$delegacion));
	    } else {
	    	return Response::view('404', array(), 404);
	    }
	    
    }

}

?>
