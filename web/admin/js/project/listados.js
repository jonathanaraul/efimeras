jQuery('.ordenar').mouseup(function() {  
	setTimeout (ordenaRank, 1000); 		
});

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

jQuery('.cambiar-estatus-listado').click(function() {  

	var tarea = jQuery(this).attr('tarea');
	var objeto= jQuery(this).parent().attr('objeto');
	var tipo= jQuery(this).parent().attr('tipo');

	var data = 'objeto='+objeto+'&tarea='+tarea+'&tipo='+tipo;

	if(tarea==0){
		jQuery(this).attr('tarea',1);
		jQuery('#publicado_'+objeto).css('display','none');
		jQuery('#despublicado_'+objeto).css('display','');
	}
	else{
		jQuery(this).attr('tarea',0);
		jQuery('#publicado_'+objeto).css('display','');
		jQuery('#despublicado_'+objeto).css('display','none')
	} 

	$.post(Routing.generate('project_back_status'), data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
	});

	return false;
});

jQuery('.borrar-listado').click(function() {  

	var objeto= jQuery(this).parent().attr('objeto');
	var tipo= jQuery(this).parent().attr('tipo');

	var data = 'objeto='+objeto+'&tipo='+tipo;

	$.post(Routing.generate('project_back_delete'), data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		console.log('el estado es '+respuesta.estado);
		if(respuesta.estado){
	        jQuery('#fila_'+objeto).remove();
		}
		else{
		    $.gritter.add({
						title: 'Eliminación fallida',
						text: 'No se puedo borrar el objeto deseado porque tiene elementos asociados, por favor intente borrar estos elementos antes de realizar esta acción.',
						class_name: 'gritter-error'
					});
		}
	});

	return false;
});

function ordenaRank(){
	var data= "cantidad="+jQuery('.ordenar').length;
	var posicion=0;

	$.each(jQuery('.ordenar'), function(indice, valor) {
		var id = $(valor).attr('id');
		var atributo = $(valor).attr('atributo');
		data += '&elemento_' + indice + '=' + atributo;º
	});
	console.log(data);
	$.post(direccionRank, data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
	});
}

jQuery('#page_principal').click(function() {  
	var tipo = jQuery(this).val();
	
	if(tipo==0){
		//$('#menuItem_page').val($("#menuItem_page option:first").val());
		$('#page_name').prop('readOnly', false);
		$('#page_upperText').prop('readOnly', false);
		$('#page_name').val('');
		$('#page_upperText').val('');
	}

	else if(tipo==1){
		//$('#menuItem_category').val($("#menuItem_category option:first").val());
		$('#page_name').prop('readOnly', true);
		$('#page_upperText').prop('readOnly', true);
		$('#page_name').val('MASTER');
		$('#page_upperText').val('MASTER');
	}
	return false;
});

jQuery('#page_optionYoutube').click(function() {  
	if($("#page_optionYoutube").is(':checked')) 
	{  
        $('#page_linkYoutube').prop('readOnly', false);
    } 
    else 
    {  
        $('#page_linkYoutube').prop('readOnly', true);
        $('#page_linkYoutube').val(''); 
    }
});
