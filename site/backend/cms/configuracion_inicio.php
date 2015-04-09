<?php
	session_start();
	$user = $_SESSION['user'];
	$id	  = $_SESSION['id'];
	//echo $id.' '.$user;
?>

<!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="../css/kickstart.css" media="all" />
<link rel="stylesheet" type="text/css" href="../style.css" media="all" /> 
<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../js/kickstart.js"></script>
<!-- KICKSTART -->

<script>
$(document).ready(function(e) {
    $("#form1").submit(function(e) {
        var contenido = $("#contenido").val();
		var titulo = $("#titulo").val();
		
		if( contenido == "" ){
			$("#msj_error").show();
			$("#msj_error").addClass("notice error");
			$("#msj_error").html("<i class='icon-remove-sign icon-small'></i>No ha ingresado texto en el contenido de la pagina principal.");
			$("#contenido").focus();
			$("#msj_error").fadeOut(3000);
			//alert("No ha ingresado texto en el contenido de la pagina principal.");
			return false;
		}
		
		if( titulo == "" ){
			$("#msj_error_titulo").show();
			$("#msj_error_titulo").addClass("notice error");
			$("#msj_error_titulo").html("<i class='icon-remove-sign icon-small'></i>No ha ingresado un titulo para la pagina principal.");
			$("#titulo").focus();
			$("#msj_error_titulo").fadeOut(3000);
			//alert("No ha ingresado texto en el contenido de la pagina principal.");
			return false;
		}
		
    });
});
</script>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Configuracion</title>
</head>

<body>
<div class="grid flex">
<?php 
	include_once( "../Funciones/conexion_db.php" );
	include_once( "menuadmin.php" );
	
	$conn = openconn();
	$qr = "SELECT * FROM articulo WHERE id_categoria = 0";
	$qr1= mysql_query( $qr ) or die(mysql_error());
	$row = mysql_fetch_assoc($qr1);
	closeconn($conn);
?>

<form name="form1" id="form1" method="post" action="ined_articulo.php">
	<fieldset>
    	<legend><strong>Configuración de la página principal.</strong></legend>
        <div class="col_12">
        	<div class="col_12">
        	<fieldset>
            	<legend><strong>Slider</strong></legend>
                <div class="col_12">
	                Número de noticias recientes: 
                    <input type="hidden" name="opcion_art_ined" id="opcion_art_ined" value="3" readonly>
                     <select name="num_noticias" id="num_noticias">
					<?php
                        for( $i = 2; $i < 11; $i++ ){
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                    ?>            
                    </select>
                </div>
            </fieldset>
            </div>
            <div class="col_12">
            <fieldset>
            	<legend><strong>Contenido</strong></legend>
                <label>Titulo:</label>
                <?php
				if( mysql_num_rows($qr1) != 0 ){
				?>
                <input type="text" name="titulo" id="titulo" align="left" maxlength="75" size="105" value="<?php echo $row['titulo_articulo']; ?>">
                <?php
				}else{
				?>
                <input type="text" name="titulo" id="titulo" align="left" maxlength="75" size="105">
                <?php }
				?>
                <div class="col_12">
                    <div id="msj_error_titulo"></div>
                </div>
                <br>
                <label>Texto:</label>
                <br>
                <?php
				if( mysql_num_rows($qr1) != 0 ){
				?>
                <textarea name="contenido" id="contenido" cols="90" rows="2" ><?php echo $row['texto_articulo']; ?></textarea>
				<?php
				}else{
				?>
                <textarea name="contenido" id="contenido" cols="90" rows="2" ></textarea>
                <?php }
				?>
            </fieldset>
            </div>
            
            <div class="col_12">
            	<div id="msj_error"></div>
            </div>
            
            <!--<div id="opcion_img_fija" class="col_12">
                <fieldset>
                    <legend><strong>Imagen</strong></legend>
                    <div class="col_12">
                    	<div class="col_12">
                            <label>Subir imagen:</label>
                            <input type="file" name="subir_imagen_fija" id="subir_imagen_fija" accept="image/*"/>
                        </div>
                        <div class="col_12 left">
	                        <div id="error_input_img_fija"></div>
                        </div>
                        
                    </div>
                        
                </fieldset>
            </div> -->
            
            <div class="col_12 center" id="boton_crear">
                <button class="large blue">
                    <i class="icon-plus"></i> Guardar
                </button>
            </div>
        </div>
    </fieldset>
</form>

</div>
</body>

</html>