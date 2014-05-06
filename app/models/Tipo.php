<?php

class Tipo extends Eloquent {

    protected $table = 'tipos';
    protected $fillable = array('tipo', 'nombre', 'descripcion', 'route');
}