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
    }

    .topic {
        position: relative;
        padding: 80px 0 30px;
        margin-bottom: 15px;
        height: 100%;
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
@stop