<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/css/bootstrap.css">
<link rel="stylesheet" href="/css/main.css">
<title>infomercado.mx - Informacion de Merados Publicos en la Ciudad de Mexico</title>
<!-- Latest compiled and minified JavaScript -->
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<style>
body{padding-top:70px;}
</style>
</head>

<body>
<div class="container">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container" align="center">
  	<div class="navbar-header"><p class="navbar-brand">infomercado.mx</p></div>
  </div>
</nav>
    <div class="list-group">
    	<?php foreach($delegaciones as $delegacion){ ?>
	    	<a href="/mercados/<?php print($delegacion->link); ?>" class="list-group-item"><?php print($delegacion->delegacion_nombre); ?></a>
    	<?php } ?>
    </div>
    <div class="list-group">
	    <?php foreach($tipos as $tipo){ ?>
	    	<a href="/mercados/<?php print($tipo->link); ?>" class="list-group-item"><?php print($tipo->tipo_desc); ?></a>
    	<?php } ?>
    </div>
</div>
<script language="javascript">
</script>
</body>
</html>
