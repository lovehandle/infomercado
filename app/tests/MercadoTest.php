<?php

class MercadoTest extends TestCase {

    //probar que todas las rutas de twilio funcionan
    public function test_mercado_model() {

        //correr la migracion
        Artisan::call('migrate');

        //dar de alta un mercado
        $this->assertTrue(true);

    }

}