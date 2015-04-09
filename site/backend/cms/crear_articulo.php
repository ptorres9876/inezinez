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
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/ajaxfileupload.js"></script>
<script type="text/javascript" src="../js/crear_articulo.js"></script>

<script>
</script>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Nuevo articulo.</title>
</head>

<body>

<div class="grid flex">
<?php 
	include_once( "../Funciones/conexion_db.php" );
	include_once( "menuadmin.php" );
	
	$q = "SELECT * FROM categoria WHERE tipo_nivel = 1";
	$conn = openconn();
	$q1 = mysql_query( $q ) or die(mysql_error());
	closeconn($conn);
?>

<form name="form1" id="form1" method="post" action="ined_articulo.php" enctype="multipart/form-data" >

<fieldset>

	<div class="col_12">
        <fieldset>
            <legend><strong>Articulo</strong></legend> 
            <div class="col_12">   
            	
            	<div class="col_7">       
                    <label id="titulo_label">Titulo del articulo:</label>  
                    <input type="text" name="titulo" id="titulo" align="left" maxlength="75" size="105">
                    <input type="hidden" name="opcion_art_ined" id="opcion_art_ined" value="0" readonly>
                </div>
                <div class="col_5">
                	<div id="error_titulo_msj" class="left"></div>
                </div>
                
            </div>  
                       
            <br><br>
            
            <div class="col_12">
            	
                <div class="col_7">
                    <label>Contenido del articulo:</label>
                    <textarea name="contenido" id="contenido" cols="90" rows="2" ></textarea>
                </div>
                <div class="col_5">
                	<div id="error_contenido_msj" class="left"></div>
                </div>
            </div>
            
            <br><br>
            
            <!--<div class="col_12">
                <label>Tags:</label>
                <input type="text" name="tag" id="tag" align="left" size="30" maxlength="75">
            </div>-->
        </fieldset>
    </div>

	<fieldset>
        <legend><strong>Imagenes</strong></legend>
        
        <div id="opciones_img" class="col_12">
            <div class="col_3 center tooltip" data-content="#contenidoImgFijaHelp" >
            	<input type="radio" name="tipo_img" id="img_fija" value="Fija" checked> Fija
            </div>
            
            <div class="col_3 center tooltip" data-content="#contenidoImgGaleriaHelp" >
            	<input type="radio" name="tipo_img" id="img_galeria" value="Galeria"> Galeria
            </div>
            <!--<div class="col_3 center"><input type="radio" name="tipo_img" id="img_banner" value="Banner"> Banner</div>-->
            <div class="col_3 center tooltip" data-content="#contenidoImgSlideHelp">
            	<input type="radio" name="tipo_img" id="img_slide" value="Slide"> Slide
            </div>
        </div>
        
        <!--Mensajes de los tooltips -->
        <div class="tooltip-content" id="contenidoImgFijaHelp">
        	<h5>Tamaño imágenes fijas</h5>
            <img src="http://placehold.it/400x350/4D99E0/ffffff.png&text=400x350" width="180" height="150" />
            <p>El tamaño máximo recomendado para las imágenes fijas es de 400 x 350 pixeles.</p>
        </div>
        
        <div class="tooltip-content" id="contenidoImgGaleriaHelp">
        	<h5>Tamaño imágenes galería</h5>
            <img src="http://placehold.it/600x450/75CC00/ffffff.png&text=600x450" width="180" height="150" />
            <p>El tamaño máximo recomendado de las imágenes para las galerías es de 600 x 450 pixeles.</p>
        </div>
        
         <div class="tooltip-content" id="contenidoImgSlideHelp">
        	<h5>Tamaño imágenes slide</h5>
            <img src="http://placehold.it/550x350/E4247E/ffffff.png&text=550x350" width="180" height="150" />
            <p>El tamaño máximo recomendado de las imágenes para el slide es de 550 x 350 pixeles.</p>
        </div>
        
        <div class="col_12">
        	
            <div class="col_12">
                <img id="loading" src="../imagenes/loading.gif" style="display:none;">
                <div id="error" class="error"><span></span></div>
                <div id="correcto" class="correcto"><span></span></div>
            </div>
        
            <div id="opcion_img_fija" class="col_12">
                <fieldset>
                    <legend>Imagen Fija</legend>
                    <div class="col_12">
                    	<div class="col_12">
                            <label>Subir imagen:</label>
                            <input type="file" name="subir_imagen_fija" id="subir_imagen_fija" accept=".jpg*" onChange="validar(this, 'jpg', 4096000);"/>
                        </div>
                        
                        <div class="col_12 left">
	                        <div id="error_input_img_fija"></div>
                        </div>
                        
                    </div>
                        
                </fieldset>
            </div>        
            
            <div id="opcion_img_galeria" class="col_12 ">
                <fieldset>
                    <legend>Agregar imagenes para la galeria</legend>
                    <div class="col_12 ">
                    	<div class="col_12">
                            Numero de imagenes:
                            <select name="num_imgs_galeria" id="num_imgs_galeria">
                            <?php
                                for( $i = 1; $i < 6; $i++ ){
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            ?>            
                            </select>
                        </div>
                        
                        <div id="tabla_imagenes_galeria" class="col_12"></div>
                        
                        <div class="col_12">
                        	<div id="error_input_img_galeria"></div>
                        </div>
                        
                    </div>
                    
                </fieldset>
            </div>
            <!--<div id="opcion_img_banner">
            </div>-->
            <div id="opcion_img_slide">
                <fieldset>
                    <legend>Agregar imagenes para el slide</legend>
                    <div class="col_12 ">
                    	<div class="col_12">
                            Numero de imagenes:
                            <select name="num_imgs_slide" id="num_imgs_slide">
                            <?php
                                for( $i = 1; $i < 6; $i++ ){
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            ?>
                            </select>
                        </div>

                        <div id="tabla_imagenes_slide" class="col_12"></div>
                        
                        <div class="col_12">
                        	<div id="error_input_img_slide" ></div>
                        </div>
                        
                    </div>
                    
                </fieldset>
        	</div>
        </div>
    </fieldset>
    <!--</div> -->
    
    <fieldset>
    	<legend><strong>Video</strong></legend>
        
        <div id="opciones_video" class="col_12">
        	<div class="col_6 center"><input type="radio" name="tipo_video" id="no_video" value="sin_video" checked> Sin video.</div> 
            <div class="col_6 center"><input type="radio" name="tipo_video" id="url_video" value="url_video"> Insertar video.</div>
        </div>
        
        <div class="col_12">
        	<div id="url_videoD" class="col_7">
                <label>URL del video:</label>
                <input type="text" name="url_video_input" id="url_video_input" align="left" size="97" maxlength="75">
            </div>
            
            <div class="col_5">
            	<div id="error_urlvideo_msj" class="left"></div>
            </div>
        </div>
        
    </fieldset>
    
    <fieldset>
    	<legend><strong>Sección</strong></legend>
    	<div class="col_12">
    		<label>Categoría en la que estará el artículo:</label>
            <select name="id_categoriaAsc" name="id_categoriaAsc">
            <?php
                while( $row = mysql_fetch_array($q1) ){
                    echo '<option value="'.$row['id_categoria'].'">'.$row['nombre_categoria'].'</option>';
                } 
            ?>
            </select>
            
	    </div>
    </fieldset>
    
    <div class="col_12">
    	<div class="col_12 center" id="boton_crear">
        	<button class="large blue">
            	<i class="icon-plus"></i> Crear articulo
            </button>
        </div>
    </div>
    
</fieldset>

</form> <!-- End form1 -->
</div><!-- End div grid -->

</body>
</html>