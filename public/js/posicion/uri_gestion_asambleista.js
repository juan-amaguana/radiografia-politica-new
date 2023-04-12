
function getPosicion(){
  var posicion_id = $("#posicion-id").val();
  if (posicion_id==3) {
    $('#uri-gestion-asambleista').show();
    $("#url_legislativo").attr('required', 'true');
  }else{
    $('#uri-gestion-asambleista').hide();
    $("#url_legislativo").removeAttr('required');
  }
}