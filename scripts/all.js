$(function() {
	$("#tabs-icons").tabs();
});

jQuery(function ($) {
	//form submit handler
	$('#formulario1').submit(function (e) {
		//check atleat 1 checkbox is checked
		if (!$('.gm').is(':checked')) {
			//prevent the default form submit if it is not checked
			e.preventDefault();
			alert("Selecione seu Grupo e Modalidade Tarifária");
		}
	})
})
if(document.getElementById("desconto").checked) {
	document.getElementById('descontohidden').disabled = true;
}