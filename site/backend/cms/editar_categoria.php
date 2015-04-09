<?php
	session_start();
	$user = $_SESSION['user'];
	$id	  = $_SESSION['id'];
	//echo $id.' '.$user;
	
	$id_categoría = $_POST['categoria_select'];
?>

<!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="../css/kickstart.css" media="all" />
<link rel="stylesheet" type="text/css" href="../style.css" media="all" /> 
<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../js/kickstart.js"></script>
<!-- KICKSTART -->

<script>
$(document).ready(function(e) {
	
	$("#msj_error").hide();
	$("#opcion_subcategoria").hide();
	
	$("#form1").submit(function(e) {
		var titulocat_txt = $("#titulo_cat").val();
		var opt_cat = $("#subcat").is(":checked");		
				
		if( titulocat_txt == "" ){
			console.log("titulo vacio");
			$("#msj_error").show();
			$("#msj_error").addClass("notice error");
			$("#msj_error").html("<i class='icon-remove-sign icon-small'></i>Ingresa un titulo para la categoría por favor.");
			$("#titulo_cat").focus();
			$("#msj_error").fadeOut(3000);
			return false;
		}   
    });
	
	$("#subcat").change(function(e) {
        $("#opcion_subcategoria").show("slow");
		$("#opcion_catH").val("1");
    });
	
	$("#cat").change(function(e) {
        $("#opcion_subcategoria").hide("fast");
		$("#opcion_catH").val("0");
    });
	
});
</script>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar categoría</title>
</head>

<body>

<div class="grid flex">
    
<?php 
	include_once( "../Funciones/conexion_db.php" );
	
	$q = "SELECT *
		  FROM categoria
		  WHERE id_categoria = $id_categoría";
	
	$conn = openconn();
	$q = mysql_query( $q ) or die( mysql_error() );
	$row = mysql_fetch_assoc( $q );
	closeconn( $conn );
	
	include_once( "menuadmin.php" );
?>

<form id="form1" name="form1" method="post" action="ined_categoria.php">
    <fieldset>
    	<div class="col_12">
        	
            <fieldset>
            	<legend><strong>Tipo</strong></legend>
                <div class="col_12">
                	<div class="col_6"><input type="radio" name="tipo_cat" id="cat" value="categoria" checked>Categoría</div>
                    <div class="col_6"><input type="radio" name="tipo_cat" id="subcat" value="subcategoria">Subcategoría</div>
                    <input type="hidden" name="opcion_catH" id="opcion_catH" value="0" readonly>
                </div>
                
                <div id="opcion_subcategoria" class="col_12" >
                    <label>Categoría principal:</label>
                    <select name="id_categoria" id="id_categoria">
                        <?php 
						$q = "SELECT * FROM categoria WHERE tipo_nivel = 0 AND id_categoria != $id_categoría";
						$conn = openconn();
						$q1 = mysql_query( $q ) or die(mysql_error());
						closeconn($conn);
                        while( $row1 = mysql_fetch_array($q1) ){ ?>
                            <option value="<?php echo $row1['id_categoria'] ?>"><?php echo $row1['nombre_categoria'] ?></option>
                        <?php 
                        }
                        ?>
                    </select>
                </div>
                
            </fieldset>
        
        	<fieldset>
            	<legend><strong>Categoría</strong></legend>
                <div class="col_12">
                        <label id="titulo_categoria">Título de la categoría:</label>
                        <input type="text" name="titulo_cat" id="titulo_cat" value="<?php echo $row['nombre_categoria']; ?>" align="left" maxlength="60" size="64">
                        <input name="id_cat" id="id_cat" value="<?php echo $id_categoría; ?>" type="hidden">
                        <input name="opcion_cat_ined" id="opcion_cat_ined" value="1" type="hidden">
                </div>
                
                <div class="col_4">
                        <div id="msj_error" class="center"></div>
                    </div>
                
                <div class="col_12 center">
                    <button class="large blue">
                        <i class="icon-plus"></i> Editar categoría
                    </button>
                </div>
                
            </fieldset>
        </div>        
    </fieldset>
    </form>

</div>

</body>
</html>