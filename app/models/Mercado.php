<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Mercado extends Eloquent implements UserInterface, RemindableInterface {
	
	protected $table = 'mercados';

}

?>