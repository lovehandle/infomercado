<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class TiposTableSeeder extends Seeder {

	public function run()
	{
		//$faker = Faker::create();

			Tipo::create(array('tipo'=>1,'nombre'=>'Tradicional','descripcion'=>'Tipo tradicional','route'=>'tradicional'));
			Tipo::create(array('tipo'=>2,'nombre'=>'Especializado','descripcion'=>'Tipo especial','route'=>'especializado'));
			Tipo::create(array('tipo'=>3,'nombre'=>'Turístico','descripcion'=>'Tipo tourist','route'=>'turistico'));

	}

}