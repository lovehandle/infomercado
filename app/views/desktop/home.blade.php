@extends('desktop')

@section('extra-css')

<style>
    * {
        font-family: 'Comfortaa', sans-serif;
        border-radius:0 !important;
        moz-border-radius:0;
    }
    body {
        background-color: #f3f3f3;
    }

    .seccion{
        height: 180px;
    }
    .seccion-heading {
        margin: 15px;
        display: inline-block;
        background-color: #000;
        padding: 15px;
        font-size: 20pt;
        color: #fff;
    }

    .home-tipo {
        background-image: url('/img/tipo.jpg');
    }
    .home-delegacion {
        background-image: url('/img/delegacion.jpg');
    }

    .topic {
        position: relative;
        padding: 40px 0 60px;
        margin-bottom: 15px;
    }

    .explora {
        padding: 30px 0 20px;
        background-image: url("http://subtlepatterns.com/patterns/pw_maze_white.png");
    }

    .headline-1 {
        font-size: 20pt;
        color: #F17A4F;
    }
    .subtitulo {
        font-size: 12pt;
        color: #999999;
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
        font-size: 12pt;
        color:#fff;
        max-width: 500px;
        background-color: #d9534f;
        padding: 10px;
        font-weight: 300;
    }

    .contenido {
        padding: 20px 0 20px;
    }

    .fondo-header {
        background: url(/img/home.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

</style>

@stop

@section('contenido')
<div class="topic fondo-header">
    <div class="container">
        <h2 class="site-head">infomercado.mx</h2>
        <p class="site-headline">Plataforma de información y participación ciudadana en los Mercados Públicos de la Ciudad de México</p>
    </div>
</div>
<div class="explora">
    <div id="container">
        <p class="headline-1 text-center">EXPLORA LOS MERCADOS</p>
        <p class="subtitulo text-center">Cada mercado tiene algo nuevo por mostrarte, dejate enamorar y vive una nueva experiencia en cada visita</p>
    </div>
</div>
<div class="contenido">
    <div class="container">
        <div class="row">
            <a href="/mercados/tipos" class="col-md-6">
                <div class="seccion home-tipo">
                    <p class="seccion-heading">POR TIPO</p>
                </div>
            </a>
            <a href="/mercados/delegaciones" class="col-md-6">
                <div class="seccion home-delegacion">
                    <p class="seccion-heading">POR DELEGACION</p>
                </div>
            </a>
        </div>
    </div>
</div>
@stop
