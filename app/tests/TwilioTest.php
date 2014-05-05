<?php

class TwilioTest extends TestCase {

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

        $post_data = array("Digits"=>300);
        $response = $this->call('POST','/twilio-connect/registro/1',$post_data);
        $this->assertResponseOk();

        $post_data = array("Digits"=>6666);
        $response = $this->call('POST','/twilio-connect/registro/1',$post_data);
        $this->assertResponseOk();

        //seleccionar mercado
        $post_data = array("Digits"=>14);
        $response = $this->call('POST','/twilio-connect/registro/1',$post_data);
        $this->assertResponseOk();

        //seleccione un mercado, me dijo cual, le doy uno para continuar
        $post_data = array("Digits"=>1);
        $response = $this->call('POST','/twilio-connect/registro/2',$post_data);
        $this->assertResponseOk();

        //tengo que seleccionar un local
        $post_data = array("Digits"=>20);
        $response = $this->call('POST','/twilio-connect/registro/3',$post_data);
        $this->assertResponseOk();

        //me dijo un monton de categorias, selecciono una
        $post_data = array("Digits"=>5);
        $response = $this->call('POST','/twilio-connect/registro/4',$post_data);
        $this->assertResponseOk();

        //acepto vales, le digo que si
        $post_data = array("Digits"=>1);
        $response = $this->call('POST','/twilio-connect/registro/5',$post_data);
        $this->assertResponseOk();

        //entrego a domicilio, le digo que no
        $post_data = array("Digits"=>2);
        $response = $this->call('POST','/twilio-connect/registro/6',$post_data);
        $this->assertResponseOk();

        //acepto tarjetas, le digo que no
        $post_data = array("Digits"=>2);
        $response = $this->call('POST','/twilio-connect/registro/7',$post_data);
        $this->assertResponseOk();

        //no quiero lista de precios
        $post_data = array("Digits"=>2);
        $response = $this->call('POST','/twilio-connect/registro/8',$post_data);
        $this->assertResponseOk();

        //si doy atencion telefonica
        $post_data = array("Digits"=>1);
        $response = $this->call('POST','/twilio-connect/registro/9',$post_data);
        $this->assertResponseOk();

        //meto mi numero
        $post_data = array("Digits"=>55270991);
        $response = $this->call('POST','/twilio-connect/registro/10',$post_data);
        $this->assertResponseOk();

        //le doy continuar para que me diga mis datos de registro
        $post_data = array("Digits"=>1);
        $response = $this->call('POST','/twilio-connect/registro/11',$post_data);
        $this->assertResponseOk();

        //creo que es todo, hay que verificar la session

    }

}