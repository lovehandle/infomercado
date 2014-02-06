<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/main.css">
<title>infomercado.mx - Mercados en la delegaci&oacute;n <?php print($delegacion); ?></title>
<!-- Latest compiled and minified JavaScript -->
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
</head>

<body>
<div id="main" class="container">
<ol class="breadcrumb">
  <li><a href="/">Inicio</a></li>
  <li>Mercados en <?php print($delegacion); ?></li>
</ol>
<div class="row"><!-- row1 -->
 <div class="col-md-12">
  <h1>Mercados en la delegaci&oacute;n <?php print($delegacion); ?></h1>
 </div>
</div><!-- row1 -->

<div class="row"><!-- row2 -->

	<?php 
	foreach($mercados as $mercado) {
		
	?>
		<div class="col-md-6 rowded">
			<div class="mercado">
				<a href="/mercados/<?php print($mercado->numero); ?>" class="mercado-link"><?php print($mercado->nombre); ?></a>
			</div>
		</div>
<?php } ?>	
</div>


    
<div id="footer" class="row">
	<div class="col-md-12"></div>
</div>

</div><!-- container -->
</body>
</html>