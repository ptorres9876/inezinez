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

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/ajaxfileupload.js"></script>
<!-- KICKSTART -->

<script>

function LimpiarInputFile(id){	
		id1 = "#"+id;
		var aux = $(id1).clone();
		aux.css('display','none');
		aux.val("");
		$(id1).after(aux);
		$(id1).remove();
		aux.attr('id',id)
		aux.show();
	}
	
	function validar(elem, tipo,tamanio_val){
		var archivo = $(elem);
		var nombre = archivo.val();
		var extension = nombre.substring(nombre.lastIndexOf(".")).toLowerCase();
		if (extension != "."+tipo){
			$("#error").html("<img src='../imagenes/cross.png'> El tipo del archivo es incorrecto...");
			$("#correcto").html("");
			$("#"+archivo.attr('id')).css("color","red");
			LimpiarInputFile(archivo.attr('id'));
		}
		else{
			$("#error").html("");
			$("#"+archivo.attr('id')).css("color","black");
			ajaxFileUpload(archivo.attr('id'), archivo.attr('name'), tamanio_val);
		}
	}
	/* Llamada a la funcion de ajax
	 * que envia el archivo a traves de json al 
	 * script doajaxfileupload.php, donde se 
	 * procesara
	 */
	function ajaxFileUpload(id,name,tamanio){
		$("#loading").ajaxStart(function(){   //Mostramos la imagen "loading"
			$(this).show();
		})
		.ajaxComplete(function(){   //Al terminar de cargar se oculta la imagen
			$(this).hide();
		});
		$.ajaxFileUpload({
				url:'../Funciones/doajaxfileupload.php', //URL en donde se procesara el archivo
				secureuri:false,
				fileElementId:id,
				dataType: 'json',
				fileElementName: name,	//ademas del id, tambien envio el name del input (ver ajaxfileupload.js)
				data:{name:'logan', id:'id'},
				success: function (data, status){
					if(typeof(data.error) != 'undefined'){
					$('#error').html("");
					$('#correcto').html("");
						if(data.error != ''){
								if (data.error == "Error1")
									$('#error').html("<img src='../imagenes/cross.png'> El tama&ntilde;o del archivo excede el m&aacute;ximo permitido por el servidor");
								else if(data.error  == "Error2")
									$('#error').html("<img src='../imagenes/cross.png'> Hubo un error al intentar comprobar el archivo, intente nuevamente");
								else if (data.error == "Error3")
									$('#error').html("<img src='../imagenes/cross.png'> No se puede comprobar el archivo por su extensi&oacute;n");
								LimpiarInputFile(id);
						}else{
							if (data.msg > tamanio){
								LimpiarInputFile(id);
								$("#"+id).css("color","red");
								$('#error').html("<img src='../imagenes/cross.png'> Tamanio m&aacute;ximo permitido excedido, adjunta un documento mas pequenio!");
							}
							else{
								$('#correcto').html("<img src='../imagenes/accept.png'> El tama&ntilde;o es permitido: "+data.msg+" bytes");
							}
						}
					}
				},
				error: function (data, status, e)
				{
					LimpiarInputFile(arch);
					$('#error').html("<img src='../imagenes/cross.png'> El tama&ntilde;o del archivo excede el m&aacute;ximo permitido por el servidor");
				}
			}
		)
	}
</script>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Slider</title>
</head>

<body>
<div class="grid flex">
<?php	
	include_once( "menuadmin.php" );
	include_once( "../Funciones/conexion_db.php" );
?>

<div class="col_12">
	<img id="loading" src="../imagenes/loading.gif" style="display:none;">
    <div id="error" class="error"><span></span></div>
	<div id="correcto" class="correcto"><span></span></div>
    <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
    <fieldset>
    <legend>Archivo de imagen</legend>
    <div class="col_12">
    	<input type="file" id="fileToUpload2" name="fileToUpload2" size="45" class="input" size="45" onChange="validar(this, 'jpg', 4096000);" accept=".jpg">
    </div>
    <div class="col_12">
    	<!--<button class="button" id="buttonUpload" onclick="return ajaxFileUpload();">Upload</button>-->
    </div>
    </fieldset>
    </form>
</div>
		
</div>
</body>

</html>