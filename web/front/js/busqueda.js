
$('#buscarTermino').live("click", function() {

	var valor = $('#termino').val();
	valor = jQuery.trim(valor).toLowerCase();
	document.location.href = direccionBuscar + '/' + valor;

	return false;
});