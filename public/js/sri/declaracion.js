function tieneDeclaracio() {
    $('#valores-impuesto').show();
    $("#anio_sri").attr('required', 'true');
    $("#valor_impuesto_sri").attr('required', 'true');
}

function noTieneDeclaracio() {
    $('#valores-impuesto').hide();
    $("#anio_sri").removeAttr('required');
    $("#valor_impuesto_sri").removeAttr('required');
}