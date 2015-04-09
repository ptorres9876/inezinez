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
<title>Eliminar categoría.</title>
</head>

<body>
	
    <div class="grid flex">
<?php 
	include_once( "../Funciones/conexion_db.php" );
	include_once( "menuadmin.php" );
?>
	
    <form name="form1" method="post" action="ined_categoria.php">
    	<fieldset>
        	<div class="col_12">
            	<fieldset>
                	<legend><strong>Seleccione la categoría que desee eliminar.</strong></legend>
                    <div class="col_12 center">
                    	Categoría:
                        <select name="id_cat" id="id_cat">
                        	<?php 
								$q = "SELECT *
									  FROM categoria
									  WHERE 1";
								
								$conn = openconn();
								$q = mysql_query( $q ) or die( mysql_error() );
								
								
								while( $row = mysql_fetch_array($q) ){							
							?>
								<option value="<?php echo $row['id_categoria']; ?>"><?php echo $row['nombre_categoria']; ?></option>
							<?php 
							}
								closeconn( $conn );
							?>
                            <input name="opcion_cat_ined" id="opcion_cat_ined" value="2" type="hidden">
                        </select>
                    </div>
                    
                    <div class="col_12 center">
                    	<button class="large blue">
                        	<i class="icon-remove"></i> Eliminar categoría
                        </button>
                    </div>
                    
                </fieldset>
            </div>
        </fieldset>
    </form>
    
    </div>
    
</body>
</html>