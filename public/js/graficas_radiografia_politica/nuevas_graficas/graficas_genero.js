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
    $.get('/api/genero-funcion-judicial/' + funcion_select, function(data_funciones_estado) {
        createGrafica(data_funciones_estado);
    })
}

function obtenerDataTodosFuncionEstado() {
    $.get('/api/genero-funcion-judicial-todos', function(data_funciones_estado) {
        createGrafica(data_funciones_estado);
    })
}

function createGrafica(data_funciones_estado) {
    totalfuncionarios(data_funciones_estado)
    if (data_funciones_estado.length == 0) {
        $('#chartdiv').hide();
        $('#div_registros').show(2000);
        $('#div_registros').html('<strong>No existen registros. Sigue consultando</strong>');
    } else {
        $('#div_registros').hide();
        $('#chartdiv').show();
        var generos_data = [];
        for (var i = 0; i < data_funciones_estado.length; i++) {
            if (data_funciones_estado[i].genero_persona == 0) {
                var genero_data = new Object();
                genero_data.genero = "Mujeres";
                genero_data.cantidad_genero = data_funciones_estado[i].cantidad_genero;
                generos_data.push(genero_data);
            } else {
                var genero_data = new Object();
                genero_data.genero = "Hombres";
                genero_data.cantidad_genero = data_funciones_estado[i].cantidad_genero;
                generos_data.push(genero_data);
            }
        }
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end
        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.PieChart);
        chart.data = generos_data;
        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "cantidad_genero";
        pieSeries.dataFields.category = "genero";
        // Let's cut a hole in our Pie chart the size of 30% the radius
        chart.innerRadius = am4core.percent(0);
        // Put a thick white border around each Slice
        pieSeries.slices.template.stroke = am4core.color("#fff");
        pieSeries.slices.template.strokeWidth = 2;
        pieSeries.slices.template.strokeOpacity = 1;
        pieSeries.slices.template;
        pieSeries.slices.template.tooltipText = "{genero}: [bold]{cantidad_genero}[/]";
        pieSeries.hiddenState.properties.opacity = 1;
        pieSeries.hiddenState.properties.endAngle = -90;
        pieSeries.hiddenState.properties.startAngle = -90;
        pieSeries.ticks.template.disabled = true;
        pieSeries.alignLabels = false;
        pieSeries.labels.template.text = "";
        pieSeries.slices.template.events.on("hit", function(ev) {
            var funcion_select = document.getElementById("select-funcion").value;
            var genero_consulta;
            if (ev.target.dataItem.dataContext.genero == 'Mujeres') {
                genero_consulta = 0
            } else {
                genero_consulta = 1
            }
            var categoria_select_consulta = document.getElementById("select-categoria").value;
            if (categoria_select_consulta == 'todos') {
                addPersonasTodos(ev.target.dataItem.dataContext.genero, genero_consulta)
            } else {
                addPersonasTable(funcion_select, genero_consulta, ev.target.dataItem.dataContext.genero)
            }
        }, this);
        // Create a base filter effect (as if it's not there) for the hover to return to
        var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
        shadow.opacity = 0;
        // Create hover state
        var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists
        // Slightly shift the shadow and make it more prominent on hover
        var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
        hoverShadow.opacity = 0.7;
        hoverShadow.blur = 5;
        // Add a legend
        chart.legend = new am4charts.Legend();
        chart.legend.valign = "middle";
        //chart.legend.labels.template.text = "{rango_sri} - {value.percent.formatNumber('#.0')}%[/]";
        chart.legend.labels.template.text = "[bold]{genero}";
        //series1.legendSettings.labelText = "Series: [bold]{rango_sri}[/]";
        var legendContainer = am4core.create("legenddiv-genero", am4core.Container);
        legendContainer.width = am4core.percent(100);
        legendContainer.height = am4core.percent(100);
        chart.legend.parent = legendContainer;
    }
}

function totalfuncionarios(data_funciones_estado) {
    var total_funcionarios = 0;
    for (var i = 0; i < data_funciones_estado.length; i++) {
        total_funcionarios = total_funcionarios + data_funciones_estado[i].cantidad_genero;
    }
    $('#total-funcionarios').html('<strong>' + total_funcionarios + '</strong>');
}

function addPersonasTable(funcion_estado, genero_consulta, genero_piechart) {
    $('#titulo-modal').html('<strong>Genero: ' + genero_piechart + '</strong>');
    var table = $('#table_id').DataTable();
    table.clear().draw();
    $.get('/api/detalle-genero-funcion-judicial/' + funcion_estado + "/" + genero_consulta, function(data) {
        for (var i = 0; i < data.length; i++) {
            table.row.add([
                data[i].nombres_persona,
                data[i].apellidos_persona,
                data[i].nombre_posicion
            ]).draw(false);
        }
        $('#modal1').modal('open');
    });
}

function addPersonasTodos(genero_piechart, genero_consulta) {
    $('#titulo-modal').html('<strong>Genero: ' + genero_piechart + '</strong>');
    var table = $('#table_id').DataTable();
    table.clear().draw();
    $.get('/api/todos-detalle-genero-funcion-judicial/' + genero_consulta, function(data) {
        for (var i = 0; i < data.length; i++) {
            table.row.add([
                data[i].nombres_persona,
                data[i].apellidos_persona,
                data[i].nombre_posicion
            ]).draw(false);
        }
        $('#modal1').modal('open');
    });
}