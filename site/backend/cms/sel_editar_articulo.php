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

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar articulo.</title>
</head>

<body>

	<div class="grid flex">
<?php 	
	include_once( "../Funciones/conexion_db.php" );
	
	$q = "SELECT * FROM articulo WHERE 1";
	$conn = openconn();
	$q1 = mysql_query( $q ) or die(mysql_error());
	closeconn($conn);
	
	include_once( "menuadmin.php" );
?>
	<form name="form1" method="post" action="editar_articulo.php">
    	<fieldset>
        	<div class="col_12">
            	<fieldset>
        			<legend><strong>Seleccione el artículo que desea editar.</strong></legend>
                    <div class="col_12 center">
                        Articulo:
                        <select name="articulo_select" id="articulo_select">
                        <?php 
							while( $row = mysql_fetch_array($q1) ){ 
						?>
								<option value="<?php echo $row['id_articulo'] ?>"><?php echo $row['titulo_articulo'] ?></option>
                        <?php		
							}
						?>
                        </select>
                    </div>
                    
                    <div class="col_12 center">
                    	<button class="large blue">
                            <i class="icon-pencil"></i> Editar articulo
                        </button>
                    </div>
                    
                </fieldset>
            </div>
            
        </fieldset>
	</form>
 </div>

</body>
</html>