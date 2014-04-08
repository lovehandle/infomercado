@extends('movil')

@section('extra-css')

.nav-home{ font-family: 'Imprima', sans-serif;}
.nav-home .col-xs-12 {background-color: #ea890d;}
.nav-home a{color: #f4f4f4; font-size: 14pt; display: block; height: 80px; line-height: 83px;}
#explora-opciones, #comerciantes-opciones { display:none; }

@stop

@section('contenido')

<div class="row nav-home" align="center">
	<div class="col-xs-12" style="background-color:#FFA64D;"><a id="explora" href="#">EXPLORA LOS MERCADOS</a></div>
</div>
<div id="explora-opciones" class="row nav-home" align="center">
    <div class="col-xs-12" style="background-color:#FFA64D;"><a href="/explora">POR DELEGACION</a></div>
    <div class="col-xs-12" style="background-color:#FFA64D;"><a href="/explora">POR TIPO</a></div>
</div>
<div class="row nav-home" align="center">
    <div class="col-xs-12" style="background-color:#FF952B;"><a href="/mercados/cercano">UN MERCADO CERCA</a></div>
    <div class="col-xs-12" style="background-color:#7D9EC0;"><a id="comerciantes" href="#">COMERCIANTES</a></div>
</div>
<div id="comerciantes-opciones" class="row nav-home" align="center">
    <div class="col-xs-12" style="background-color:#7D9EC0;"><a href="#">MI LOCAL</a></div>
    <div class="col-xs-12" style="background-color:#7D9EC0;"><a href="#">REGISTRO DE COMERCIANTES</a></div>
</div>

@stop

@section('complemento')

<script lang="javascript" type="text/javascript">
    $(document).ready(function(){

        $("#explora").click(function(e) {
            $("#explora-opciones").toggle();
        });

        $("#comerciantes").click(function(e) {
            $("#comerciantes-opciones").toggle();
        });

    });

</script>

@stop