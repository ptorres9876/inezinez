/* Plugin obtenido de: http://www.phpletter.com/Our-Projects/AjaxFileUpload/
	created by yvind Saltvik y modificado por EH el 08/11/2011
*/
jQuery.extend({
    createUploadIframe: function(id, uri){
			//create frame
            var frameId = 'jUploadFrame' + id;
            var iframeHtml = '<iframe id="' + frameId + '" name="' + frameId + '" style="display:none;"';
			if(window.ActiveXObject){
                if(typeof uri== 'boolean'){
					iframeHtml += ' src="' + 'javascript:false' + '"';
                }
                else if(typeof uri== 'string'){
					iframeHtml += ' src="' + uri + '"';
                }	
			}
			iframeHtml += ' />';
			jQuery(iframeHtml).appendTo(document.body);
            return jQuery('#' + frameId).get(0);			
    },
    createUploadForm: function(id, fileElementId, data)
	{
		//create form	
		var formId = 'jUploadForm' + id;
		var fileId = 'jUploadFile' + id;
		var form = jQuery('<form  action="" method="POST" name="' + formId + '" id="' + formId + '" enctype="multipart/form-data"></form>');	
		if(data)
		{
			for(var i in data)
			{
				jQuery('<input type="hidden" name="' + i + '" value="' + data[i] + '" />').appendTo(form);
			}			
		}		
		var oldElement = jQuery('#' + fileElementId);	//Input original
		var newElement = jQuery(oldElement).clone();	//Se clona el input (solo los atributos del mismo)
		jQuery(newElement).css('display','none');		//Hacemos el input copia oculto
		jQuery(oldElement).attr('id', fileId);			//aqui le esta cambiando el id al input
		jQuery(oldElement).attr('name', 'fileToUpload');		//aqui le esta cambiando el name al input, a uno usable por el plugin
		jQuery(oldElement).before(newElement);			//se agrega un nuevo input
		jQuery(oldElement).appendTo(form); 				//se pasa el input original al form donde se enviaran el arch
		//set attributes
		jQuery(form).css('display','none');				//Hacemos el form copia oculto
		jQuery(form).appendTo('body');					//y lo agregamos al body de la pagina
		return form;
    },

    ajaxFileUpload: function(s) {
        // TODO introduce global settings, allowing the client to modify them for all requests, not only timeout		
        s = jQuery.extend({}, jQuery.ajaxSettings, s);
		var nameO = s.fileElementName;	//Este es el nombre original del input
        var id = new Date().getTime()   //Genera un numero aleatorio para el form , el frame y el input auxiliar
		var form = jQuery.createUploadForm(id, s.fileElementId, (typeof(s.data)=='undefined'?false:s.data));
		var io = jQuery.createUploadIframe(id, s.secureuri);
		var frameId = 'jUploadFrame' + id;
		var formId = 'jUploadForm' + id;		
        // Watch for a new set of requests
        if ( s.global && ! jQuery.active++ )
		{
			jQuery.event.trigger( "ajaxStart" );
		}
        var requestDone = false;
        // Create the request object
        var xml = {}   
        if ( s.global )
            jQuery.event.trigger("ajaxSend", [xml, s]);
        // Wait for a response to come back
        var uploadCallback = function(isTimeout)
		{			
			var io = document.getElementById(frameId);
            try 
			{
				if(io.contentWindow)
				{
					 xml.responseText = io.contentWindow.document.body?io.contentWindow.document.body.innerHTML:null;
                	 xml.responseXML = io.contentWindow.document.XMLDocument?io.contentWindow.document.XMLDocument:io.contentWindow.document;
					 
				}else if(io.contentDocument)
				{
					xml.responseText = io.contentDocument.document.body?io.contentDocument.document.body.innerHTML:null;
                	xml.responseXML = io.contentDocument.document.XMLDocument?io.contentDocument.document.XMLDocument:io.contentDocument.document;
				}						
            }catch(e)
			{
				jQuery.handleError(s, xml, null, e);
			}
            if ( xml || isTimeout == "timeout") 
			{				
                requestDone = true;
                var status;
                try {
                    status = isTimeout != "timeout" ? "success" : "error";
                    // Make sure that the request was successful or notmodified
                    if ( status != "error" )
					{
                        // process the data (runs the xml through httpData regardless of callback)
                        var data = jQuery.uploadHttpData( xml, s.dataType );    
                        // If a local callback was specified, fire it and pass it the data
                        if ( s.success )
                            s.success( data, status );
    
                        // Fire the global callback
                        if( s.global )
                            jQuery.event.trigger( "ajaxSuccess", [xml, s] );
                    } else
                        jQuery.handleError(s, xml, status);
                } catch(e) 
				{
                    status = "error";
                    jQuery.handleError(s, xml, status, e);
                }

                // The request was completed
                if( s.global )
                    jQuery.event.trigger( "ajaxComplete", [xml, s] );

                // Handle the global AJAX counter
                if ( s.global && ! --jQuery.active )
                    jQuery.event.trigger( "ajaxStop" );

                // Process result
                if ( s.complete )
                    s.complete(xml, status);

                jQuery(io).unbind()

                setTimeout(function()
									{	try 
										{
											jQuery(io).remove();
											jQuery(form).remove();
											
										} catch(e) 
										{
											jQuery.handleError(s, xml, null, e);
										}									

									}, 100)

                xml = null
            }
        }
        // Timeout checker
        if ( s.timeout > 0 ) 
		{
            setTimeout(function(){
                // Check to see if the request is still happening
                if( !requestDone ) uploadCallback( "timeout" );
            }, s.timeout);
        }
        try 
		{

		var form = jQuery('#' + formId);
			jQuery(form).attr('action', s.url);
			jQuery(form).attr('method', 'POST');
			jQuery(form).attr('target', frameId);
            if(form.encoding)
			{
				jQuery(form).attr('encoding', 'multipart/form-data');      			
            }
            else
			{	
				jQuery(form).attr('enctype', 'multipart/form-data');			
            }			
            jQuery(form).submit();
			
        } catch(e) 
		{			
            jQuery.handleError(s, xml, null, e);
        }
		
		jQuery('#' + frameId).load(uploadCallback	);
       // return {abort: function () {}};
	   
		/*Modificaciones realizadas aqui por EH: 
		* Se reestablece el input original en su lugar
		* de manera que podamos usar sus datos para su posterior envio.
		* El plugin original no lo hacia
		*/
		original = jQuery('#jUploadFile'+id);	//Obtenemos el id del input auxiliar
		copia = jQuery('#'+s.fileElementId);	//Obtenemos el id del input copia
		jQuery(copia).before(original);			//Insertamos el input auxiliar despues del copia
		jQuery(copia).remove();					//removemos la copia
		jQuery(original).attr('id', s.fileElementId);	//cambiamos el id del input auxiliar
		jQuery(original).attr('name', nameO);			//cambiamos el nombre del input al original
		//y ya esta el input original en su lugar!
    },

    uploadHttpData: function( r, type ) {
        var data = !type;
        data = type == "xml" || data ? r.responseXML : r.responseText;
        // If the type is "script", eval it in global context
        if ( type == "script" )
            jQuery.globalEval( data );
        // Get the JavaScript object, if JSON is used.
        if ( type == "json" )
            eval( "data = " + data );
        // evaluate scripts within html
        if ( type == "html" )
            jQuery("<div>").html(data).evalScripts();

        return data;
    }
})

