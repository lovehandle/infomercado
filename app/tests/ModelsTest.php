<?php

use Zizaco\FactoryMuff\Facade\FactoryMuff;

class ModelsTest extends TestCase {

    //probar que todas las rutas de twilio funcionan
    public function test_crud_mercado() {

        print("Mercado... \n");

        $mercado = FactoryMuff::create('Mercado');

        print($mercado->nombre);
       
        $this->assertTrue($mercado->save());

        //buscar
        $buscar = Mercado::find($mercado->id);
        $this->assertEquals($buscar->numero, $mercado->numero);

        //actualizar
        $buscar->nombre = "Mercado Chido";
        $this->assertTrue($buscar->save());

        //eliminar
        $this->assertTrue($buscar->delete());
        //verificar la eliminacion
        $buscar = Mercado::find($mercado->id);
        $this->assertNull($buscar);

    }

    public function test_crud_oferta() {

        print("Oferta... \n");

        //crear
        $oferta = new Oferta;
        $oferta->mercado = 14;
        $oferta->local = 12;
        $oferta->oferta = "No vives de ensalada";
        $this->assertTrue($oferta->save());

        //buscar
        $buscar = Oferta::find($oferta->id);
        $this->assertEquals($buscar->oferta, $oferta->oferta);

        //actualizar
        $buscar->oferta = "Si vives de ensalada";
        $this->assertTrue($buscar->save());

        //eliminar
        $this->assertTrue($buscar->delete());
        //verificar la eliminacion
        $buscar = Oferta::find($oferta->id);
        $this->assertNull($buscar);

    }

    public function test_crud_opinion() {

        print("Opinion... \n");

        //crear
        $opinion = new Opinion;
        $opinion->url = "http://url.com/test.mp3";
        $opinion->duracion = 12;
        $opinion->metadata = "[]";
        $this->assertTrue($opinion->save());

        //buscar
        $buscar = Opinion::find($opinion->id);
        $this->assertEquals($buscar->url, $opinion->url);

        //actualizar
        $buscar->metadata = "data:data";
        $this->assertTrue($buscar->save());

        //eliminar
        $this->assertTrue($buscar->delete());
        //verificar la eliminacion
        $buscar = Opinion::find($opinion->id);
        $this->assertNull($buscar);

    }

    public function test_crud_comerciante() {

        print("Comerciante... \n");

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