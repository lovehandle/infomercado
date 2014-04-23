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

        //retornar la vista correspondiente
        if(Agent::isMobile()){
            return View::make('movil.lista_tipos');
        }else{
            return View::make('desktop.lista_tipos');
        }

    }

    //lista por delegaciones
    public function lista_delegaciones() {

        //agarrar todas las delegaciones
        $delegaciones = DB::table('delegaciones')->get();

        //retornar la vista correspondiente
        if(Agent::isMobile()){
            return View::make('movil.lista_delegaciones');
        }else{
            return View::make('desktop.lista_delegaciones',array("delegaciones"=>$delegaciones));
        }
    }

    /**
     *	Lista mercados correspondientes a una ruta (delegacion, tipo,
     */

    public function lista_mercados($ruta) {

        //buscar mercados por delegacion
        $mercados_delegacion = DB::table("mercados")
            ->join("delegaciones","mercados.delegacion","=","delegaciones.numero")
            ->select("mercados.nombre","mercados.numero")
            ->where("delegaciones.route","=",$ruta)->get();

        //ya estaba esta parte por tipo
        //buscar mercados por tipo
        $mercados_tipo = DB::table("mercados")
            ->join("tipos","mercados.tipo","=","tipos.tipo")
            ->select("mercados.nombre","mercados.numero")
            ->where("tipos.route","=",$ruta)->get();

        //armar los objetos
        $mercados = NULL;
        if(count($mercados_delegacion)>0 ){
            $delegacion = Delegacion::where("route","=",$ruta)->firstOrFail();
            $titulo = "Mercados en ".$delegacion->nombre;
            $mercados = $mercados_delegacion;
        }
        if(count($mercados_tipo)>0){
            $tipo = Tipo::where("route","=",$ruta)->firstOrFail();
            $titulo = "".$tipo->nombre;
            $mercados = $mercados_tipo;
        }

        //var_dump($mercados);
        //aventar la vista
        if(Agent::isMobile()){
            return View::make("movil.lista_mercados",array("mercados"=>$mercados));
        }else{
            return View::make("desktop.lista_mercados",array("mercados"=>$mercados,"titulo"=>$titulo));
        }

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
