@extends('desktop')

@section('extra-css')
    <style>

        body {
            background-color: #f3f3f3;
        }

        .seccion{
            height: 180px;
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
            background-image: url('http://subtlepatterns.com/patterns/pw_maze_white.png');
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

        .item {
            position: relative;
            height: 280px;
            background-color: #5bc0de;
        }
         .seccion-heading {
            display: inline-block;
            background-color: #000;
            padding: 15px;
            font-size: 20pt;
            color: #fff;
            z-index: 999;
            position: absolute;
            top:20px;
            left:15px;

        }

        .spacer {
            margin-bottom: 30px;

        }


    </style>
@stop

@include('desktop.mini-header')
@section('contenido')
<div class="explora">
    <div class="container">
        <p class="headline-1 ">MERCADOS POR DELEGACI&Oacute;N</p>
    </div>
</div>
<div class="contenido">
    <div class="container">
        <div class="row">
            @foreach($delegaciones as $delegacion)
            <a href="/mercados/{{$delegacion->route}}" class="col-md-4 spacer">
                <div class="item">
                    <p class="seccion-heading">{{$delegacion->nombre}}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@stop
