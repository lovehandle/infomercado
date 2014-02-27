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
	
	//procesar la entrada recibida en welcome
	public function start() {
		
		//obtener el digito presionado
		$input = Input::get('Digits');
		
		//Objeto Twiml
		$twiml = new Services_Twilio_Twiml();

		//que hacemos?
		if($input == '1') {
			
			//return Response::view('twilio/opinion')->header('Content-Type', 'application/xml');
			//armar la respuesta de la opinion
			$twiml->play("http://www.infomercado.mx/raw/03_opinion02.mp3");
			$twiml->record(array(
				"action"=>"/twilio-connect/opiniones"
				"method"=>"POST"
				"maxLength"=>"20"
				"finishOnKey"=>"#"
				"playBeep"=>"true"
				"transcribe"=>"false"
			));
			$twiml->say("Lo sentimos, ocurrio un error. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
		
			
		} elseif($input == '2') {
			
			//armar la respuesta de registro
			$twiml->say("Opción en construcción. Gracias.",array("language"=>"es-MX","voice"=>"alice"));
			
		} else {
		
			//armar un error standar
			$twiml->say("Opción invalida. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
			
		}
		
		//rspuesta http
		$response = Response::make($twiml);
		$response->header('Content-Type', 'application/xml');
		
		return $response;

	}
	
	//procesa cuando alguien deja una opinion
	public function opiniones() {
		
		//guardar la referencia a las URL de oipiniones
		DB::table('opiniones')->insert(array(
			'twilio_url'=>Input::get('RecordingUrl'),
			'duracion'=>Input::get('RecordingDuration'),
			'metadata'=>'')
		);
		
		//Objeto Twiml
		$twiml = new Services_Twilio_Twiml();
		//armar la respuesta con el agradecimiento
		$twiml->say("Opción invalida. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
		
		//rspuesta http
		$response = Response::make($twiml);
		$response->header('Content-Type', 'application/xml');
		
		return $response;
		
	}
	
	//procesar un posteo de una transcripcion
	public function transcripciones() {
		
		//obtener todas las variables de entrada y convertirlas en json
		//$json = json_encode(Input::all(),true);
		
		//DB::table('opiniones')->update(array('metadata'=>$json));
		
	}

}