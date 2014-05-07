@extends('desktop')

@section('extra-css')
<style>

    * {
        font-family: 'Comfortaa', sans-serif;
        border-radius:0 !important;
        moz-border-radius:0;
    }

    body {

        background: url(/img/home.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        position: relative;

    }

    /*
        header principal
    */

    .topic {
        position: relative;
        height: 530px;
    }

    .site-head {
        color: #F2C64A;
        font-size: 32pt;
        padding: 10px;
        background-color: #000;
        max-width: 360px;
        font-family: 'Comfortaa', sans-serif;
        font-weight: 600;
    }
    .site-headline {
        font-size: 14pt;
        color:#fff;
        max-width: 500px;
        background-color: #d9534f;
        padding: 10px;
        font-weight: 300;
    }
    #headline {
        position: absolute;
        top: 100px;
        left: 100px;

    }

    /*
        parte de abajo
    */
    .seccion{
        height: 250px;
        position: relative;
    }
    .comerciantes {
        background-color: #D9B74B;
    }
     .explora {
        background-color: #d9534f;
    }
    .seccion-heading {
        position: absolute;
        top: 25px;
        left: 30px;
        display: inline-block;
        background-color: #000;
        padding: 15px;
        font-size: 20pt;
        color: #fff;
    }
    .comerciante-action {
        position: absolute;
        bottom: 25px;
        right: 25px;
        display: inline-block;
        background-color: #d9534f;
        padding: 15px;
        font-size: 16pt;
        color: #fff;
    }
    .mercados-action {
        position: absolute;
        bottom: 40px;
        right: 25px;
        display: inline-block;
    }
    .mercados-action a {
        background-color: #D9B74B;
        padding: 15px;
        font-size: 16pt;
        color: #fff;
        margin-right: 12px;
    }
    .comerciante-action a {
        color: #fff;
    }
    .container {
        width: 100%;
        margin: 0;
    }
    .col-md-6 {
        padding: 0;
        margin: 0;
    }


</style>
@stop

@section('contenido')
<div class="topic fondo-header">
    <div id="headline" class="container">
        <h2 class="site-head">infomercado.mx</h2>
        <p class="site-headline">Plataforma de información y participación ciudadana en los Mercados Públicos de la Ciudad de México</p>
    </div>
</div>
<div id="opciones" class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="comerciantes seccion">
                <p class="seccion-heading">SOY COMERCIANTE</p>
                <p class="comerciante-action"><a href="/comerciantes">REGISTRATE EN EL DIRECTORIO</a></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="explora seccion">
                <p class="seccion-heading">EXPLORA LOS MERCADOS</p>
                <p class="mercados-action"><a href="/mercados/tipos">POR TIPO</a><a href="/mercados/delegacion">POR DELEGACI&Oacute;N</a></p>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script language="javascript">
$(document).ready(function(){
    var total_height = $( window ).height();
    console.log(total_height);
    var header_height = $(".topic").height();
    console.log(header_height);
    var mapa_alto = total_height - header_height;
    $(".seccion").height(mapa_alto);
});
</script>
@stop