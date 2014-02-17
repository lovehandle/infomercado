<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/main.css">
<title>infomercado.mx - Comerciantes</title>
<!-- Latest compiled and minified JavaScript -->
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
</head>
<body>
<div id="main-registro" class="container" align="left">
	<div class="row offset-superior">
    	<h3>Bienvenido <?php print(Auth::user()->nombre);?></h3>
    	<p>Mercado: <?php print($mercado_datos->nombre);?></p>
    </div>
    <div class="row"><a href="/comerciantes/logout">Salir</a></div>
</div>
</body>
</html>