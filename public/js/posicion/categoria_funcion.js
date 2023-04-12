


function mostrarFuncionesEstado(){
	
  $( "#funciones-estado" ).show();
  $( "#instituciones-independientes" ).hide();

  $("#institucion_independiente_id").removeAttr('required');
  $("#funcion_estado_id").attr('required', 'true');
  $("#categoria_id").attr('required', 'true');
}


function mostrarInstitucionesIndependientes(){
  $( "#funciones-estado" ).hide();
  $( "#instituciones-independientes" ).show();
  $("#institucion_independiente_id").attr('required', 'true');
  $("#funcion_estado_id").removeAttr('required');
  $("#categoria_id").removeAttr('required');
}

function ocultarTodo(){
  $( "#funciones-estado" ).hide();
  $( "#instituciones-independientes" ).hide();
  $("#institucion_independiente_id").removeAttr('required');
  $("#funcion_estado_id").removeAttr('required');
  $("#categoria_id").removeAttr('required');
}