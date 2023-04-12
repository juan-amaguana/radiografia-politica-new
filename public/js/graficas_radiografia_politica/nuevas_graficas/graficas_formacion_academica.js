am4core.ready(function() {
    getSelectValueCategoria();
    //obtenerDataFuncionEstado();
}); // end am4core.ready()
function getSelectValue() {
    var categoria_select = document.getElementById("select-categoria").value;
    var funcion_select = document.getElementById("select-funcion").value;
    if (categoria_select == 1 || categoria_select == 2) {
        obtenerDataFuncionEstado();
    }
}

function obtenerDataFuncionEstado() {
    var funcion_select = document.getElementById("select-funcion").value;
    $.get('/api/formacion-academica/' + funcion_select, function(data_funciones_estado) {
        createGrafica(data_funciones_estado);
    })
}

function obtenerDataTodosFuncionEstado() {
    $.get('/api/formacion-academica-todos', function(data_funciones_estado) {
        createGrafica(data_funciones_estado);
    })
}

function createGrafica(data_formacion_academica) {
    totalfuncionarios(data_formacion_academica)
    var verificador = false;
    for (var i = 0; i < data_formacion_academica.length; i++) {
        if (data_formacion_academica[i].personas > 0) {
            verificador = true;
        }
    }
    if (data_formacion_academica.length == 0 || verificador == false) {
        $('#chartdiv').hide();
        $('#div_registros').show(2000);
        $('#div_registros').html('<strong>No existen registros. Sigue consultando</strong>');
    } else {
        $('#div_registros').hide();
        $('#chartdiv').show();
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end
        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.PieChart);
        chart.responsive.enabled = true;
        // Add data
        chart.data = data_formacion_academica;
        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "personas";
        pieSeries.dataFields.category = "formacion_academica";
        pieSeries.slices.template.stroke = am4core.color("#fff");
        pieSeries.slices.template.strokeWidth = 2;
        pieSeries.slices.template.strokeOpacity = 1;
        // This creates initial animation
        pieSeries.hiddenState.properties.opacity = 1;
        pieSeries.hiddenState.properties.endAngle = -90;
        pieSeries.hiddenState.properties.startAngle = -90;
        pieSeries.ticks.template.disabled = true;
        pieSeries.alignLabels = false;
        pieSeries.labels.template.text = "";
        pieSeries.slices.template.events.on("hit", function(ev) {
            var funcion_select = document.getElementById("select-funcion").value;
            var categoria_select_consulta = document.getElementById("select-categoria").value;
            if (categoria_select_consulta == 'todos') {
                addPersonasTodos(ev.target.dataItem.dataContext.formacion_academica)
            } else {
                addPersonasTable(funcion_select, ev.target.dataItem.dataContext.formacion_academica)
            }
        }, this);
        chart.legend = new am4charts.Legend();
        chart.legend.valign = "middle";
        //chart.legend.labels.template.text = "{rango_sri} - {value.percent.formatNumber('#.0')}%[/]";
        chart.legend.labels.template.text = "[bold]{formacion_academica}";
        //series1.legendSettings.labelText = "Series: [bold]{rango_sri}[/]";
        var legendContainer = am4core.create("legenddiv-estudio", am4core.Container);
        legendContainer.width = am4core.percent(100);
        legendContainer.height = am4core.percent(100);
        chart.legend.parent = legendContainer;
    }
}

function totalfuncionarios(data_formacion_academica) {
    var total_funcionarios = 0;
    for (var i = 0; i < data_formacion_academica.length; i++) {
        total_funcionarios = total_funcionarios + data_formacion_academica[i].personas;
    }
    $('#total-funcionarios').html('<strong>' + total_funcionarios + '</strong>');
}

function addPersonasTable(funcion_estado, tipo_titulo) {
    $('#titulo-modal').html('<strong>Nivel de estudios: ' + tipo_titulo + '</strong>');
    var table = $('#table_id').DataTable();
    table.clear().draw();
    $.get('/api/detalle-profesiones-personas-area/' + funcion_estado + "/" + tipo_titulo, function(data) {
        for (var i = 0; i < data.length; i++) {
            table.row.add([
                data[i].nombres_persona,
                data[i].apellidos_persona,
                data[i].profesion_estudio
            ]).draw(false);
        }
        $('#modal1').modal('open');
    });
}

function addPersonasTodos(tipo_titulo) {
    $('#titulo-modal').html('<strong>Nivel de estudios: ' + tipo_titulo + '</strong>');
    var table = $('#table_id').DataTable();
    table.clear().draw();
    $.get('/api/detallel-profesiones-personas-area-todos/' + tipo_titulo, function(data) {
        for (var i = 0; i < data.length; i++) {
            table.row.add([
                data[i].nombres_persona,
                data[i].apellidos_persona,
                data[i].profesion_estudio
            ]).draw(false);
        }
        $('#modal1').modal('open');
    });
}
