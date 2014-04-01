@extends('movil')

@section('contenido')

<div class="row mini-nav" align="center">
	<div class="col-xs-6 nav-inicio"><a href="/">INICIO</a></div>
	<div class="col-xs-6 nav-cerca"><a href="/mercados/cercano">UN MERCADO CERCA</a></div>
</div>

<div class="list-group">
    	<?php foreach($delegaciones as $delegacion){ ?>
	    	<a href="/mercados/<?php print($delegacion->link); ?>" class="list-group-item"><?php print($delegacion->delegacion_nombre); ?></a>
    	<?php } ?>
    </div>
    <div class="list-group">
	    <?php foreach($tipos as $tipo){ ?>
	    	<a href="/mercados/<?php print($tipo->link); ?>" class="list-group-item"><?php print($tipo->tipo_desc); ?></a>
    	<?php } ?>
    </div>

@stop

