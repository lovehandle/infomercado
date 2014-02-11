<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/main.css">
<title>infomercado.mx - Comerciantes</title>
<!-- Latest compiled and minified JavaScript -->
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
</head>
<body>
<div id="main-registro" class="container">
	<h1>Comerciantes</h1>
	<div class="panel panel-success">
	  <div class="panel-heading">
	    <h3 class="panel-title">Iniciar Sesi&oacute;n</h3>
	  </div>
	  <div class="panel-body">
	    <form class="form-horizontal" role="form">
			<div class="form-group">
				<label for="usuario-login" class="col-sm-2 control-label">Usuario</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="usuario-login" placeholder="juanperez">
				</div>
			</div>
			<div class="form-group">
				<label for="pass-login" class="col-sm-2 control-label">Contraseña</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="pass-login">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <a id="go-login" href="#" class="btn btn-success">Iniciar Sesi&oacute;n</a>
				</div>
			</div>
		</form>
	  </div>
	</div><!-- panel login -->
	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Registro</h3>
	  </div>
	  <div id="panel-registro" class="panel-body">
	    <p>Si eres comerciante en un Mercado Público puedes registrarte en el portal gratuitamente. Solo necesitas proporcionar tu nombre, un usuario y una contraseña.</p>
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
				<div class="col-sm-offset-2 col-sm-10">
				  <a id="registrar" href="#" class="btn btn-primary">Registrar</a>
				  <div id="info"></div>
				</div>
			</div>
		</form>
	  </div>
	</div><!-- panel registro -->
</div>
<script lang="javascript" type="text/javascript">

$(document).ready(function(){
	
	$("#registrar").click(function(evt){
		evt.preventDefault();
		
		$("#info").empty();
	
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
				if(response == '1') {
					console.log('todo bien');
					$("#panel-registro").empty();
					$("#panel-registro").append('<p class="bg-success text-success" style="padding:15px">Has sido registado ! Para comenzar a utilizar el portal inicia sesion con el usuario y contraseña que acabas de crear.</p>');
					
				}else{
					$("#registrar").show();
					$("#usuario").prop("disabled",false);
					$("#nombre").prop("disabled",false);
					$("#inputPassword").prop("disabled",false);
					
					$("#info").empty();
					$("#info").append('<p class="bg-danger text-danger" style="padding:15px">No se pudo completar tu registro.</p>');
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
