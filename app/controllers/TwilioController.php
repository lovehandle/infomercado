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
	
		//logs
		Log::info('Punto de Entrada', array('sesion' => Session::getId(),'request_data'=>Input::all()));
		
		//Objeto Twiml
		$twiml = new Services_Twilio_Twiml();
		
		//hubo un intento anterior?
		$intentos = Input::get('intento', '0');
		
		
		//checar si son 3 intentos, drop call
		if( (int)$intentos >=3 ) {
			$twiml->say("No recibimos una respuesta. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
		} else {
			
			//iniciar la sesion guardando el telefono de entrada
			Session::put('telefono',Input::get("From"));
			
			$next = (int)$intentos;
			$next++;
			
			$gather = $twiml->gather(array(
				"timeout"=>"3",
				"finishOnKey"=>"*",
				"action"=>"/twilio-connect/start",
				"method"=>"POST",
				"numDigits"=>"1"
			));
			
			//cuando no hay intentos posteriores, dar la bienvenida
			if( (int)$intentos <= 0) { 
				$gather->play("http://www.infomercado.mx/raw/01_bienvenido01.mp3");	
			}
			$gather->play("http://www.infomercado.mx/raw/02_marca02.mp3");
			
			//no hay respuesta, redireccionar
			$twiml->redirect("/twilio-connect/welcome?intento=".$next, array("method"=>"GET"));
			
		}
		
	
		//respuesta http
		$response = Response::make($twiml);
		$response->header('Content-Type', 'application/xml');
		
		return $response;
	}
	
	//procesar la entrada recibida en welcome
	public function start() {
	
		//logs
		Log::info('Primera seleccion', array('sesion' => Session::getId()));
		
		//obtener el digito presionado
		$input = Input::get('Digits');
		
		//Objeto Twiml
		$twiml = new Services_Twilio_Twiml();

		//que hacemos?
		if($input == '1') {
		
			//logs
			Log::info('Opcion 1', array('sesion' => Session::getId()));
			
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

			//logs
			Log::info('Opcion 2', array('sesion' => Session::getId()));
			
			//armar la respuesta de registro seleccionado
			$gather = $twiml->gather(array(
				"timeout"=>"4",
				"finishOnKey"=>"#",
				"action"=>"/twilio-connect/registro/1",
				"method"=>"POST",
				"numDigits"=>"3"
			));
			$gather->play("http://www.infomercado.mx/raw/04_numero02.mp3");
			
			//redirect si no se reciben los digitos
			$twiml->redirect("/twilio-connect/start?intento=1");
						
		} else {
		
			if(Input::has('intento')) {
				
				//no hay digits, pero hay intento, no introdujo un numero de mercado
				
				//hubo un intento anterior?
				$intentos = Input::get('intento', '0');
				
				//tres o mas intentos
				if((int)$intentos >= 3) {
					$twiml->say("No recibimos una respuesta. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				} else {
					
					$next = (int)$intentos; $next++;
				
					//armar la respuesta de registro seleccionado
					$gather = $twiml->gather(array(
						"timeout"=>"4",
						"finishOnKey"=>"#",
						"action"=>"/twilio-connect/registro/1",
						"method"=>"POST",
						"numDigits"=>"3"
					));
					$gather->play("http://www.infomercado.mx/raw/04_numero02.mp3");
					
					//redirect si no se reciben los digitos
					$twiml->redirect("/twilio-connect/start?intento=".$next);	
					
				}
				
				
			} else {
			
				//no viene intento en el GET, entonces es una opcion invalida
				$twiml->say("Opción Inválida.",array("language"=>"es-MX","voice"=>"alice"));
				$twiml->redirect("/twilio-connect/welcome?intento=1", array("method"=>"GET"));
				
			}
			
		}
		
		//rspuesta http
		$response = Response::make($twiml);
		$response->header('Content-Type', 'application/xml');
		
		return $response;

	}
	
	//procesa cuando alguien deja una opinion
	public function opiniones() {
		
		//logs
		Log::info('Guardar opinion', array('sesion' => Session::getId()));
		
		//guardar la referencia a las URL de oipiniones
		DB::table('opiniones')->insert(array(
			'twilio_url'=>Input::get('RecordingUrl'),
			'duracion'=>Input::get('RecordingDuration'),
			'metadata'=>'')
		);
		
		//Objeto Twiml
		$twiml = new Services_Twilio_Twiml();
		//armar la respuesta con el agradecimiento
		$twiml->say("Fin de la opinion.",array("language"=>"es-MX","voice"=>"alice"));
		
		//rspuesta http
		$response = Response::make($twiml);
		$response->header('Content-Type', 'application/xml');
		
		return $response;
		
	}
	
	//procesamiento de los pasos de registro
	
	public function registro($step) {
	
		//logs
		Log::info('Entry del Registro', array('sesion' => Session::getId(),'step'=>$step));
		
		//Objeto Twiml
		$twiml = new Services_Twilio_Twiml();
		
		switch(intval($step)) {
			
			case 1:
			
				//checar el contador de mercados y verificar que no sea mayor
				$cuantos = Mercado::all()->count();
				
				if(Input::get('Digits')>$cuantos) {
					$twiml->say("El mercado que ingresaste no existe.",array("language"=>"es-MX","voice"=>"alice"));
					$twiml->redirect("/twilio-connect/start?intento=2");
					break;
				}
				
				//ubicar el mercado en la base de datos
				$mimercado = Mercado::where('numero', '=', Input::get("Digits"))->firstOrFail();
				
				
				
				Log::info('Mercado: '.Input::get('Digits'));
				
				//guardar en la session el mercado seleccionado
				Session::put('mercado',Input::get("Digits"));
				
				//seleccionaste el mercado____ para continuar 1, para seleccionar otro, 2
				$gather = $twiml->gather(array(
					"timeout"=>"4",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/2",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/raw/mercado0.mp3");
				//decir el numero y nombre de mercado roboticamente
				$gather->say(", ,".$mimercado->numero.", , ".$mimercado->nombre,array("language"=>"es-MX","voice"=>"alice"));
				$gather->play("http://www.infomercado.mx/raw/otro1.mp3");
				
				//segundo intento
				$gather = $twiml->gather(array(
					"timeout"=>"4",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/2",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/raw/otro1.mp3");
				
				//tercer intento
				$gather = $twiml->gather(array(
					"timeout"=>"4",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/2",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/raw/otro1.mp3");
				
				//no reicibimos respuesta
				$twiml->say("No recibimos una respuesta. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				
				break;
				
			case 2:
			
				//checar la seleccion
				
				//obtener el digito presionado
				$input = Input::get('Digits');
				
				if($input == '2') {
				
					//volver a pedir el numero del mercado
					//armar la respuesta de registro seleccionado
					$gather = $twiml->gather(array(
						"timeout"=>"2",
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
				
				//segundo intento
				$gather = $twiml->gather(array(
					"timeout"=>"3",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/3",
					"method"=>"POST",
					"numDigits"=>"4"
				));
				$gather->play("http://www.infomercado.mx/raw/06_local01.mp3");
				
				//tercer intento
				$gather = $twiml->gather(array(
					"timeout"=>"3",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/3",
					"method"=>"POST",
					"numDigits"=>"4"
				));
				$gather->play("http://www.infomercado.mx/raw/06_local01.mp3");
				
				//no recibimos una respuesta
				$twiml->say("No recibimos una respuesta. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));

				break;
			
			case 3:
			
				//checar si el local no ha sido seleccionado anteriormente
				$existe = Comerciante::where('local', '=', Input::get("Digits"))->count();
				if($existe >= 1) {
					$twiml->say("Local seleccionado anteriormente. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
					//redirect para intentar meter otro local
					break;
				}
				
				//checar si existe el local en el mercado seleccionado
				$locales = Mercado::where('numero', '=', Session::get('mercado'))->firstOrFail();
				if(Input::get("Digits") > $locales) {
					$twiml->say("El local que ingresaste no existe en el mercado seleccionado. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
					
					//redirect para intentar meter otro local
					break;
				}
			
				//guardar el numero del local seleccionado
				Session::put('local',Input::get("Digits"));
			
				//selecciona la categoria que pertenece a tu local -	
				$gather = $twiml->gather(array(
					"timeout"=>"4",
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
				
				//guardar la categoria seleccionada
				Session::put('categoria',Input::get("Digits"));
			
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
				if(Input::get("Digits")=='1') {
					Session::put('vales','1');
				} else {
					Session::put('vales','0');
				}
				
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
				if(Input::get("Digits")=='1') {
					Session::put('a-domicilio','1');
				} else {
					Session::put('a-domicilio','0');
				}
				
				//preguntar si aceptan tarjetas
				$gather = $twiml->gather(array(
					"timeout"=>"4",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/7",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/raw/12_tarjetas02.mp3");
				$twiml->say("Lo sentimos, ocurrio un error en paso 6. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				
				break;
			
			case 7:
			
				//validar la entrada de tarjetas bancarias
				if(Input::get("Digits")=='1') {
					Session::put('tarjeta','1');
				} else {
					Session::put('tarjeta','0');
				}
				
				//preguntar si publican precios
				$gather = $twiml->gather(array(
					"timeout"=>"3",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/8",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/raw/13_precios01.mp3");
				$twiml->say("Lo sentimos, ocurrio un error en paso 7. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				
				break;
			
			case 8:
			
				//validar la entrada de lista de precios
				if(Input::get("Digits")=='1') {
					Session::put('precios','1');
				} else {
					Session::put('precios','0');
				}
				
				//preguntar si quieren atencion telefonica
				$gather = $twiml->gather(array(
					"timeout"=>"4",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/9",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/raw/14_telefonica02.mp3");
				$twiml->say("Lo sentimos, ocurrio un error en paso 8. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				
				break;
				
			case 9:
			
				//obtener el digito presionado
				$input = Input::get('Digits');
				
				//checar si aceptaron informacion telefonica
				//si no, continuar
				if($input == '1') {
					
					//pedir el numero telefonico
					$gather = $twiml->gather(array(
						"timeout"=>"5",
						"finishOnKey"=>"#",
						"action"=>"/twilio-connect/registro/10",
						"method"=>"POST",
						"numDigits"=>"10"
					));
					$gather->play("http://www.infomercado.mx/raw/15_telefono02.mp3");
					$twiml->say(" ",array("language"=>"es-MX","voice"=>"alice"));
					$gather = $twiml->gather(array(
						"timeout"=>"5",
						"finishOnKey"=>"#",
						"action"=>"/twilio-connect/registro/10",
						"method"=>"POST",
						"numDigits"=>"10"
					));
					$gather->play("http://www.infomercado.mx/raw/15_telefono02.mp3");
					$twiml->say(" ",array("language"=>"es-MX","voice"=>"alice"));
					$gather = $twiml->gather(array(
						"timeout"=>"5",
						"finishOnKey"=>"#",
						"action"=>"/twilio-connect/registro/10",
						"method"=>"POST",
						"numDigits"=>"10"
					));
					$gather->play("http://www.infomercado.mx/raw/15_telefono02.mp3");
					$twiml->say("Lo sentimos, ocurrio un error en paso 9. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
					
					break;
					
				}
				
				Session::put('atencion-tel','0');
				
				//te proporcionaremos un usuario y contra. press 1 para continuar
				$gather = $twiml->gather(array(
					"timeout"=>"4",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/11",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/raw/16_usuario02.mp3");
				$twiml->say("Lo sentimos, ocurrio un error en paso 9-b. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				
				break;
			
			case 10:
				
				//guardar el numero de telefono ingresado
				Session::put('atencion-tel',Input::get("Digits"));
				
				//te proporcionaremos un usuario y contra. press 1 para continuar
				$gather = $twiml->gather(array(
					"timeout"=>"4",
					"finishOnKey"=>"#",
					"action"=>"/twilio-connect/registro/11",
					"method"=>"POST",
					"numDigits"=>"1"
				));
				$gather->play("http://www.infomercado.mx/raw/16_usuario02.mp3");
				$twiml->say("Lo sentimos, ocurrio un error en paso 9-b. Hasta luego.",array("language"=>"es-MX","voice"=>"alice"));
				
				break;
			
			case 11:
				
				//ejecutar el codigo aqui para generar usuario y password
				Log::info('=RegistroUsuario=',array('config'=>Session::all()));
				
				$nombre = "TELEFONICO";
				$password_texto = mt_rand(0,9).";".mt_rand(0,9).";".mt_rand(0,9).";".mt_rand(0,9);
				$usuario_texto = mt_rand(0,9).";".mt_rand(0,9).";".mt_rand(0,9).";".mt_rand(0,9).";".mt_rand(0,9).";".mt_rand(0,9);
				$password = str_replace(';', '', $password_texto);
				$password = Hash::make($password);
				$usuario = str_replace(';', '', $usuario_texto);
				$mercado = Session::get('mercado');
				$local = Session::get('local');
				$cat = Session::get("categoria");
				
				//servicios que ofrece
				$domicilio = Session::get("a-domicilio");
				$tarjetas = Session::get("tarjeta");
				$vales = Session::get("vales");
				$precios = Session::get("precios");
				$servicios = json_encode(array($domicilio,$tarjetas,$vales, $precios),true);
				$servicios = $this->booleanReplacer($servicios);
				
				try {
					DB::insert('INSERT INTO comerciantes(nombre, password, mercado_number, local, categoria_principal, categoria_adicional, username, servicios) VALUES(?,?,?,?,?,0,?,?)',array($nombre, (string)$password, $mercado, $local, $cat, (string)$usuario, $servicios));
					
					Log::info('**** Se guardo el Registro *****');
				} catch (Exception $ex) {
					Log::info('xxxxx NO guardo el Registro xxxxx',array('error'=>$ex));
				}
						
				//reproducir la respuesta
				$twiml->say("Numero de Usuario. ".$usuario_texto,array("language"=>"es-MX","voice"=>"alice"));
				$twiml->say("Codigo de Acceso. ".$password_texto,array("language"=>"es-MX","voice"=>"alice"));
				$twiml->play("http://www.infomercado.mx/raw/17_gracias02.mp3");
			
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
	
	//boolean replacer
	private function booleanReplacer($input) {
		$input = str_replace("1", "true", $input);
		$input = str_replace("0", "false", $input);
		return $input;
	}
	

}