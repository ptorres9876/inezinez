<?php

function openconn(){
	/*$servidor = "localhost";
	$base_datos = "bosccomm_inezbd";
	$usuariobd = "bosccomm_inez";
	$passwordbd = "1n3zP4ss";*/
	
	$servidor = "localhost";
	$base_datos = "bosccomm_inezbd";
	$usuariobd = "bosccomm_inez";
	$passwordbd = "developer9876";
	
	$enlace = mysql_connect( $servidor, $usuariobd, $passwordbd ) or trigger_error( mysql_error() );
	mysql_select_db( $base_datos, $enlace );
	
	return $enlace;
}

function closeconn( $enlace ){
	mysql_close( $enlace ) or trigger_error( mysql_error() );
}

?>