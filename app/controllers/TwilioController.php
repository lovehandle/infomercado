<?php

class TwilioController extends BaseController {

	//test
	public function test() {
	
		//crea un nuevo objeto Twiml para generar xml para twilio
		$response = new Services_Twilio_Twiml();
		$response->say('Hello');
		return $response;
	}

	public function welcome()
	{
		return Response::view('twilio/welcome')->header('Content-Type', 'application/xml');
	}
	
	public function start() {
	
		$input = Input::get('Digits');
		
		if($input == '1') {
			return Response::view('twilio/opinion')->header('Content-Type', 'application/xml');
		} elseif($input == '2') {
			return "0";
		} else {
			return "0";
		}
		
	}
	
	
	//guardar las opiniones para mostrar posteriormente en la pagina
	public function opiniones() {
		
		//guardar la referencia a las URL de oipiniones
		DB::table('opiniones')->insert(array('twilio_url'=>Input::get('RecordingUrl'),'duracion'=>Input::get('RecordingDuration'),'metadata'=>''));
		return Response::view('twilio/opinion-gracias')->header('Content-Type', 'application/xml');
		
	}
	
	//procesar un posteo de una transcripcion
	public function transcripciones() {
		
		//obtener todas las variables de entrada y convertirlas en json
		//$json = json_encode(Input::all(),true);
		
		//DB::table('opiniones')->update(array('metadata'=>$json));
		
	}

}