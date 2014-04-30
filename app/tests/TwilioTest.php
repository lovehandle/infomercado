<?php

public class TwilioTest extends TestCase {

    public function test_rutas_twilio() {

        print("Rutas Twilio... \n");

        //ruta inicial
        $this->call('GET','/twilio-connect/welcome');
        $this->assertResponseOk();

        //testear opciones de la 1 a la 3, la 3 es una entrada incorrecta
        //pero tiene que regresar bien el XML
        for($x = 1; $x<=4; $x++) {
            $post_data = array("Digits"=>$x);
            $response = $this->call('POST','/twilio-connect/start',$post_data);
            $this->assertResponseOk();
        }

        //probar el post al endpoint de opiniones
        $post_data = array("RecordingUrl"=>"http://www.url.com/test.mp3","RecordingDuration"=>"12");
        $response = $this->call('POST','/twilio-connect/opiniones',$post_data);
        $this->assertResponseOk();

        //probar el proceso de registro
        //1 ingresar un numero de mercado (1 a 4 digitos) y que no truene
        $post_data = array("Digits"=>4);
        $response = $this->call('POST','/twilio-connect/registro/1',$post_data);
        $this->assertResponseOk();

        $post_data = array("Digits"=>14);
        $response = $this->call('POST','/twilio-connect/registro/1',$post_data);
        $this->assertResponseOk();

        $post_data = array("Digits"=>300);
        $response = $this->call('POST','/twilio-connect/registro/1',$post_data);
        $this->assertResponseOk();

        $post_data = array("Digits"=>6666);
        $response = $this->call('POST','/twilio-connect/registro/1',$post_data);
        $this->assertResponseOk();

    }

}