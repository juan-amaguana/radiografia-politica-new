$( document ).ready(function() {
    var valor_tipo_funcion = $('input:radio[name=categoria_posicion_funcion]:checked').val();
    if (valor_tipo_funcion != 3) {
      if (valor_tipo_funcion==1) {
        var valores_tipo_funcion = JSON.parse($("#edit-value-Funcion-estado").val())
        var valor_categoria_posicion = $("#edit-categoria-posicion").val()
        editFuncionesEstado(valores_tipo_funcion.id, valor_categoria_posicion);
      }else{
        editarInstitucionesIndependientes();
      }
    }else{
      editarNinguno();
    }
});

function editFuncionesEstado(valor_select_function_estado,valor_categoria_posicion){
  $("#funcion_estado_id").val(valor_select_function_estado);
  $("#categoria_id").val(valor_categoria_posicion);
  $( "#funciones-estado" ).show();
  $( "#instituciones-independientes" ).hide();

  $("#institucion_independiente_id").removeAttr('required');
  $("#funcion_estado_id").attr('required', 'true');
  $("#categoria_id").attr('required', 'true');
}


function editarInstitucionesIndependientes(){
  $( "#funciones-estado" ).hide();
  $( "#instituciones-independientes" ).show();
  $("#institucion_independiente_id").attr('required', 'true');
  $("#funcion_estado_id").removeAttr('required');
  $("#categoria_id").removeAttr('required');
}

function editarNinguno(){
  $( "#funciones-estado" ).hide();
  $( "#instituciones-independientes" ).hide();
  $("#institucion_independiente_id").removeAttr('required');
  $("#funcion_estado_id").removeAttr('required');
  $("#categoria_id").removeAttr('required');
}