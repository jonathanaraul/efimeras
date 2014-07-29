jQuery('.ordenar').mouseup(function() {  

setTimeout (ordenaRank, 1000); 
			


	});

function ordenaRank(){
			var data= "cantidad="+jQuery('.ordenar').length;
		var posicion=0;
        
		$.each(jQuery('.ordenar'), function(indice, valor) {
		   var id = $(valor).attr('id');
		   var atributo = $(valor).attr('atributo');
		   data += '&elemento_' + indice + '=' + atributo;
	     });
		console.log(data);
	    $.post(direccionRank, data, function(respuesta) {
		   var respuesta = JSON.parse(respuesta);
	    });
}

jQuery('#menuItem_tipo').click(function() {  
	var tipo = jQuery(this).val();
	if(tipo==0){
	   $('#menuItem_category').val($("#menuItem_category option:first").val());
       $('#menuItem_category').prop('disabled', 'disabled');
       $('#menuItem_page').prop('disabled', false);
	}
	else if(tipo==1){
	   $('#menuItem_page').val($("#menuItem_page option:first").val());
       $('#menuItem_page').prop('disabled', 'disabled');
       $('#menuItem_category').prop('disabled', false);
	}
	else if(tipo==2){
	   $('#menuItem_category').val($("#menuItem_category option:first").val());
	   $('#menuItem_page').val($("#menuItem_page option:first").val());
       $('#menuItem_page').prop('disabled', 'disabled');
       $('#menuItem_category').prop('disabled', 'disabled');
	}	
    return false;
  });
jQuery('#ver-listado-items').click(function() {  
	var menu = jQuery('#listado-item-accion').val();
	document.location.href = Routing.generate('project_back_menu_item_list', { menu: menu });
    return false;
  });
jQuery('#crear-items').click(function() {  
	var menu = jQuery('#crear-item-accion').val();
	document.location.href = Routing.generate('project_back_menu_item_create', { menu: menu });
    return false;
  });
jQuery('#ordenar-items').click(function() {  
	var menu = jQuery('#ordenar-item-accion').val();
	document.location.href = Routing.generate('project_back_menu_item_rank', { menu: menu });
    return false;
  });
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
