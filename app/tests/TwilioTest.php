<?php

class TwilioTest extends TestCase {

    //probar que todas las rutas de twilio funcionan

    public function test_rutas_twilio() {

        print("Probando rutas de twilio ... \n");

        //ruta inicial
        $this->call('GET','twilio-connect/welcome');
        $this->assertResponseOk();

        //testear opciones de la 1 a la 3, la 3 es una entrada incorrecta
        //pero tiene que regresar bien el XML
        for($x = 1; $x<=4; $x++) {
            $post_data = array("Digits"=>$x);
            $response = $this->call('POST','/twilio-connect/start',$post_data);
            $this->assertResponseOk();
        }

        //probar el proceso de registro



    }

    //probar las salidas de xml

} 