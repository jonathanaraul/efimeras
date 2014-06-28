jQuery('.cambiar-estatus').click(function() {  

	var id= jQuery(this).attr('objeto');
	var tarea = jQuery(this).attr('tarea');

	var data = 'id='+id+'&tarea='+tarea;

	if(tarea==0){
        jQuery(this).attr('tarea',1);
        jQuery('#publicado_'+id).css('display','none');
        jQuery('#despublicado_'+id).css('display','');
	}
	else{
        jQuery(this).attr('tarea',0);
        jQuery('#publicado_'+id).css('display','');
        jQuery('#despublicado_'+id).css('display','none');

	} 

	$.post(direccionEstatus, data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);

		/*$("#loader-widget-" + color).css('display', 'none');
		$("#elementos-" + tipo + "-" + color).append(respuesta.htmlElementos);
		$(".paginacion-" + color).append(respuesta.htmlPaginacion);*/
	});

    return false;
  });

jQuery('.borrar').click(function() {  

	var id= jQuery(this).attr('objeto');
	var data = 'id='+id;

    jQuery('#fila_'+id).remove();

	$.post(direccionBorrar, data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);

		/*$("#loader-widget-" + color).css('display', 'none');
		$("#elementos-" + tipo + "-" + color).append(respuesta.htmlElementos);
		$(".paginacion-" + color).append(respuesta.htmlPaginacion);*/
	});

    return false;
  });

jQuery('.editar').click(function() {  

	var id= jQuery(this).attr('objeto');
	document.location.href = direccionEditar + '/' + id;

    return false;
  });
