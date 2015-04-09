<!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="../css/kickstart.css" media="all" />
<link rel="stylesheet" type="text/css" href="../style.css" media="all" /> 
<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../js/kickstart.js"></script>
<!-- KICKSTART -->

<script type="text/javascript">

$(document).ready(function(e) {
	
	$("#button").click(function(e) {
		var usr = $("#username").val();
		var psw = $("#password").val();
		
		if( usr == ""){
			alert('El campo Usuario esta vacio.');
			$("#username").focus();
			return false;
		}
		
		if( psw == "" ){
			alert('El campo Contraseña esta vacio.');
			$("#password").focus();
			return false;
		}
		   
    });	
	
});

</script>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Log in</title>
</head>

<body>
	<div class="grid flex col_12">
        <form id="form1" name="form1" method="post" action="validauser.php" >
        <fieldset>
        	<div class="col_3"></div>
            
        	<div class="col_6 center">
            	<h2>Inicio de Sesión</h2>
                <fieldset>
                <div class="col_12">
                	<div class="col_3"></div>
                	<div class="col_3"><label for="username2" class="col_12"> Usuario: </label></div>
                    <div class="col_3 right"><input class="col_12" type="text" id="username" name="username" /> </div>
                    <div class="col_3"></div>
                </div>
                  
                <div class="col_12">
                	<div class="col_3"></div>
                    <div class="col_3"><label for="password" class="col_12">Contraseña: </label></div>
                    <div class="col_3 right"><input class="col_12" type="password" id="password" name="password" /></div>
                    <div class="col_3"></div>
				</div>
                  
                  <?php
                  if( isset($_GET['error']) ){
                      $error = $_GET['error'];
                      if( $error == 1 ){
                          $mensaje = "La contraseña es incorrecta.";
                      }else{
                          $mensaje = "El usuario no está dentro del sistema.";
                      }
                  ?>
                        <p style="color:#F00"><?php echo $mensaje;?> </p>
                  <?php				  
                  } 
                  ?>
                  
				<input id="button" name="button" class="button_sldr large blue" value="Iniciar" type="submit" />
                
                  </fieldset>
        	</div>
            
            <div class="col_3"></div>
        </fieldset>
        </form>
	</div>       
</body>

</html>
