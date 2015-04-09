<?php
include_once("../Funciones/conexion_db.php");
require_once '../home/utils/phpthumb-latest/ThumbLib.inc.php';  

$opcion = $_POST['opcion_art_ined'];

$formatos_permitidos = array("image/jpg", "image/jpeg", "image/png");
$limit_kb = 4000;

//Para crear un nuevo artículo
if( $opcion == 0 ){
	echo "Se creará un nuevo artículo.<br>";
	$titulo_articulo	= $_POST['titulo'];
	$contenido_articulo = $_POST['contenido'];
	
	$opcion_img_radio	= $_POST['tipo_img'];
	
	$opcion_video_radio	= $_POST['tipo_video'];
	
	$id_categoriaAsoc	= $_POST['id_categoriaAsc'];
	
	$q = "INSERT INTO articulo (titulo_articulo, texto_articulo, id_categoria) 
		  VALUES('$titulo_articulo', '$contenido_articulo', $id_categoriaAsoc)";
	
	$conn = openconn();
	$q1 = mysql_query( $q ) or die( mysql_error() );
	
	$qIdArt = "SELECT MAX(id_articulo) AS id_articulo FROM articulo";
	$qIdArt1 = mysql_query( $qIdArt ) or die( mysql_error() );
	//closeconn($conn);
	
	$qIdArt1 = mysql_fetch_assoc( $qIdArt1 );
	$maxID = $qIdArt1['id_articulo'];
	
	switch( $opcion_img_radio  ){
		case "Fija":
			$no_imagenes	= 1;
			if( $_FILES['subir_imagen_fija']['error'] > 0 ){
				echo "Ha ocurrido un error";
			}else{
				/*$formatos_permitidos = array("image/jpg", "image/jpeg", "image/png");
				$limit_kb = 4000;*/
				
                /*-_-*/
                if(!mkdir("../imagenes_blog/".$maxID, 0777, true)) {
                    die('Fallo al crear las carpetas...');
                }
                $currentDir = "../imagenes_blog/".$maxID;
                /**/
                
				if( in_array($_FILES['subir_imagen_fija']['type'], $formatos_permitidos) && $_FILES['subir_imagen_fija']['size'] <= $limit_kb * 1024 ){
					$nRand = rand(1, 15);
					$nombre_img = "t".$opcion_img_radio."r".$nRand.$_FILES['subir_imagen_fija']['name'];
					//$ruta_img = "../imagenes_blog/".$nombre_img;
					/*-_-*/
                    $ruta_img = $currentDir."/".$_FILES['subir_imagen_fija']['name'];
                    
                    
                    /**/
                    $resultado_img = @move_uploaded_file( $_FILES['subir_imagen_fija']['tmp_name'], $ruta_img );
                    
                    //thumnbnail for home
                    $thumb = PhpThumbFactory::create($ruta_img);  
                    $thumb->resize(180, 180)->save($ruta_img);  
                    
                    //gray scale img
                    $im = imagecreatefromjpeg ($ruta_img);

                    if($im && imagefilter($im, IMG_FILTER_GRAYSCALE))
                    {
                        echo 'Imagen convertida a escala de grises.';
                        $arr_gray = explode("/",$ruta_img);
                        $path_gray ="";
                        for($i = 0; $i < count($arr_gray) -1 ; $i++)
                        {
                            $path_gray .= $arr_gray[$i]."/";
                        }
                        $info = pathinfo($_FILES['subir_imagen_fija']['tmp_name']);
                        $path_gray .= "gray.jpg";
                        
                        imagejpeg ($im, $path_gray);
                        //$resultado_img = @move_uploaded_file( $_FILES['subir_imagen_fija']['tmp_name'], $ruta_img );
                    }
                    else
                    {
                        echo 'La conversión a escala de grises falló.';
                    }

                    imagedestroy($im);
                    
                    
					if( $resultado_img ){
						$qUpdate = "UPDATE articulo SET id_imagen = $no_imagenes WHERE id_articulo = $maxID";
						
						//Insert img
						$qImg = "INSERT INTO imagenes (url_imagen, tipo_despliegue, id_articulo) 
							  VALUES('$ruta_img', 1, $maxID)";
						
						//$conn = openconn();
						$qUpdate1 = mysql_query( $qUpdate ) or die( mysql_error() );
						$qImg1 = mysql_query( $qImg ) or die( mysql_error() );
						//closeconn($conn);
					}else{
						echo "Ocurrió un error al mover el archivo.";
					}	
				}else{
					echo "Archivo no permitido, es tipo de archivo prohibido o excede el tamano de ".$limit_kb." Kilobytes";
				}
				//echo "<br>Se seleccionó la opción imagen fija...<br>";
			}	
		break;
		
		case "Galeria":
			//echo "<br>Se seleccionó la opción imagen galería...<br>";
			$num_img_galeria	= $_POST['num_imgs_galeria'];
			for( $i=0; $i<$num_img_galeria; $i++){
				if( $_FILES['load_img_galeria'.$i]['error'] > 0 ){
					echo "Ha ocurrido un error en: ".$i;
				}else{
					if(in_array($_FILES['load_img_galeria'.$i]['type'],$formatos_permitidos) && $_FILES['load_img_galeria'.$i]['size'] <= $limit_kb*1024){
						$nRand = rand(1, 15);
						$nombre_img = "t".$opcion_img_radio."r".$nRand.$_FILES['load_img_galeria'.$i]['name'];
						$ruta_img = "../imagenes_blog/".$nombre_img;
						$resultado_img = @move_uploaded_file( $_FILES['load_img_galeria'.$i]['tmp_name'], $ruta_img );
						
						if( $resultado_img ){
							$qUpdate = "UPDATE articulo SET id_imagen = $num_img_galeria WHERE id_articulo = $maxID ";
							
							//insert img
							$qImg = "INSERT INTO imagenes(url_imagen, tipo_despliegue, id_articulo)
									VALUEs('$ruta_img', 2, $maxID)";
							
							//$conn = openconn();
							$qUpdate1 = mysql_query( $qUpdate ) or die( mysql_error() );
							$qImg1 = mysql_query( $qImg ) or die( mysql_error() );
							//closeconn($conn);
						}else{
							echo "Ocurrió un error al mover el archivo.";
						}
						
					}else{
						echo "Archivo no permitido, es tipo de archivo prohibido o excede el tamano de ".$limit_kb." Kilobytes";
					}
				}
				//$up_img_galeria[$i] = $_POST['load_img_galeria'.$i];
			}
			
			//echo "<br><br>Imagenes galería:_ ".$num_img_galeria."<br>";
	
			for( $i=0; $i<$num_img_galeria; $i++){
				echo "<br>".$i.":_ ".$up_img_galeria[$i];
			}
		break;
		
		case "Slide":
			//echo "<br>Se seleccionó la opción imagen slide...";
			$num_img_slide		= $_POST['num_imgs_slide'];
			
			for( $i=0; $i<$num_img_slide; $i++ ){
				if( $_FILES['load_img_slide'.$i]['error'] > 0 ){
					echo "Ha ocurrido un error en: ".$i;
				}else{
					if(in_array($_FILES['load_img_slide'.$i]['type'],$formatos_permitidos)&&$_FILES['load_img_slide'.$i]['size']<= $limit_kb*1024){
						$nRand = rand(1, 15);
						$nombre_img = "t".$opcion_img_radio."r".$nRand.$_FILES['load_img_slide'.$i]['name'];
						$ruta_img = "../imagenes_blog/".$nombre_img;
						$resultado_img = @move_uploaded_file( $_FILES['load_img_slide'.$i]['tmp_name'], $ruta_img );
						if( $resultado_img ){
							$qUpdate = "UPDATE articulo SET id_imagen = $num_img_slide WHERE id_articulo = $maxID ";
							//Insert img
							$qImg = "INSERT INTO imagenes(url_imagen, tipo_despliegue, id_articulo)
									VALUEs('$ruta_img', 3, $maxID)";
							//$conn = openconn();
							$qUpdate1 = mysql_query( $qUpdate ) or die( mysql_error() );
							$qImg1 = mysql_query( $qImg ) or die( mysql_error() );
							//closeconn($conn);
						}else{
							echo "Ocurrió un error al mover el archivo.";
						}
					}
				}
			}
			
			//echo "<br><br>Imagenes slide:_ ".$num_img_slide."<br>";
	
			for( $i=0; $i<$num_img_slide; $i++){
				echo "<br>".$i.":_ ".$up_img_slide[$i];
			}
		break;
	}
		
	if( $opcion_video_radio == "sin_video" ){
		echo "<br>No se seleccionó video<br>";
		$op_video = 0;
		closeconn($conn);
	}
	else if( $opcion_video_radio == "url_video"){
		echo "<br>Se tiene url del video";
		$up_url_video		= $_POST['url_video_input'];
		echo "<br>URL video:_ ".$up_url_video;
		$op_video = 1;
		
		$qUpdate = "UPDATE articulo SET id_video = $op_video WHERE id_articulo = $maxID";
						
		//Insert url_video
		$qVid = "INSERT INTO videos (id_articulo, url) 
			  VALUES($maxID, '$up_url_video')";
		
		//$conn = openconn();
		$qUpdate1 = mysql_query( $qUpdate ) or die( mysql_error() );
		$qVid1 = mysql_query( $qVid ) or die( mysql_error() );
		closeconn($conn);
		
	}
	
	/* echo "<br>Titulo:_ ".$titulo_articulo."<br> Contenido:_ ".$contenido_articulo
		."<br>opción de imagen:_ ".$opcion_img_radio
		
		."<br>Opción video:_ ".$opcion_video_radio
		
		."<br>id categoría asociado:_ ".$id_categoriaAsoc."<br>numero de imagenes:_ ".$no_imagenes."<br>op_video:_ ".$op_video; */
		
}
//Para editar un artículo
else if( $opcion == 1 ){
	$titulo_articulo = "Página principal";
	$id_imagen = $_POST['num_noticias'];
	$contenido_articulo = $_POST['contenido'];
	$id_categoria = 0;
	
	//echo $titulo_articulo." ".$id_imagen." ".$contenido_articulo." ".$id_categoria;
	
	$conn = openconn();
	$qr = "SELECT * FROM articulo WHERE id_categoria = 0";
	$qr1= mysql_query( $qr ) or die(mysql_error());
	
	if( mysql_num_rows($qr1) != 0 ){
		echo "existe";
		$q ="UPDATE articulo SET titulo_articulo='$titulo_articulo', texto_articulo='$contenido_articulo', id_imagen = $id_imagen, id_categoria=$id_categoria WHERE id_categoria = 0";
		
	}else{
		$q = "INSERT INTO articulo (titulo_articulo, texto_articulo, id_imagen, id_categoria) 
		  	  VALUES('$titulo_articulo', '$contenido_articulo', $id_imagen, $id_categoria)";
		echo "No existe";
	}
	
	$q1 = mysql_query( $q ) or die( mysql_error() );
	closeconn($conn);
}
//Para eliminar un artículo
else if( $opcion == 2 ){
	$id_articulo = $_POST['articulo_select'];
	
	$conn = openconn();
	$q = "DELETE FROM articulo WHERE id_articulo = $id_articulo";
	
	$qdi = "SELECT url_imagen 
			FROM imagenes 
			WHERE id_articulo = $id_articulo";
			
	$qdi = mysql_query( $qdi ) or die(mysql_error());
	
	while( $row = mysql_fetch_array($qdi) ){
		$dir_imagen = $row['url_imagen'];
		unlink( $dir_imagen );
	}
	
	$qI = "DELETE FROM imagenes WHERE id_articulo = $id_articulo";
	$qV = "DELETE FROM videos WHERE id_articulo = $id_articulo";
	
	$qI = mysql_query( $qI ) or die( mysql_error() );
	$qV = mysql_query( $qV ) or die( mysql_error() );
	$q = mysql_query( $q ) or die( mysql_error() );
	
	closeconn($conn);
}
else if( $opcion == 3 ){
	$titulo_articulo = $_POST['titulo'];
	$id_imagen = $_POST['num_noticias'];
	$contenido_articulo = $_POST['contenido'];
	$id_categoria = 0;
	
	//echo $titulo_articulo." ".$id_imagen." ".$contenido_articulo." ".$id_categoria;
	
	$conn = openconn();
	$qr = "SELECT * FROM articulo WHERE id_categoria = 0";
	$qr1= mysql_query( $qr ) or die(mysql_error());
	
	if( mysql_num_rows($qr1) != 0 ){
		echo "existe";
		$q ="UPDATE articulo SET titulo_articulo='$titulo_articulo', texto_articulo='$contenido_articulo', id_imagen = $id_imagen, id_categoria=$id_categoria WHERE id_categoria = 0";
		
	}else{
		$q = "INSERT INTO articulo (titulo_articulo, texto_articulo, id_imagen, id_categoria) 
		  	  VALUES('$titulo_articulo', '$contenido_articulo', $id_imagen, $id_categoria)";
		echo "No existe";
	}
	
	$q1 = mysql_query( $q ) or die( mysql_error() );
	closeconn($conn);
}

header("Location: welcome.php?articulo=ok");

?>