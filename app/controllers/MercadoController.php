<?php
class MercadoController extends BaseController {

    /**
     * Muestra la informacion base del mercado seleccionado
     */
    public function showMercado($id)
    {
		//hacer el query al mercado
        $mercado = DB::select("SELECT * FROM mercados WHERE numero=?",array($id));
		
		//var_dump($mercado[0]);
		
		//armar la vista
       return View::make('mercado', array('mercado' => $mercado[0]));
    }

}

?>
