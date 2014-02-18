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
<div id="main-registro" class="container" align="left">
	<div class="row offset-superior">
    	<h3>Bienvenido <?php print(Auth::user()->nombre);?></h3>
    	<h4>Mercado: <?php print("#".$mercado_datos[0]->numero." - ".$mercado_datos[0]->nombre);?></h4>
    </div>
    <div class="row">
    	<h4>Activa los servicios que ofreces en tu local</h4>
    	<div class="col-md-2">
	    	Test<br>
	    <input type="checkbox" data-on-color="success" class="switched" checked>
    	</div>
    	<div class="col-md-2">
	    	Test<br>
	    <input type="checkbox" data-on-color="success" class="switched" checked>
    	</div>
    	<div class="col-md-2">
	    	Test<br>
	    <input type="checkbox" data-on-color="success" class="switched" checked>
    	</div>
    	<div class="col-md-2">
	    	Test<br>
	    <input type="checkbox" data-on-color="success" class="switched" checked>
    	</div>
    	<div class="col-md-offset-4"></div>
    	
    </div>
    <div class="row"><a href="/comerciantes/logout">Salir</a></div>
</div>
<script lang="javascript" type="text/javascript">
	$(document).ready(function(){
		$(".switched").each(function(){
			$(this).bootstrapSwitch();
		});
	});
</script>
</body>
</html>