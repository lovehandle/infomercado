<?php

class Delegacion extends Eloquent {

    protected $table = 'delegaciones';
    protected $fillable = array('numero','nombre', 'route', 'siglas');

}