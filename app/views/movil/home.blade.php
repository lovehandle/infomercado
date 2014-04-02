@extends('movil')

@section('extra-css')

.nav-home{ font-family: 'Architects Daughter', sans-serif;}
.nav-home .col-xs-12 {background-color: #ea890d;}
.nav-home a{color: #f4f4f4; font-size: 14pt; display: block; height: 80px; line-height: 83px;}

@stop

@section('contenido')

<div class="row nav-home" align="center">
	<div class="col-xs-12" style="background-color:#FF952B;"><a href="/mercados/cercano">UN MERCADO CERCA</a></div>
	<div class="col-xs-12" style="background-color:#FFA64D;"><a href="/explora">EXPLORA LOS MERCADOS</a></div>
	<div class="col-xs-12" style="background-color:#FFB872;"><a href="/explora">OFERTAS Y EVENTOS</a></div>
	<div class="col-xs-12" style="background-color:#7D9EC0;"><a href="/comerciantes">REGISTRO DE COMERCIANTES</a></div>
</div>

@stop