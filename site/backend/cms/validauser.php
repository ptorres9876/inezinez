<?php
include_once("../Funciones/conexion_db.php");

$user	= $_POST['username'];
$pass	= $_POST['password'];


$query = " SELECT *
		  FROM usuario
		  WHERE nombre_usuario = '$user'
		  AND tipo_usuario = 1 ";
		  
$oConn = openconn();
$query1 = mysql_query( $query ) or die( mysql_error() );
$row = mysql_fetch_assoc( $query1 );
closeconn( $oConn );

if( mysql_num_rows($query1) != 0 ){
	if( $pass != $row['pass_usuario'] ){
		//echo 'pass no valido';
		header("Location: index.php?error=1");
	}else{
		//echo 'entra';
		session_start();
		$_SESSION['user'] 	= $user;
		$_SESSION['id']		= $row['id_usuario'];
		header("Location: welcome.php");
	}
}else{
	//echo 'No existe';
	header("Location: index.php?error=2");
}


?>