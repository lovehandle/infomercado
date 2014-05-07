<?php
class MercadoController extends BaseController {

    /*
     *  Algunas variables chidas ===========================================
     */

    //======================================================================

    /*
     * Listados
     */

    //por tipo de mercado
    public function lista_tipos() {

        //agarrar todas las delegaciones
        $tipos = Tipo::all();

        //retornar la vista correspondiente
        $vista = 'desktop.lista_tipos';
        if(Agent::isMobile()){
            $vista = 'movil.lista_tipos';
        }
        return View::make($vista, array("tipos"=>$tipos));

    }

    //lista por delegaciones
    public function lista_delegaciones() {

        //agarrar todas las delegaciones
        $delegaciones = Delegacion::all();

        //retornar la vista correspondiente
        $view = 'desktop.lista_delegaciones';
        if(Agent::isMobile()){
            $view='movil.lista_delegaciones';
        }
        return View::make($view, array("delegaciones"=>$delegaciones));
    }

    /**
     *	Lista mercados correspondientes a una ruta (delegacion, tipo,
     */

    public function lista_mercados($ruta) {

        //es por tipo o por delegación ?
        $tipo = Tipo::where('route','=',$ruta);
        $delegacion = Delegacion::where('route','=',$ruta);

        //return Response::json(array('tipos'=>$tipo,'delegaciones'=>$delegacion));

        //variables
        $titulo = 'Mercados';
        $mercados = NULL;

        //buscar deacuerdo a los resultados de tipo/delegacion
        if($tipo->count()>0) {
            $titulo .= ' de tipo '.$tipo->firstOrFail()->nombre;
            $mercados = Mercado::where('tipo','=',$tipo->firstOrFail()->tipo);
        }

        if($delegacion->count()>0) {
            $titulo .= ' en la delegación '.$delegacion->firstOrFail()->nombre;
            $mercados = Mercado::where('delegacion','=',$delegacion->firstOrFail()->numero);
        }

        //aventar la vista
        $vista = 'desktop.lista_mercados';
        if(Agent::isMobile()){
            $vista = 'movil.lista_mercados';
        }

        //retorna la vista
        return View::make($vista,array('mercados'=>$mercados,'titulo'=>$titulo));

    }

    //por delegacion
    /**
     * Muestra la informacion del mercado seleccionado
     */
    public function show_mercado($route)
    {

        //obtener el numero del mercado
        $parts = explode('-',$route);
        $numero = $parts[0];

        //obtener mercado y locatarios
        $mercado = Mercado::where('numero','=', $numero)->firstOrFail();
        //$locatarios = Comerciante::where('mercado_number','=',$mercado->numero);

        //aventar la vista con los datos
        $vista = 'desktop.mercado';
        if(Agent::isMobile()){
	    	$vista = 'movil.mercado';
        }
        return View::make($vista, array('mercado' => $mercado));
    }
    
    /***
    *	Mercado mas cercano
    */

    public function mercadoCercanoView() {
		if(Agent::isMobile()){
			
			//dame un pinche mercado, el que sea
			//$mercado = DB::table('mercados')->orderBy(DB::raw("RANDOM()"))->take(1)->get();
			return View::make("movil.cercano");
			
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
    


    //mostrar las ofertas por mercado
    public function ofertas_por_mercado($id) {

        if(Agent::isMobile()) {

            //buscar el mercado y las ofertas correspondientes
            $mercado = Mercado::where('numero','=', $id)->get();
            $ofertas = Oferta::where('mercado','=', $id)->get();

            //generar la vista
            return View::make('movil.ofertas',array("$mercado"=>$mercado,"ofertas"=>$ofertas));

        } else {

            return "0k";

        }
    }

}

?>
