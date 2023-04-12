//alert('hola')
$( document ).ready(function() {
    var valor_posicion_actual = $('input:radio[name=posicion_actual]:checked').val();
    //alert(valor_posicion_actual);
    if (valor_posicion_actual == 1) {
      posicionActual();
    }else{
      posicionNoActual();
    }
});



