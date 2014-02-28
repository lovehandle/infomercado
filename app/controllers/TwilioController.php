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
				"action"=>"/twilio-connect/opiniones",
				"method"=>"POST",
				"maxLength"=>"20",
				"finishOnKey"=>"#",
				"playBeep"=>"true",
				"transcribe"=>"false"
			));
			$twiml->say("Lo sentimos, ocurrio un error. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
		
			
		}elseif($input == '2') {
			
			//armar la respuesta de registro seleccionado
			$gather = $twiml->gather(array(
				"timeout"=>"4",
				"finishOnKey"=>"#",
				"action"=>"/twilio-connect/registro/1",
				"method"=>"POST",
				"numDigits"=>"3"
			));
			
			$gather->play("http://www.infomercado.mx/raw/04_numero02.mp3");
			$twiml->say("Lo sentimos, ocurrio un error. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
			
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
	
	//procesamiento de los pasos de registro
	
	public function registro($step) {
		
		//Objeto Twiml
		$twiml = new Services_Twilio_Twiml();
		
		switch($step) {
			
			case 1:
				
				//seleccionaste el mercado____ para continuar 1, para seleccionar otro, 2
				$gather = $twiml->gather(array(
					"timeout"=>"4",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/2",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/raw/05_seleccion00.mp3");
				$twiml->say("Lo sentimos, ocurrio un error. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				
				break;
				
			case 2:
				
				//ingresa el numero de tu local
				$gather = $twiml->gather(array(
					"timeout"=>"4",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/3",
					"method"=>"POST",
					"numDigits"=>"4"
				));
				$gather->play("http://www.infomercado.mx/raw06_local01.mp3");
				$twiml->say("Lo sentimos, ocurrio un error. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));

				break;
			
			case 3:
			
				//ingresa el numero de tu local
				$gather = $twiml->gather(array(
					"timeout"=>"4",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/4",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/07_selecciona01.mp3");
				$gather->play("http://www.infomercado.mx/08_categoria01.mp3");
				$twiml->say("Lo sentimos, ocurrio un error. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				
				break;
				
			case 4:
				$twiml->say("Gracias.",array("language"=>"es-MX","voice"=>"alice"));				
				break;
				
			default:
				$twiml->say("Opción invalida. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				break;
		}
		
		//rspuesta http
		$response = Response::make($twiml);
		$response->header('Content-Type', 'application/xml');
		
		return $response;
		
	}
	

}