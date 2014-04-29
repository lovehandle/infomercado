<?php

class ComercianteTest extends TestCase {

    public function test_crear_comerciante() {

        print("Nuevo comerciante... \n");

        $comerciante = new Comerciante;
        $comerciante->nombre = "el comerciante";
        $comerciante->password = "*comerciante*";
        $comerciante->mercado_number = 12;
        $comerciante->local = 100;
        $comerciante->categoria_principal = 2;
        $comerciante->categoria_adicional = 1;
        $comerciante->username = "comerciante33";
        $comerciante->servicios = "data";

        $this->assertTrue($comerciante->save());

    }

}