<?php
class MercadoController extends BaseController {

    /**
     * Muestra la informacion base del mercado seleccionado
     */
    public function showMercado($id)
    {
		//hacer el query al mercado
        //$mercado = DB::select("SELECT * FROM mercados WHERE numero=?",array($id));
        
        $mercado = Mercado::where('numero','=', $id)->get();
        $locatarios = Comerciante::where('mercado_number','=',$id);
		
		//armar la vista
       return View::make('mercado', array('mercado' => $mercado[0],'locatarios'=>$locatarios));
    }
    
    /***
    *	Mercado mas cercano
    */
    
    public function mercadoCercanoView() {
		if(Agent::isMobile()){
			
			//dame un pinche mercado, el que sea
			//$mercado = DB::table('mercados')->orderBy(DB::raw("RANDOM()"))->take(1)->get();
			return View::make("cercano");
			
		} else {
			return View::make("hello");
		}
    }
    
    public function mercadoCercano() {
	    
	    //lat / lng del input
	    $latitud = Input::get('lat');
	    $longitud = Input::get('lng');
	    
	    //query
	    $mercados = DB::table('mercados')
                     ->select(DB::raw("nombre, numero, locales, latitud, longitud, tipo_desc, ST_Distance(coordenadas, ST_GeomFromText('POINT(".$longitud." ". $latitud.")',4326)) as distancia"))
                     ->where(DB::raw("ST_DWithin(coordenadas,ST_GeomFromText('POINT(".$longitud." ".$latitud.")',4326),800) and not latitud is null"))
                     ->orderBy('distancia','asc')
                     ->get();
        
        return Response::json(array('mercados' => $mercados));
	    
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
