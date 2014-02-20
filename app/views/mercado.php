<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/main.css">
<title>infomercado.mx - Mercado <?php print($mercado->nombre); ?></title>
<!-- Latest compiled and minified JavaScript -->
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
<script type="text/javascript"src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGEM2AtRMpdnI3yoQTOu9hMQsOz3yvBaE&sensor=false"></script>
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
    zoom: 18,
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
</head>

<body>
<div id="main" class="container">
<ol class="breadcrumb">
  <li><a href="/">Inicio</a></li>
  <li>Mercados en <a href="/mercados/<?php print(str_replace(" ","-",strtolower($mercado->delegacion_nombre))); ?>"><?php print($mercado->delegacion_nombre); ?></a></li>
  <li class="active"><?php print($mercado->nombre); ?></li>
</ol>
<div class="row"><!-- row1 -->
 <div class="col-md-12">
  <h1>MERCADO #<?php print($mercado->numero); ?> - <?php print($mercado->nombre); ?></h1>
  <h4 class="gris-2"><?php print($mercado->delegacion_nombre); ?></h4>
 </div>
</div><!-- row1 -->

<div class="row"><!-- row2 -->
<div class="col-md-9"><div id="map-canvas"></div></div>
<div class="col-md-3">
  <div class="row aabb"><div class="col-md-12"><div class="info fondo-info">
           <p>Horario: <?php print($mercado->horario); ?></p>
           <p>Direcci&oacute;n: <?php print($mercado->direccion); ?></p>
           <p>Locales: <?php print($mercado->locales); ?></p></div>
         </div></div><!-- int-row-3-->
  <div class="row bbcc">
    <div class="col-md-12"><div align="center" class="tipo fondo-tipo-<?php print($mercado->tipo); ?>"><img src="/img/tipo-<?php print($mercado->tipo); ?>.png" width="150" height="150"> <h3><?php print($mercado->tipo_desc); ?></h3></div></div>
  </div> <!-- int-row-1-->
   
</div>
</div>
    <?php if($mercado->tipo == 3) { //categorias tradicionales?>
    <div id="cats" class="row">
    	  <div class="col-md-2">
          <div class="contenedor-categorias" align="center"><img src="/img/meat3.png" width="120" height="120"><p>Carne, Pescado y Aves</p>
          </div>
         </div>
         <div class="col-md-2">
          <div class="contenedor-categorias" align="center">
           <img src="/img/grapes3.png" width="120" height="120">
           <p>Frutas y Verduras</p>
          </div>
         </div>
         <div class="col-md-2">
          <div class="contenedor-categorias" align="center">
           <img src="/img/cheese2.png" width="120" height="120">
           <p>Cremeria y Salchichoneria</p>
          </div>
         </div>
         <div class="col-md-2">
          <div class="contenedor-categorias" align="center">
           <img src="/img/coffee20.png" width="120" height="120">
           <p>Abarrotes, Chiles y Semillas</p>
          </div>
         </div>
         <div class="col-md-2">
          <div class="contenedor-categorias" align="center">
           <img src="/img/eating1.png" width="120" height="120">
           <p>Comida</p>
          </div>
         </div>
         <div class="col-md-2">
          <div class="contenedor-categorias" align="center">
           <img src="/img/shopping21.png" width="120" height="120">
           <p>Varios</p>
          </div>
         </div>
    </div>
    <?php }//categorias tradicionales ?>
    <div class="row">
    <h4>Locatarios Registados</h4>
    <?php
	    
			foreach($locatarios as $locatario ) {
				
			?>
    	<div class="col-md-3" style="margin-bottom:20px;">
    	<?php print("<p>".$locatario->nombre."</p>"); 
	    	print("<p>Local #".$locatario->local."</p>");
    	?>
    	</div>
	    <?php
	    }
	    
	    ?>
    </div>
    <div id="footer" class="row">
    	<div class="col-md-12">
       </div>
    </div>
</div>
<script language="javascript">
$(".local").each(function() {
  var visitas = 20;
  visitas += Math.floor(Math.random() * 25);
  $(this).popover({placement:"top",title:"Informacion del Local",content:visitas+" Visitas Diarias",trigger:"hover"});
  /*$(this).click(function(e){
    e.preventDefault();
  });*/
});
</script>
</body>
</html>