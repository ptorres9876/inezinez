<?php 
include_once( "../Funciones/conexion_db.php" );

$opcion = $_POST['opcion_cat_ined'];

//Para crear nueva categoría o subcategoría
if( $opcion == 0 ){
	$opcion_catsub = $_POST['opcion_catH'];
	$id_categoria = $_POST['id_categoria'];
	//echo $opcion.' '.$opcion_catsub.' '.$id_categoria;
	$titulo_cat = $_POST['titulo_cat'];
	
	if( $opcion_catsub == 1 ){
		$q = "INSERT INTO categoria (nombre_categoria, url_categoria, id_categoria_padre, tipo_nivel) VALUES('$titulo_cat', '$titulo_cat', $id_categoria, 1)";
	}else{
		$q = "INSERT INTO categoria (nombre_categoria, url_categoria) VALUES('$titulo_cat', '$titulo_cat')";
	}
	//echo "Se insertó la categoria: ".$titulo_cat;
}
//Para actualizar categoría o subcategoría
else if( $opcion == 1 ){
	$id_cat = $_POST['id_cat'];
	$titulo_cat = $_POST['titulo_cat'];
	
	$opcion_catsub = $_POST['opcion_catH'];
	$id_categoria = $_POST['id_categoria'];
	//echo $opcion.' '.$opcion_catsub.' '.$id_categoria;
	
	if( $opcion_catsub == 1 ){
		$q = "UPDATE categoria SET nombre_categoria = '$titulo_cat', url_categoria = '$titulo_cat', id_categoria_padre = $id_categoria, tipo_nivel = 1 WHERE id_categoria = $id_cat ";
	}else{		
		$q = "UPDATE categoria SET nombre_categoria = '$titulo_cat', url_categoria = '$titulo_cat', id_categoria_padre = NULL, tipo_nivel = 0 WHERE id_categoria = $id_cat ";
	}
	
	//echo "Se edito la categoria: ".$titulo_cat." con id: ".$id_cat;	
}
//Para eliminar categoría o subcategoría
else if( $opcion == 2 ){
	$id_cat = $_POST['id_cat'];
	//$titulo_cat = $_POST['titulo_cat'];
	$q = "DELETE FROM categoria WHERE id_categoria = $id_cat";
}

$conn = openconn();
$q = mysql_query( $q ) or die( mysql_error() );
closeconn($conn);

header("Location: welcome.php?categoria=ok");
?>