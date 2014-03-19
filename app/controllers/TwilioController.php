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
				"timeout"=>"3",
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
		
		switch(intval($step)) {
			
			case 1:
				
				//seleccionaste el mercado____ para continuar 1, para seleccionar otro, 2
				$gather = $twiml->gather(array(
					"timeout"=>"3",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/2",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/raw/mercado0.mp3");
				$gather->play("http://www.infomercado.mx/raw/ej_mercado221.mp3");
				$gather->play("http://www.infomercado.mx/raw/otro1.mp3");
				
				$twiml->say("Error en paso 1. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				
				break;
				
			case 2:
			
				//checar la seleccion
				
				//obtener el digito presionado
				$input = Input::get('Digits');
				
				if($input == '2') {
				
					//volver a pedir el numero del mercado
					//armar la respuesta de registro seleccionado
					$gather = $twiml->gather(array(
						"timeout"=>"3",
						"finishOnKey"=>"#",
						"action"=>"/twilio-connect/registro/1",
						"method"=>"POST",
						"numDigits"=>"3"
					));
					
					$gather->play("http://www.infomercado.mx/raw/04_numero02.mp3");
					$twiml->say("Error en re-mercados. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
					//salimos de este ciclo
					break;
					
				} 
				
				//ingresa el numero de tu local
				$gather = $twiml->gather(array(
					"timeout"=>"3",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/3",
					"method"=>"POST",
					"numDigits"=>"4"
				));
				$gather->play("http://www.infomercado.mx/raw/06_local01.mp3");
				$twiml->say("Error en paso 2. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));

				break;
			
			case 3:
			
				//selecciona la categoria que pertenece a tu local -	
				$gather = $twiml->gather(array(
					"timeout"=>"3",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/4",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/raw/07_selecciona01.mp3");
				$gather->play("http://www.infomercado.mx/raw/08_categoria01.mp3");
				$twiml->say("Lo sentimos, ocurrio un error en paso 3. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				
				break;
				
			case 4:
				
				//revisar que categoria seleccionó
				//<code here>
			
				//a continuacion, preguntas y mas preguntas
				$gather = $twiml->gather(array(
					"timeout"=>"3",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/5",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/raw/09_preguntas02.mp3");
				//primer pregunta, aceptan vales?
				$gather->play("http://www.infomercado.mx/raw/10_vales02.mp3");
				$twiml->say("Lo sentimos, ocurrio un error en paso 4. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				
				break;
				
			case 5:
			
				//validar la entrada de vales
				//<code here>
				
				//preguntar si envian a domicilio
				//a continuacion, preguntas y mas preguntas
				$gather = $twiml->gather(array(
					"timeout"=>"3",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/6",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/raw/11_domicilio02.mp3");
				$twiml->say("Lo sentimos, ocurrio un error en paso 5. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				
				break;
			
			case 6:
			
				//validar la entrada de domicilio
				//<code here>
				
				//preguntar si aceptan tarjetas
				$gather = $twiml->gather(array(
					"timeout"=>"3",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/7",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/raw/12_tarjetas02.mp3");
				$twiml->say("Lo sentimos, ocurrio un error en paso 5. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				
				break;
			
			case 7:
			
				//validar la entrada de tarjetas bancarias
				//<code here>
				
				//preguntar si publican precios
				$gather = $twiml->gather(array(
					"timeout"=>"3",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/8",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/raw/13_precios01.mp3");
				$twiml->say("Lo sentimos, ocurrio un error en paso 5. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				
				break;
			
			case 8:
			
				//validar la entrada de lista de precios
				//<code here>
				
				//preguntar si quieren atencion telefonica
				$gather = $twiml->gather(array(
					"timeout"=>"3",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/9",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/raw/14_telefonica02.mp3");
				$twiml->say("Lo sentimos, ocurrio un error en paso 5. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				
				break;
				
			case 9:
			
				//checar si aceptaron informacion telefonica
				//si no, continuar
				
				$twiml->play("http://www.infomercado.mx/raw/gracias01.mp3");
				
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