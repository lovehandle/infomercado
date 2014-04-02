<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/css/bootstrap.css">
<link rel="stylesheet" href="/css/main.css">
<title>infomercado.mx</title>
<!-- Latest compiled and minified JavaScript -->
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGEM2AtRMpdnI3yoQTOu9hMQsOz3yvBaE&sensor=true">
    </script>
<style>
.el-header{background-color: #f4f4f4;}
.header-titulo{ font-size: 18pt; color:#ea890d; display: block; margin: 10px 0 10px 0;}
.el-hader a:hover, .el-header a:link{
	color:#ea890d;
}
.mini-nav a{color: #FFF; font-size: 12pt; display: block; height: 50px; line-height: 53px;}
.nav-inicio{background-color: #d8682a; }
.nav-cerca{background-color: #ea890d; }
.list-group{font-size: 14pt !important; margin-top: 10px;}

#map-canvas {background-color: #f4f4f4;}

.nombrecito{
	padding: 10px;
}
.row-nombre {
	border-bottom: 1px solid #797979;
}
.info{padding: 10px; font-weight: bold;}

@yield('extra-css')

</style>
</head>

<body>
<div id="elcont" class="container">
	<div class="row el-header" align="center">
		<div class="col-xs-12">
			<p class="header-titulo">infomercado.mx</p>
		</div>
	</div>
	@yield('contenido')
</div>

@yield('complemento')

</body>
</html>
