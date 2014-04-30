<?php

class ComercianteTest extends TestCase {

    public function test_crud_comerciante() {

        print("Comerciantes... \n");

        //crear
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

        //buscar
        $buscar = Comerciante::find($comerciante->id);
        $this->assertEquals($buscar->nombre, $comerciante->nombre);

        //actualizar
        $buscar->servicios = "[true,true,false,true]";
        $this->assertTrue($buscar->save());

        //eliminar
        $this->assertTrue($buscar->delete());
        //verificar la eliminacion
        $buscar = Comerciante::find($comerciante->id);
        $this->assertNull($buscar);

    }

}