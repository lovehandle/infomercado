<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/css/bootstrap.css">
<link rel="stylesheet" href="/css/main.css">
<title>infomercado.mx</title>
<!-- Latest compiled and minified JavaScript -->
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<style>
.el-header{height: 80px; background-color: #f4f4f4;}
.header-titulo{ font-size: 20pt; margin-top: 24px; color:#ea890d; display: block;}
.el-hader a:hover, .el-header a:link{
	color:#ea890d;
}
.mini-nav a{color: #FFF; font-size: 12pt; display: block; height: 60px; line-height: 64px;}
.nav-inicio{background-color: #d8682a; }
.nav-cerca{background-color: #ea890d; }
.list-group{font-size: 14pt !important; margin-top: 10px;}
</style>
</head>

<body>
<div class="container">
<div class="row el-header" align="center">
	<div class="col-xs-12">
		<p class="header-titulo">infomercado.mx</p>
	</div>
</div>
<div class="row mini-nav" align="center">
	<div class="col-xs-6 nav-inicio"><a href="/">INICIO</a></div>
	<div class="col-xs-6 nav-cerca"><a href="/mercados/cercano">UN MERCADO CERCA</a></div>
</div>
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
