<?php
	session_start();
	$user = $_SESSION['user'];
	$id	  = $_SESSION['id'];
	//echo $id.' '.$user;
	
	$id_articulo = $_POST['articulo_select'];
	
	echo $id_articulo;
	
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
<title>Editar articulo</title>
</head>

<body>

<div class="grid flex">
<?php 
	include_once( "menuadmin.php" );
?>

	<form id="form1" method="post" action="">
    <fieldset>
    
    </fieldset>
    </form>

</div>

</body>
</html>