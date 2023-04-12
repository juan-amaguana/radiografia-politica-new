//alert('hola')
$(document).ready(function() {
    var valor_posicion_actual = $('input:radio[name=declaracion]:checked').val();
    //alert(valor_posicion_actual);
    if (valor_posicion_actual == 2) {
        tieneDeclaracio();
    } else {
        noTieneDeclaracio();
    }
});