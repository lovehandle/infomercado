@extends('movil');

@section('contenido')

	<div class="row mini-nav" align="center">
		<div class="col-xs-6 nav-inicio"><a href="/">INICIO</a></div>
		<div class="col-xs-6 nav-cerca"><a href="/explora">EXPLORA</a></div>
	</div>

@end

@section('complemento')

<div class="google-map-canvas" id="map-canvas"></div>

<script language="javascript">

//google maps
var map;
var mercado_latlng;
var mercado_marker;
var yo_marker;
var centro;
var infowindow
 
function initialize() {

  var mapOptions = {
    center: centro,
    zoom: 15,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    scrollwheel: false,
    draggable : true
  };
  map = new google.maps.Map(document.getElementById("map-canvas"),
      mapOptions);
      
}

function localizar_mercado(mercado) {
	mercado_latlng = new google.maps.LatLng(mercado.latitud, mercado.longitud);
	mercado_marker = new google.maps.Marker({
		title:"Mercado #"+mercado.numero+" "+mercado.nombre,
		position:mercado_latlng,
		draggable:false,
	});
	
	var infocontenido = '<div class="info"><p>Mercado #'+mercado.numero+' '+mercado.nombre+'</p><p>'+mercado.locales+' locales, '+mercado.tipo_desc+'</p><p><a href="/mercados/'+mercado.numero+'">Conocer &gt;</a></p></div>';
	
	infowindow = new google.maps.InfoWindow({
      content: infocontenido
    });
	
	mercado_marker.setMap(map);
	
	google.maps.event.addListener(mercado_marker, 'click', function() {
    	infowindow.open(map,mercado_marker);
	});
}

function initiate_geolocation() {
    navigator.geolocation.getCurrentPosition(handle_geolocation_query);
}

function handle_geolocation_query(position){
	
	//establecer el centro
	centro = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
	
	
	//generar el maldito mapa
	initialize();
	
	yo_marker = new google.maps.Marker({
		icon:'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
		position:centro,
		draggable:false
	});
	
	yo_marker.setMap(map);
	
	var request = {
		lat:position.coords.latitude,
		lng:position.coords.longitude
	};
	
	$.ajax({
		url:'/mercados/cercano.json',
		method:'post',
		data: request,
		dataType:'json',
		success:function(response) {
			
			console.log(response.mercados[0]);
			
			localizar_mercado(response.mercados[0]);
			
		},
		error:function(){
			alert('ajax error');
		}
	});

    //alert('Lat: ' + position.coords.latitude + ' ' +
      //    'Lon: ' + position.coords.longitude);
}


$(document).ready(function(){

	var total_height = $( window ).height();
	var header_height = $("#elcont").height();
	var mapa_alto = total_height - header_height;
	//alert(mapa_alto);
	$("#map-canvas").height(mapa_alto);
	
	 //geolocalizacion nativa
	 initiate_geolocation();
	
});

</script>


@end