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
    	<h3>Bienvenido <?php print(Auth::user()->nombre);?> <span class="small"><a class="" href="/comerciantes/logout">Salir</a></span></h3>
    	<h4>Mercado: <?php print("#".$mercado_datos[0]->numero." - ".$mercado_datos[0]->nombre);?></h4>
    </div>
    <div class="row">
    	<h4>Activa los servicios que ofreces en tu local</h4>
    	<div class="col-md-3">
	    	Servicio a Domicilio<br>
	    <input id="domicilio" type="checkbox" data-on-color="success" class="switched" <?php if($settings[0]=='true') print("checked") ; ?>>
    	</div>
    	<div class="col-md-3">
	    	Acepta tarjetas<br>
	    <input id="tarjetas" type="checkbox" data-on-color="success" class="switched" <?php if($settings[1]=='true') print("checked") ; ?>>
    	</div>
    	<div class="col-md-3">
	    	Acepta Vales<br>
	    <input id="vales" type="checkbox" data-on-color="success" class="switched" <?php if($settings[2]=='true') print("checked") ; ?>>
    	</div>
    	<div class="col-md-3">
	    	Lista de Precios<br>
	    <input id="precios" type="checkbox" data-on-color="success" class="switched" <?php if($settings[3]=='true') print("checked") ; ?>>
    	</div>
    	<a id="guardar-servicios" href="#" class="btn btn-success col-md-1" style="margin-top:10px; margin-left:15px;">Guardar</a>
    </div>
    <hr>
    <div class="row">
    	<h4>Ofertas</h4>
	    <div class="col-md-12">
		    <table class="table table-striped">
		      <thead>
		        <tr>
		          <th>Oferta</th>
		          <th>Cuando se Aplica</th>
		          <th></th>
		        </tr>
		      </thead>
		      <tbody>
		      <?php foreach($ofertas as $oferta) { ?>
		        <tr>
		          <td><?php print($oferta->oferta); ?></td>
		          <td>Solo Hoy</td>
		          <td></td>
		        </tr>
		       <?php } ?>
		      </tbody>
		    </table>
		    <hr>
		    <h5>Publicar nueva Oferta</h5>
		    <form class="form" role="form">
			  <div class="form-group">
			    <label class="sr-only" for="oferta">Texto de la Oferta</label>
			    <input type="text" class="form-control" id="oferta" placeholder="Ej. En la compra de 1Kg de pollo llevate 2 piernas">
			  </div>
			  <div class="form-group">
			     <select class="form-control" id="aplica">
			     	<option value="1">Solo Hoy</option>
			     	<option value="2">Toda la Semana</option>
			     	<option value="3">Todo el Mes</option>
			     	<option value="4">Siempre</option>
			     </select>
			  </div>
			  <a href="#" id="publicar-oferta" class="btn btn-success">Publicar</a>
			</form>
	    </div>
    </div>
    <div class="row"></div>
    
</div>
<script lang="javascript" type="text/javascript">
	$(document).ready(function(){
		$(".switched").each(function(){
			$(this).bootstrapSwitch();
		});
		
		$("#guardar-servicios").click(function(){
			console.log('Guardando...');
			
			var settingsData = {
				domicilio : $("#domicilio").bootstrapSwitch('state'),
				tarjetas : $("#tarjetas").bootstrapSwitch('state'),
				vales : $("#vales").bootstrapSwitch('state'),
				precios : $("#precios").bootstrapSwitch('state')
			};
			
			$.ajax({
				url : '/comerciantes/update',
				method : 'post',
				data : settingsData,
				success : function(response) {
					if(response == '1') {
						alert('guardados !');
					} else {
						alert('No se pudo actualizar');
					}
				},
				error : function() {
					console.log("error");
				}
			});
		});
		
		//agrega oferta
		$("#publicar-oferta").click(function(){
			console.log('Guardando oferta...');
			
			var ofertaData = {
				oferta : $("#oferta").val(),
				aplica : $("#aplica").val()
			};
			
			$.ajax({
				url : '/comerciantes/nuevaoferta',
				method : 'post',
				data : ofertaData,
				success : function(response) {
					if(response == '1') {
						document.location.reload();
					} else {
						alert('No se pudo agregar la oferta');
					}
				},
				error : function() {
					console.log("error");
				}
			});
		});
	});
</script>
</body>
</html>