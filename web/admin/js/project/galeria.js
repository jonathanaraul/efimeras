jQuery('.home-galeria').click(function() {  

	var objeto= jQuery(this).parent().attr('objeto');
	var tarea = jQuery(this).attr('tarea');
	var tipo= jQuery(this).parent().attr('tipo');
	var data = 'objeto='+objeto+'&tarea='+tarea+'&tipo='+tipo;

	if(tarea==0){
        jQuery(this).attr('tarea',1);
        jQuery(this).parent().prev().find('.label-info').css('display','none');
	}
	else{
        jQuery(this).attr('tarea',0);
        jQuery(this).parent().prev().find('.label-info').css('display','');
	} 

	$.post(Routing.generate('project_back_set_home'), data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
	});

    return false;
  });

jQuery('.cambiar-estatus-galeria').click(function() {  

	var objeto= jQuery(this).parent().attr('objeto');
	var tipo= jQuery(this).parent().attr('tipo');
	var tarea = jQuery(this).attr('tarea');
	var data = 'objeto='+objeto+'&tipo='+tipo+'&tarea='+tarea;

	if(tarea==0){
        jQuery(this).attr('tarea',1);
        jQuery(this).parent().prev().find('.label-success').css('display','none');
        jQuery(this).parent().prev().find('.label-important').css('display','');
	}
	else{
        jQuery(this).attr('tarea',0);
        jQuery(this).parent().prev().find('.label-success').css('display','');
        jQuery(this).parent().prev().find('.label-important').css('display','none');
	} 

	$.post(Routing.generate('project_back_status'), data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
	});

    return false;
  });

jQuery('.borrar-galeria').click(function() {  

	var objeto= jQuery(this).parent().attr('objeto');
	var tipo= jQuery(this).parent().attr('tipo');
	var data = 'objeto='+objeto+'&tipo='+tipo;

    jQuery(this).parent().parent().remove();

	$.post(Routing.generate('project_back_delete'), data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
	});

    return false;
  });