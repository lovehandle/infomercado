@extends('desktop')

@section('extra-css')
    <style>

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
            padding: 12px;
            font-size: 18pt;
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

        .tipos {
            height: 200px;
            background-color: #5bc0de;
        }
        .spacer {
            margin-bottom: 30px;
        }

    </style>
@stop

@section('contenido')
<div class="explora">
    <div class="container">
        <p class="headline-1 ">{{$titulo}}</p>
    </div>
</div>
<div class="contenido">
    <div class="container">
        <div class="row">
            @foreach($mercados as $mercado)
            <a href="/mercados/{{$mercado->numero}}" class="col-md-6 spacer">
                <div class="tipos">
                    <p class="seccion-heading">{{ $mercado->nombre }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@stop
