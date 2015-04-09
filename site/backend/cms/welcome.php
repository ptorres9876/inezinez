<?php
	session_start();
	$user = $_SESSION['user'];
	$id	  = $_SESSION['id'];
?>

<!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="../css/kickstart.css" media="all" />
<link rel="stylesheet" type="text/css" href="../style.css" media="all" /> 
<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../js/kickstart.js"></script>
<!-- KICKSTART -->

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Administracion</title>
</head>

<body>

<div class="grid flex">
<?php 
	include_once( "menuadmin.php" );
	include_once("../Funciones/conexion_db.php");
	
	/* $img = 'tGaleriar1332.jpg';
	$carpeta = '../imagenes_blog/';
	unlink($carpeta.$img); */
	
	if( isset($_GET['categoria']) ){
		echo '<script type="text/javascript">alert("La operación se ha realizado con éxito.");</script>';
	}
	if( isset($_GET['articulo']) ){
		echo '<script type="text/javascript">alert("El artículo se ha creado correctamente.");</script>';
	}
	
?>

<fieldset>
<div class="col_12 center">
	<h1>Bienvenido</h1>
</div>
</fieldset>

</div>
</body>
</html>`
