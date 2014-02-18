<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/bootstrap.switch.min.css">
<link rel="stylesheet" href="/css/main.css">
<title>infomercado.mx - Comerciantes</title>
<!-- Latest compiled and minified JavaScript -->
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
<script src="/js/bootstrap.switch.min.js"></script>
</head>
<body>
<div id="main" class="container" align="left">
	<div class="row offset-superior">
    	<h3>Bienvenido <?php print(Auth::user()->nombre);?></h3>
    	<h4>Mercado: <?php print("#".$mercado_datos[0]->numero." - ".$mercado_datos[0]->nombre);?></h4>
    </div>
    <div class="row">
    	<h4>Activa los servicios que ofreces en tu local</h4>
    	<div class="col-md-3">
	    	Servicio a Domicilio<br>
	    <input type="checkbox" data-on-color="success" class="switched">
    	</div>
    	<div class="col-md-3">
	    	Acepta tarjetas<br>
	    <input type="checkbox" data-on-color="success" class="switched">
    	</div>
    	<div class="col-md-3">
	    	Acepta Vales<br>
	    <input type="checkbox" data-on-color="success" class="switched">
    	</div>
    	<div class="col-md-3">
	    	Lista de Precios<br>
	    <input type="checkbox" data-on-color="success" class="switched">
    	</div>
    	<a id="guardar-servicios" href="#" class="btn btn-success col-md-1" style="margin-top:10px; margin-left:15px;">Guardar</a>
    </div>
    <div class="row"><a href="/comerciantes/logout">Salir</a></div>
</div>
<script lang="javascript" type="text/javascript">
	$(document).ready(function(){
		$(".switched").each(function(){
			$(this).bootstrapSwitch();
		});
		
		$("#guardar-servicios").click(function(){
			console.log('Guardando...');
		});
	});
</script>
</body>
</html>