
function posicionNoActual(){
	$('#fecha-fin-actividad').show();
    $("#datepicker1").attr('required', 'true');
}

function posicionActual(){
	console.log('cierre');
	$('#fecha-fin-actividad').hide();
	$("#datepicker1").removeAttr('required');
}
