<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/css/bootstrap.css">
<link rel="stylesheet" href="/css/main.css">
<title>infomercado.mx</title>
<!-- Latest compiled and minified JavaScript -->
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGEM2AtRMpdnI3yoQTOu9hMQsOz3yvBaE&sensor=true">
    </script>
<style>
.el-header{height: 80px; background-color: #f4f4f4;}
.header-titulo{ font-size: 20pt; margin-top: 24px; color:#ea890d; display: block;}
.el-hader a:hover, .el-header a:link{
	color:#ea890d;
}
.mini-nav a{color: #FFF; font-size: 12pt; display: block; height: 60px; line-height: 64px;}
.nav-inicio{background-color: #d8682a; }
.nav-cerca{background-color: #ea890d; }
.list-group{font-size: 14pt !important; margin-top: 10px;}

#map-canvas {background-color: #37e9e6;}

.nombrecito{
	padding: 10px;
}
.row-nombre {
	border-bottom: 1px solid #797979;
}
</style>
</head>

<body>
<div id="elcont" class="container">
	<div class="row el-header" align="center">
		<div class="col-xs-12">
			<p class="header-titulo">infomercado.mx</p>
		</div>
	</div>
	<div class="row mini-nav" align="center">
		<div class="col-xs-6 nav-inicio"><a href="/">INICIO</a></div>
		<div class="col-xs-6 nav-cerca"><a href="explora">EXPLORA</a></div>
	</div>
	<div class="row" align="center">
		<div class="col-xs-12 row-nombre">
			<p class="nombrecito">MERCADO <?php print($mercado->nombre); ?></p>
		</div>
	</div>
</div>

<div class="google-map-canvas" id="map-canvas"></div>

<script language="javascript">

//google maps
var map;
var mercado_latlng = new google.maps.LatLng(<?php print($mercado->latitud); ?>,<?php print($mercado->longitud); ?>);
var mercado_marker = new google.maps.Marker({
  title:"Mercado <?php print($mercado->nombre); ?>",
  position:mercado_latlng,
  draggable:false
});
 
function initialize() {
  var mapOptions = {
    center: new google.maps.LatLng(<?php print($mercado->latitud); ?>,<?php print($mercado->longitud); ?>),
    zoom: 17,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    scrollwheel: false,
    draggable : false
  };
  map = new google.maps.Map(document.getElementById("map-canvas"),
      mapOptions);
  mercado_marker.setMap(map);
}


$(document).ready(function(){

	var total_height = $( window ).height();
	var header_height = $("#elcont").height();
	var mapa_alto = total_height - header_height;
	//alert(mapa_alto);
	$("#map-canvas").height(mapa_alto);
	
	initialize();
	
});

</script>
</body>
</html>
