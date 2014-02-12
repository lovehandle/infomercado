<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/main.css">
<title>infomercado.mx - Informacion de Merados Publicos en la Ciudad de Mexico</title>
<!-- Latest compiled and minified JavaScript -->
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
<style>
* {
	border-radius:0 !important;
	moz-border-radius:0;
}
.conoce,.opina,.otro{
	height:100px;
	color:#000;
	font-size:20pt;
	padding:10px;
	position:relative;
}
.textin{
	position:absolute;
	bottom:12px;
}

ext 107 angelica valencia

.conoce{background-color:#D9B74B;}
.opina{background-color:#F17A4F;}
.otro{}
</style>
</head>

<body>
<div id="main" class="container" align="center">
	<div class="row offset-superior">
    	<h2 class="site-title">infomercado.mx</h2>
        <p class="headline">Plataforma de información y participación ciudadana en los <br>Mercados Públicos de la Ciudad de México</p>
    </div>
    <div class="row">
    	<?php foreach($delegaciones as $delegacion){ ?>
    	<div class="col-md-delegaciones rowded">
	    	<a href="/mercados/<?php print($delegacion->link); ?>" class="delegaciones"><?php print($delegacion->delegacion_nombre); ?></a>
    	</div>
    	<?php } ?>
    </div>
    <div class="row">
	    <?php foreach($tipos as $tipo){ ?>
    	<div class="col-md-tipos rowded">
	    	<a href="/mercados/<?php print($tipo->link); ?>" class="delegaciones"><?php print($tipo->tipo_desc); ?></a>
    	</div>
    	<?php } ?>
    </div>
    <div id="footer" class="row" align="left">
    	<div class="col-md-12">
		<a href="/comerciantes">Acceso a comerciantes</a>
       </div>
    </div>
</div>
<script language="javascript">
</script>
</body>
</html>
