<?php

class DelegacionesTableSeeder extends Seeder {

	public function run()
	{
        
        Delegacion::create(array('numero' => '1', 'nombre' => 'Álvaro Obregón', 'route'=>'alvaro-obregon','siglas'=>'AO'));
        Delegacion::create(array('numero' => '2', 'nombre' => 'Azcapotzalco', 'route'=>'azcapotzalco','siglas'=>'AZC'));
        Delegacion::create(array('numero' => '3', 'nombre' => 'Benito Juárez', 'route'=>'benito-juarez','siglas'=>'BJ'));
        Delegacion::create(array('numero' => '4', 'nombre' => 'Coyoacán', 'route'=>'coyoacan','siglas'=>'COY'));
        Delegacion::create(array('numero' => '5', 'nombre' => 'Cuajimalpa', 'route'=>'cuajimalpa','siglas'=>'CUJ'));
        Delegacion::create(array('numero' => '6', 'nombre' => 'Cuahutémoc', 'route'=>'cuahutemoc','siglas'=>'CUH'));
        Delegacion::create(array('numero' => '7', 'nombre' => 'Gustavo A. Madero', 'route'=>'gustavo-a-madero','siglas'=>'GAM'));
        Delegacion::create(array('numero' => '8', 'nombre' => 'Iztacalco', 'route'=>'iztacalco','siglas'=>'IZC'));
        Delegacion::create(array('numero' => '9', 'nombre' => 'Iztapalapa', 'route'=>'iztapalapa','siglas'=>'IZT'));
        Delegacion::create(array('numero' => '10', 'nombre' => 'Magdalena Contreras', 'route'=>'magdalena-contreras','siglas'=>'MAC'));
        Delegacion::create(array('numero' => '11', 'nombre' => 'Miguel Hidalgo', 'route'=>'miguel-hidalgo','siglas'=>'MH'));
        Delegacion::create(array('numero' => '12', 'nombre' => 'Milpa Alta', 'route'=>'milpa-alta','siglas'=>'MIA'));
        Delegacion::create(array('numero' => '13', 'nombre' => 'Tláhuac', 'route'=>'tlahuac','siglas'=>'TLH'));
        Delegacion::create(array('numero' => '14', 'nombre' => 'Tlalpan', 'route'=>'tlalpan','siglas'=>'TLA'));
        Delegacion::create(array('numero' => '15', 'nombre' => 'Venustiano Carranza', 'route'=>'venustiano-carranza','siglas'=>'VC'));
        Delegacion::create(array('numero' => '16', 'nombre' => 'Xochimilco', 'route'=>'xochimilco','siglas'=>'AO'));

	}

}