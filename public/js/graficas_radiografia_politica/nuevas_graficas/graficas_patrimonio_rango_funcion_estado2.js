am4core.ready(function() {
    getSelectValueCategoria();
    calcularTotalMediaPratrimonio();
}); // end am4core.ready()
function getSelectValue() {
    var categoria_select = document.getElementById("select-categoria").value;
    var funcion_select = document.getElementById("select-funcion").value;
    if (categoria_select == 1 || categoria_select == 2) {
        obtenerDataFuncionEstado();
    }
    if (categoria_select == "todos") {
        //alert('entre');
        obtenerDataTodosFuncionEstado();
    }
}

function obtenerDataFuncionEstado() {
    var funcion_select = document.getElementById("select-funcion").value;
    $.get('/api/patrimonios-funcion-estado-rango-nuevo/' + funcion_select, function(data_funciones_estado) {
        createGrafica(data_funciones_estado);
    })
}

function obtenerDataTodosFuncionEstado() {
    $.get('/api/patrimonios-funcion-estado-todos-nuevo', function(data_funciones_estado) {
        createGrafica(data_funciones_estado);
    })
}

function createGrafica(data_patrimonio) {
    totalfuncionarios(data_patrimonio);
    am4core.useTheme(am4themes_material);
    am4core.useTheme(am4themes_animated);
    // Themes end
    // Create chart instance
    var chart = am4core.create("chartdiv", am4charts.PieChart);
    // Add data
    chart.data = data_patrimonio;
    // Set inner radius
    chart.innerRadius = am4core.percent(0);
    // Add and configure Series
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "total_personas";
    pieSeries.dataFields.category = "rango_patrimonio";
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
    pieSeries.ticks.template.disabled = true;
    pieSeries.alignLabels = false;
    pieSeries.labels.template.fill = am4core.color("#fff");
    pieSeries.labels.template.text = "{value.percent.formatNumber('#.0')}%";
    pieSeries.labels.template.radius = am4core.percent();
    pieSeries.slices.template.events.on("hit", function(ev) {
        var funcion_select = document.getElementById("select-funcion").value;
        var categoria_select_consulta = document.getElementById("select-categoria").value;
        if (categoria_select_consulta == 'todos') {
            addPersonasTodos(ev.target.dataItem.dataContext.rango_declaracion)
        } else {
            addPersonasTable(funcion_select, ev.target.dataItem.dataContext.rango_declaracion)
        }
        //alert(ev.target.dataItem.dataContext.rango_declaracion);
    }, this);
    pieSeries.labels.template.fill = am4core.color("white");
    chart.legend = new am4charts.Legend();
    chart.legend.valign = "middle";
    chart.legend.labels.template.text = "[bold]{rango_patrimonio}";
    var legendContainer = am4core.create("legenddiv-patrimonio", am4core.Container);
    legendContainer.width = am4core.percent(100);
    legendContainer.height = am4core.percent(100);
    chart.legend.parent = legendContainer;
}

function totalfuncionarios(data_patrimonios) {
    var total_funcionarios = 0;
    for (var i = 0; i < data_patrimonios.length; i++) {
        total_funcionarios = total_funcionarios + data_patrimonios[i].total_personas;
    }
    $('#total-funcionarios').html('<strong>' + total_funcionarios + '</strong>');
}

function addPersonasTable(funcion_estado, rango_declaracion) {
    $('#titulo-modal').html('<strong>Rango de declaración: ' + rango_declaracion + '</strong>');
    var table = $('#table_id').DataTable();
    table.clear().draw();
    $.get('/api/patrimonios-funcion-estado-rango/' + funcion_estado + "/" + rango_declaracion, function(data) {
        for (var i = 0; i < data.length; i++) {
            table.row.add([
                data[i].nombres_persona,
                data[i].apellidos_persona,
                data[i].cargo,
                data[i].patrimonio
            ]).draw(false);
        }
        $('#modal1').modal('open');
    });
}

function addPersonasTodos(rango_declaracion) {
    $('#titulo-modal').html('<strong>Rango de declaración: ' + rango_declaracion + '</strong>');
    var table = $('#table_id').DataTable();
    table.clear().draw();
    $.get('/api/patrimonios-funcion-estado-rango-todos/' + rango_declaracion, function(data) {
        for (var i = 0; i < data.length; i++) {
            table.row.add([
                data[i].nombres_persona,
                data[i].apellidos_persona,
                data[i].cargo,
                data[i].patrimonio
            ]).draw(false);
        }
        $('#modal1').modal('open');
    });
}

function calcularTotalMediaPratrimonio() {
    $.get('/api/patrimonios-funcion-estado-todos-nuevo', function(data) {
        var total_patrimonio = 0;
        var total_personas = 0;
        for (var i = 0; i < data.length; i++) {
            total_patrimonio = total_patrimonio + parseFloat(data[i].total_declaracion);
            total_personas = total_personas + data[i].total_personas;
        }
        var media_patrimonio = total_patrimonio / total_personas;
        $('#patrimonio-total').html('<strong>$' + new Intl.NumberFormat().format(total_patrimonio) + '</strong>');
        $('#patrimonio-media').html('<strong>$' + new Intl.NumberFormat().format(media_patrimonio.toFixed(2)) + '</strong>');
    })
}