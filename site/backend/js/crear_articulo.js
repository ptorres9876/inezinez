// JavaScript Document
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
								$('#error').html("<img src='../imagenes/cross.png'> El tama&ntilde;o del archivo excede el máximo permitido por el servidor");
							else if(data.error  == "Error2")
								$('#error').html("<img src='../imagenes/cross.png'> Hubo un error al intentar comprobar el archivo, intente nuevamente");
							else if (data.error == "Error3")
								$('#error').html("<img src='../imagenes/cross.png'> No se puede comprobar el archivo por su extensión");
							LimpiarInputFile(id);
					}else{
						if (data.msg > tamanio){
							LimpiarInputFile(id);
							$("#"+id).css("color","red");
							$('#error').html("<img src='../imagenes/cross.png'> Tama&ntilde;o m&aacute;ximo permitido excedido, adjunta un documento más peque&ntilde;o!");
						}
						else{
							//$('#correcto').html("<img src='../imagenes/accept.png'> El tama&ntilde;o es permitido: "+data.msg+" bytes");
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

$(document).ready(function(e) {
   
   $("#url_videoD").hide();
   $("#opcion_img_galeria").hide();
   $("#opcion_img_slide").hide();
   
   //Al momento del submit
   $("#form1").submit(function(e) {
   		var titulo_txt 		= $("#titulo").val();
		var contenido_txt	= $("#contenido").val();
		var img_fija_op		= $("#img_fija").is(":checked");
		var img_galeria_op	= $("#img_galeria").is(":checked");
		var img_slide_op	= $("#img_slide").is(":checked");;
		
		//Si titulo esta vacio
		if( titulo_txt == "" ){
			console.log("titulo vacio");
			$("#error_titulo_msj").show();
			$("#error_titulo_msj").addClass("notice error");
			$("#error_titulo_msj").html("<i class='icon-remove-sign icon-small'></i>Ingresa un titulo para el articulo por favor.");
			$("#titulo").focus();
			$("#error_titulo_msj").fadeOut(3000);
			return false;
		}
		
		//Si contenido esta vacio
		if( contenido_txt == "" ){
			console.log("contenido vacio");
			$("#error_contenido_msj").show();
			$("#error_contenido_msj").addClass("notice error");
			$("#error_contenido_msj").html("<i class='icon-remove-sign icon-small'></i>Ingresa el contenido para el articulo por favor.");
			$("#contenido").focus();
			$("#error_contenido_msj").fadeOut(3000);
			return false;
		}
		
		//Para la validacion de la seleccion de imagenes
		if( img_fija_op ){
			var imagen_fija_input = $("#subir_imagen_fija").val();
			
			if( imagen_fija_input == "" ){
				console.log("file input imagen fija vacio");
				$("#error_input_img_fija").show();
				$("#error_input_img_fija").addClass("notice error");
				$("#error_input_img_fija").html("<i class='icon-remove-sign icon-small'></i>Selecciona una imagen por favor.");
				$("#subir_imagen_fija").focus();
				$("#error_input_img_fija").fadeOut(3000);
				return false;
			}
			
		}
		else if( img_galeria_op ){			
			var numImgGal = $("#num_imgs_galeria").val();
			for( var i = 0; i < numImgGal; i++ ){
				if( $("#load_img_galeria"+i).val() == ""){
					$("#error_input_img_galeria").show();
					$("#error_input_img_galeria").addClass("notice error");
					$("#error_input_img_galeria").html("<i class='icon-remove-sign icon-small'></i>Selecciona una imagen por favor.");
					$("#load_img_galeria"+i).focus();
					$("#error_input_img_galeria").fadeOut(3000);
					console.log( "campo vacio en:_ " + i );
					return false;
				}	
			}
		}
		else if( img_slide_op ){
			var numImgSlide = $("#num_imgs_slide").val();
			for( var i = 0; i < numImgSlide; i++ ){
				if( $("#load_img_slide"+i).val() == "" ){
					$("#error_input_img_slide").show();
					$("#error_input_img_slide").addClass("notice error");
					$("#error_input_img_slide").html("<i class='icon-remove-sign icon-small'></i>Selecciona una imagen por favor.");
					$("#load_img_slide"+i).focus();
					$("#error_input_img_slide").fadeOut(3000);
					console.log( "campo vacio en:_ " + i );
					return false;
				}
			}
		}
		
		//si url de video esta vacio
		var urlChkd = $("#url_video").is(":checked");
		var urlVideo_chk = $("#url_video_input").val();
		
		if( urlChkd ){
			if( urlVideo_chk == "" ){
				console.log( "url video vacio." );
				$("#error_urlvideo_msj").show();
				$("#error_urlvideo_msj").addClass("notice error");
				$("#error_urlvideo_msj").html("<i class='icon-remove-sign icon-small'></i>Ingresa una URL de video valida por favor.");
				$("#url_video_input").focus();
				$("#error_urlvideo_msj").fadeOut(3000);
				return false;
			}
		}
   });
   
   //Para la seccion de imagenes
   $("#img_fija").change(function(e) {
	    $("#subir_imagen_fija").val("");
		$("#opcion_img_fija").show("fast");
		$("#opcion_img_galeria").hide("slow");
		$("#opcion_img_slide").hide("slow");
   });
   
   $("#img_galeria").change(function(e) {
	   $("#opcion_img_galeria").show("fast");
	   $("#opcion_img_fija").hide("slow");
	   $("#opcion_img_slide").hide("slow");
	   
	   var tabla_galeria = "";
	   $("#num_imgs_galeria").val(1);
	   tabla_galeria += "<tr><td><input type='file' name='load_img_galeria0' id='load_img_galeria0' accept='.jpg*' onChange='validar(this, \"jpg\", 4096000);'></td></tr>";
	   
	   $("#tabla_imagenes_galeria").empty();
	   $("#tabla_imagenes_galeria").append( tabla_galeria );
	   
   });
   
   $("#img_slide").change(function(e) {
	   $("#opcion_img_slide").show("fast");
	   $("#opcion_img_fija").hide("slow");
	   $("#opcion_img_galeria").hide("slow");
	   
	   var tabla_slide = "";
	   $("#num_imgs_slide").val(1);
	   tabla_slide += "<tr><td><input type='file' name='load_img_slide0' id='load_img_slide0' accept='.jpg*' onChange='validar(this, \"jpg\", 4096000);'></td></tr>";
	   
	   $("#tabla_imagenes_slide").empty();
	   $("#tabla_imagenes_slide").append( tabla_slide );
   });
   
   $("#num_imgs_galeria").change(function(e) {
	   var imgGal = $("#num_imgs_galeria").val();
	   var tabla_galeria = "";
	   
	   for( var i = 0 ; i < imgGal; i++){
		   tabla_galeria += "<tr><td><input type='file' name='load_img_galeria"+i+"' id='load_img_galeria"+i+"' accept='.jpg*' onChange='validar(this, \"jpg\", 4096000);'></td></tr>";
	   }
	   
	   $("#tabla_imagenes_galeria").empty();
	   $("#tabla_imagenes_galeria").append( tabla_galeria );
	   
	   console.log( imgGal );
   });
   
   $("#num_imgs_slide").change(function(e) {
	   var imgSlide = $("#num_imgs_slide").val();
	   var tabla_slide = "";
	   
	   console.log( imgSlide );
	   for( var i = 0; i < imgSlide; i++ ){
		   tabla_slide += "<tr><td><input type='file' name='load_img_slide"+i+"' id='load_img_slide"+i+"' accept='.jpg*' onChange='validar(this, \"jpg\", 4096000);'></td></tr>";
	   }
	   
	   $("#tabla_imagenes_slide").empty();
	   $("#tabla_imagenes_slide").append( tabla_slide );
	   
   });
   
   //Para la seccion de video
   $("#no_video").change(function(e) {
	   $("#url_videoD").hide("slow");
	   $("#url_video_input").val("");
   });
   
   $("#url_video").change(function(e) {
	   $("#url_videoD").show("fast");
   });
   
});