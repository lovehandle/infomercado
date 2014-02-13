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
<div id="main" class="container" align="center">
	<div class="row offset-superior">
    	<h3>Bienvenido <?php print(Auth::user()->nombre);?></h3>
    </div>
    <div class="row">
	  <div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Completa tu registro</h3>
	  </div>
	  <div class="panel-body">
	  	<p>Completa estos datos para terminar tu registro</p>
	    <form class="form-horizontal" role="form">
			<div class="form-group">
				<label for="usuario-login" class="col-sm-2 control-label">Mercado</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="mercado-nombre" placeholder="Lagunilla Varios">
				</div>
			</div>
			<div class="form-group">
				<label for="pass-login" class="col-sm-2 control-label">Numero de Local</label>
				<div class="col-sm-10">
					<input type="number" class="form-control" id="local">
				</div>
			</div>
			<label for="pass-login" class="col-sm-2 control-label">Categoria</label>
				<div class="col-sm-10">
					<input type="number" class="form-control" id="local">
				</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <a id="go-login" href="#" class="btn btn-success">Guardar</a>
				  <div id="info-login"></div>
				</div>
			</div>
		</form>
	  </div>
	</div><!-- panel login -->
    </div>
    <div class="row"><a href="/comerciantes/logout">Salir</a></div>
</div>
</body>
</html>