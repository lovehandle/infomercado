<?php

class DelegacionesTableSeeder extends Seeder {

	public function run()
	{

        DB::table('delegaciones')->insert(array(
            array('numero' => '1', 'nombre' => 'Álvaro Obregón', 'route'=>'alvaro-obregon','siglas'=>'AO','created_at'=>'2014-04-04','updated_at'=>'2014-04-04'),
            array('numero' => '2', 'nombre' => 'Azcapotzalco', 'route'=>'azcapotzalco','siglas'=>'AZC','created_at'=>'2014-04-04','updated_at'=>'2014-04-04'),
            array('numero' => '3', 'nombre' => 'Benito Juárez', 'route'=>'benito-juarez','siglas'=>'BJ','created_at'=>'2014-04-04','updated_at'=>'2014-04-04'),
            array('numero' => '4', 'nombre' => 'Cuajimalpa', 'route'=>'cuajimalpa','siglas'=>'CUJ','created_at'=>'2014-04-04','updated_at'=>'2014-04-04'),
            array('numero' => '5', 'nombre' => 'Coyoacán', 'route'=>'coyoacan','siglas'=>'COY','created_at'=>'2014-04-04','updated_at'=>'2014-04-04'),
            array('numero' => '6', 'nombre' => 'Cuahutémoc', 'route'=>'cuahutemoc','siglas'=>'CUH','created_at'=>'2014-04-04','updated_at'=>'2014-04-04'),
            array('numero' => '7', 'nombre' => 'Gustavo A. Madero', 'route'=>'gustavo-a-madero','siglas'=>'GAM','created_at'=>'2014-04-04','updated_at'=>'2014-04-04'),
            array('numero' => '8', 'nombre' => 'Iztacalco', 'route'=>'iztacalco','siglas'=>'IZC','created_at'=>'2014-04-04','updated_at'=>'2014-04-04'),
            array('numero' => '9', 'nombre' => 'Iztapalapa', 'route'=>'iztapalapa','siglas'=>'IZT','created_at'=>'2014-04-04','updated_at'=>'2014-04-04'),
            array('numero' => '10', 'nombre' => 'Magdalena Contreras', 'route'=>'magdalena-contreras','siglas'=>'MAC','created_at'=>'2014-04-04','updated_at'=>'2014-04-04'),
            array('numero' => '11', 'nombre' => 'Miguel Hidalgo', 'route'=>'miguel-hidalgo','siglas'=>'MH','created_at'=>'2014-04-04','updated_at'=>'2014-04-04'),
            array('numero' => '12', 'nombre' => 'Milpa Alta', 'route'=>'milpa-alta','siglas'=>'MIA','created_at'=>'2014-04-04','updated_at'=>'2014-04-04'),
            array('numero' => '13', 'nombre' => 'Tláhuac', 'route'=>'tlahuac','siglas'=>'TLH','created_at'=>'2014-04-04','updated_at'=>'2014-04-04'),
            array('numero' => '14', 'nombre' => 'Tlalpan', 'route'=>'tlalpan','siglas'=>'TLA','created_at'=>'2014-04-04','updated_at'=>'2014-04-04'),
            array('numero' => '15', 'nombre' => 'Venustiano Carranza', 'route'=>'venustiano-carranza','siglas'=>'VC','created_at'=>'2014-04-04','updated_at'=>'2014-04-04'),
            array('numero' => '16', 'nombre' => 'Xochimilco', 'route'=>'xochimilco','siglas'=>'AO','created_at'=>'2014-04-04','updated_at'=>'2014-04-04')
        ));

	}

}