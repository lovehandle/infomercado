<?php

class TwilioController extends BaseController {
	
	//test
	public function test() {
	
		//crea un nuevo objeto Twiml para generar xml para twilio
		$twiml = new Services_Twilio_Twiml();
		$twiml->say('Hello');
		
		//preparar una respuesta http
		$response = Response::make($twiml);
		$response->header('Content-Type', 'application/xml');
		
		return $response;
	}

	//bienvenida del sistema telefonico
	public function welcome(){
	
		//Objeto Twiml
		$twiml = new Services_Twilio_Twiml();
		$gather = $twiml->gather(array(
			"timeout"=>"4",
			"finishOnKey"=>"*",
			"action"=>"/twilio-connect/start",
			"method"=>"POST",
			"numDigits"=>"1"
		));
		$gather->play("http://www.infomercado.mx/raw/01_bienvenido01.mp3");
		$gather->play("http://www.infomercado.mx/raw/02_marca02.mp3");
		$twiml->say("Lo sentimos, ocurrio un error. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
	
		//rspuesta http
		$response = Response::make($twiml);
		$response->header('Content-Type', 'application/xml');
		
		return $response;
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