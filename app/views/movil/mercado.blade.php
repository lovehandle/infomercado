@extends('movil')

@section('extra-css')

h1 {font-size: 18pt;}
h4 {font-size: 12pt;}

@stop

@section('contenido')

	<div class="row mini-nav" align="center">
		<div class="col-xs-6 nav-inicio"><a href="/">INICIO</a></div>
		<div class="col-xs-6 nav-cerca"><a href="/explora">EXPLORA</a></div>
	</div>
	
	<div class="row" align="center">
		<div class="col-xs-12">
			<h1>MERCADO #<?php print($mercado->numero); ?> - <?php print($mercado->nombre); ?></h1>
			<h4 class="gris-2"><?php print($mercado->delegacion_nombre); ?></h4>
		</div>
	</div>

@stop