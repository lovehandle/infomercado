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
<div id="main-registro" class="container" align="center">
	<div id="reg-data" class="row offset-superior">
    	<h2 class="site-title">Registro de Comerciantes</h2>
    	<p>Para registrarte escribe tu nombre, un nombre de usuario y una contraseña</p>
    	<form class="form-horizontal" role="form">
			<div class="form-group">
				<label for="nombre" class="col-sm-2 control-label">Nombre</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nombre" placeholder="Juan Perez Lopez">
				</div>
			</div>
			<div class="form-group">
				<label for="usuario" class="col-sm-2 control-label">Usuario</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="usuario" placeholder="juanperez">
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword" class="col-sm-2 control-label">Contraseña</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="inputPassword">
				</div>
			</div>
			<div class="form-group">
				<div id="info" class="col-sm-offset-2 col-sm-10">
				  <a id="registrar" href="#" class="btn btn-success">Registrar</a>
				</div>
			</div>
		</form>
    </div>
</div>
<script lang="javascript" type="text/javascript">

$(document).ready(function(){
	
	$("#registrar").click(function(){
	
		//eliminar el boton de registro
		$("#registrar").hide();
		$("#usuario").prop("disabled",true);
		$("#nombre").prop("disabled",true);
		$("#inputPassword").prop("disabled",true);
		
		console.log('Registrando ... ');
		
		//validar aqui - pendiente
		var formData = {
			usuario : $("#usuario").val(),
			nombre : $("#nombre").val(),
			pass : $("#inputPassword").val()
		};
		
		//ajax aqui
		$.ajax({
			url : '/comerciantes/registro',
			method : 'post',
			data : formData,
			success : function(response) {
				console.log(response);
				if(response) {
					console.log('todo bien');
					$("#info").empty();
					$("#info").append("<p>Has sido registado ! Para comenzar a utilizar el portal inicia sesion con el usuario y contraseña que acabas de crear.</p>");
				}else{
					console.log('algo mal');
				}
			},
			error : function() {
				console.log('ajax error');
			}
		});
		
	});
	
});
</script>
</body>
</html>