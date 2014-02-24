<?php

class TwilioController extends BaseController {


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
		DB::table('grabaciones')->insert(array('twilio_url'=>Input::get('RecordingUrl'),'duracion'=>Input::get('RecordingDuration')));
		return Response::view('twilio/opinion-gracias')->header('Content-Type', 'application/xml');
		
	}

}