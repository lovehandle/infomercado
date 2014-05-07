@extends('desktop')

@section('extra-js')
<script type="text/javascript"src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGEM2AtRMpdnI3yoQTOu9hMQsOz3yvBaE&sensor=false"></script>
<script language="javascript">
    //google maps
    var map;
    var mercado_latlng = new google.maps.LatLng({{$mercado->latitud}},{{$mercado->longitud}});
    var mercado_marker = new google.maps.Marker({
        title:"Mercado {{$mercado->nombre}}",
        position:mercado_latlng,
        draggable:false
    });

    function initialize() {
        var mapOptions = {
            center: mercado_latlng,
    zoom: 17,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
        draggable : false
    };
    map = new google.maps.Map(document.getElementById("map-canvas"),
        mapOptions);
    mercado_marker.setMap(map);
    }
    google.maps.event.addDomListener(window, 'load', initialize);

</script>
@stop

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
        padding: 10px 0 10px;
        margin-bottom: 0px;
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
        font-size: 24pt;
        padding: 15px;
        background-color: #000;
        max-width: 400px;
        font-family: 'Comfortaa', sans-serif;
        font-weight: 400;
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
    .spacer-micro {
        margin-bottom: 15px;
    }

    #map-canvas {
        height: 350px;
    }
    .color1{
        background-color: #A5A5A5;
    }
    .color2{
        background-color: #C6C6C6;
    }

    .info-height {
        height: 175px;
        padding: 15px;
        color: #f3f3f3;
    }

</style>
@stop


@include('desktop.mini-header')
@section('contenido')
<div class="topic fondo-header">
    <div class="container">
        <h2 class="site-head">MERCADO #{{$mercado->numero}} {{$mercado->nombre}}</h2>
    </div>
</div>
<div class="contenido">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div id="map-canvas">

                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="info-height color2">
                            <p>Calle tres esq. con Calle dos. Col. Cinco</p>
                            <p>Abierto de Lunes a Domingo de 9:00 AM a 7:00 PM</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="info-height color1">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
@stop