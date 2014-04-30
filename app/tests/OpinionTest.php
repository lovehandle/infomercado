<?php

class OpinionTest extends TestCase {

    public function test_crud_opinion() {

        print("Opiniones... \n");

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

}