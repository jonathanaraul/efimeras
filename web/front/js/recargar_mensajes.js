$('#botonNewsletter_submit').live("click", function() {
	var prueba = true;
	var data = '';
	$.each($(".botonNewsletter_campo"), function(indice, valor) {

		var auxiliar = $(valor).val();
		var id =  $(valor).attr('id');
		id = id.split("_");
		id = id[1];
		if(indice !=0)data += '&';
		data += id+'='+auxiliar;
	
		if($.trim(auxiliar)==''){
			$(valor).css('border','1px solid red');
			prueba = false;
		}
		else $(valor).css('border','none');
	});
	if(!validateEmail($('#botonNewsletter_email').val())){
        $('#botonNewsletter_email').css('border','1px solid red');
		prueba = false;
	}
	if(!prueba) return false;


	$('.botonNewsletter_elemento').css('display','none');
	$('#botonNewsletter_loader').css('display','block');

	$.post(direccionBotonesNewsletter, data, function(data) {
		var obj = JSON.parse(data);
	    $('#contenidoBotonNewsletter').html('<br><h2>'+obj.respuesta+'</h2>');
	});

	return false;
});