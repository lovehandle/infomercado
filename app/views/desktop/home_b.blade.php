@extends('desktop')

@section('extra-js')
<script type="text/javascript"src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGEM2AtRMpdnI3yoQTOu9hMQsOz3yvBaE&sensor=false"></script>
<script language="javascript">

    //google maps
    var map;
    var mercado_latlng = new google.maps.LatLng(19.445470,-99.145389);
    var mercado_marker = new google.maps.Marker({
        title:"Mercado MARTINEZ DE LA TORRE (ANEXO)",
        position:mercado_latlng,
        draggable:false
    });

    function initialize() {
        var mapOptions = {
            center: mercado_latlng,
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: true,
            draggable : true
        };
        map = new google.maps.Map(document.getElementById("mapa"),
            mapOptions);
        mercado_marker.setMap(map);
    }
    google.maps.event.addDomListener(window, 'load', initialize);



</script>
@stop

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

    .amigo {
        padding: 15px 0 15px 0;;
    }

    .seccion{
        height: 250px;
        position: relative;
    }
    .comerciantes {
        background-color: #D9B74B;
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

    .home-tipo {
        background-image: url('/img/tipo.jpg');
    }
    .home-delegacion {
        background-image: url('/img/delegacion.jpg');
    }

    .topic {
        position: relative;
        padding: 20px 0 30px;
        margin-bottom: 15px;
    }

    .explora {
        background-color: #d9534f;
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

    .spacer {
        margin-bottom: 30px;
    }
    #mapa {
        width: 100%;
        height: 450px;
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
<nav class="navbar navbar-inverse" role="navigation">
    <div class="amigo">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="/">INFOMERCADO.MX</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/mercados/tipos">MERCADOS POR TIPO</a></li>
                <li><a href="/mercados/delegaciones">MERCADOS POR DELEGACION</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div id="mapa">
</div>
<div id="opciones" class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="comerciantes seccion">
                <p class="seccion-heading">SOY COMERCIANTE</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="explora seccion">
                <p class="seccion-heading">EXPLORA LOS MERCADOS</p>
            </div>
        </div>
    </div>
</div>
@endsection
