
function mostrarSeccionesFuncionario(){
	
  $( "#secciones-funcionarios" ).show();
  $("#seccion_funcionario").attr('required', 'true');
}




function ocultarSeccionesFuncionario(){
  $("#secciones-funcionarios" ).hide();
  $("#seccion_funcionario").removeAttr('required');
}