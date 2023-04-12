



function getTipoActividad(){
  var tipo_actividad = $("#select-actividad").val();
  switch(tipo_actividad) {
    case "todos":
    $('#detalle-actividades-todos').show();
    $('#detalle-actividad-sector').hide();
    break;
    case 'actividades categorisada':
    $('#detalle-actividades-todos').hide();
    $('#detalle-actividad-sector').show();
    
    break;
    
    default:
    
  }

}

