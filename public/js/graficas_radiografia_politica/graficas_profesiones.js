am4core.ready(function() {
    cargarComboFuncionEstadoNoAsincrona();
    obtenerDataFuncionEstado();
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
    $.get('/api/profesiones/' + funcion_select, function(data_funciones_estado) {
        createGrafica(data_funciones_estado);
    })
}

function obtenerDataTodosFuncionEstado() {
    createTablaTodos();
}

function createGrafica(data_profesion) {
    if (data_profesion.length == 0) {
        $('#chartdiv').hide();
        $('#data_table').hide();
        $('#div_registros').show(2000);
        $('#div_registros').html('<strong>No existen registros. Sigue consultando</strong>');
    } else {
        $('#div_registros').hide();
        $('#data_table').hide();
        $('#chartdiv').show();
        var funcion_select = document.getElementById("select-funcion").value;
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end
        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart3D);
        //chart.responsive.enabled = true;
        chart.scrollbarX = new am4core.Scrollbar();
        chart.scrollbarX.parent = chart.topAxesContainer;
        var data_profesiones = [];
        for (var i = 0; i < data_profesion.length; i++) {
            var nombre_profesion
            if (data_profesion[i].profesion_estudio.length > 20) {
                nombre_profesion = data_profesion[i].profesion_estudio.substring(0, 30) + "..."
            } else {
                nombre_profesion = data_profesion[i].profesion_estudio
            }
            var profesion_data = {
                "profesion": nombre_profesion,
                "nombre_profesion": data_profesion[i].profesion_estudio,
                "cantidad": parseInt(data_profesion[i].total),
                "color": chart.colors.next()
            }
            //console.log (profesion_data);
            data_profesiones.push(profesion_data)
        }
        // Add data
        chart.data = data_profesiones;
        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "profesion";
        categoryAxis.renderer.labels.template.rotation = 270;
        categoryAxis.renderer.labels.template.hideOversized = false;
        categoryAxis.renderer.minGridDistance = 20;
        categoryAxis.renderer.labels.template.horizontalCenter = "right";
        categoryAxis.renderer.labels.template.verticalCenter = "middle";
        categoryAxis.tooltip.label.rotation = 270;
        categoryAxis.tooltip.label.horizontalCenter = "right";
        categoryAxis.tooltip.label.verticalCenter = "middle";
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "Profesiones";
        valueAxis.title.fontWeight = "bold";
        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries3D());
        series.dataFields.valueY = "cantidad";
        series.dataFields.categoryX = "profesion";
        series.name = "Visits";
        series.tooltipText = "{nombre_profesion}: [bold]{valueY}[/]";
        series.columns.template.fillOpacity = .8;
        series.columns.template.propertyFields.fill = "color";
        var columnTemplate = series.columns.template;
        series.columns.template.events.on("hit", function(ev) {
            $('#titulo-modal').html('<strong>Profesionales ' + ev.target.dataItem.dataContext.nombre_profesion + '</strong>');
            var table = $('#table_id').DataTable();
            table.clear().draw();
            $.get('/api/profesiones-personas/' + ev.target.dataItem.dataContext.nombre_profesion + "/" + funcion_select, function(data) {
                for (var i = 0; i < data.length; i++) {
                    table.row.add([
                        data[i].nombres_persona,
                        data[i].apellidos_persona
                    ]).draw(false);
                }
                $('#modal1').modal('open');
            });
        }, this);
        columnTemplate.strokeWidth = 2;
        columnTemplate.strokeOpacity = 1;
        columnTemplate.stroke = am4core.color("#FFFFFF");
        chart.cursor = new am4charts.XYCursor();
        chart.cursor.lineX.strokeOpacity = 0;
        chart.cursor.lineY.strokeOpacity = 0;
        // Enable export
        chart.exporting.menu = new am4core.ExportMenu();
    }
}

function otrasProfesiones() {
    //$("#select-categoria").val('todos');
    $("#select-categoria").val('todos');
    //$("#select-categoria").material_select();
    $('#select-categoria').formSelect();
    ocultarSelectFuncion();
    createTablaTodos();
}

function createTablaTodos() {
    $('#div_registros').hide();
    $('#chartdiv').hide();
    $('#data_table').show();
    var table = $('#table_id2').DataTable();
    table.clear().draw();
    $.get('/api/profesiones-todos', function(data) {
        for (var i = 0; i < data.length; i++) {
            table.row.add([
                data[i].profesion_estudio,
                data[i].total, '<a class="borrar-horario-cobertura waves-effect waves-light btn" >Ver</a>'
            ]).draw(false);
        }
    });
}
$(document).ready(function() {
    $(document).on('click', '.borrar-horario-cobertura', function(event) {
        profesion = $(this).parents("tr").find("td").eq(0).html();
        $('#titulo-modal-profesion').html('<strong>Profesión: ' + profesion + '</strong>');
        var table = $('#table_id3').DataTable();
        table.clear().draw();
        $.get('/api/profesiones-personas-todos/' + profesion, function(data) {
            for (var i = 0; i < data.length; i++) {
                var tipo_funcion;
                if (data[i].categoria == 0) {
                    tipo_funcion = 'Funcion del estado'
                } else {
                    tipo_funcion = 'Institución independiente'
                }
                table.row.add([
                    data[i].nombres_persona,
                    data[i].apellidos_persona,
                    data[i].nombre_posicion,
                    tipo_funcion,
                    data[i].nombre
                ]).draw(false);
            }
            $('#modal2').modal('open');
        });
    });
});