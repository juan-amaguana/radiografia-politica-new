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
    $.get('/api/profesiones-personas-area/' + funcion_select, function(data_funciones_estado) {
        createGrafica(data_funciones_estado);
    })
}

function obtenerDataTodosFuncionEstado() {
    $.get('/api/profesiones-personas-area-todos', function(data_funciones_estado) {
        createGrafica(data_funciones_estado);
    })
}
/*function createGrafica2(data_profesion_area){

	if (data_profesion_area.length==0) {
      $('#chartdiv').hide();
      $('#div_registros').show(2000);
      $('#div_registros').html('<strong>No existen registros. Sigue consultando</strong>');

    }else{

    	$('#div_registros').hide();
    	$('#chartdiv').show();

    	var funcion_select= document.getElementById("select-funcion").value;

		// Themes begin
		am4core.useTheme(am4themes_animated);
		// Themes end

		var chart = am4core.create("chartdiv", am4charts.PieChart);
		chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

		chart.data = data_profesion_area;
		chart.radius = am4core.percent(70);
		chart.innerRadius = am4core.percent(40);
		chart.startAngle = 180;
		chart.endAngle = 360;  

		var series = chart.series.push(new am4charts.PieSeries());
		series.dataFields.value = "numero_profesionales";
		series.dataFields.category = "estudio_area";

		series.slices.template.cornerRadius = 10;
		series.slices.template.innerCornerRadius = 7;
		series.slices.template.draggable = true;
		series.slices.template.inert = true;
		series.labels.template.text = "";
		series.alignLabels = false;

		series.slices.template.events.on("hit", function(ev) {
		 	var funcion_select= document.getElementById("select-funcion").value;
			var categoria_select_consulta= document.getElementById("select-categoria").value;

			if (categoria_select_consulta=='todos') {

				addPersonasTodos(ev.target.dataItem.dataContext.area_id, ev.target.dataItem.dataContext.estudio_area)
			}else{
				addPersonasTable(funcion_select, ev.target.dataItem.dataContext.area_id, ev.target.dataItem.dataContext.estudio_area)
			}
			
		}, this);

		series.hiddenState.properties.startAngle = 90;
		series.hiddenState.properties.endAngle = 90;

		chart.legend = new am4charts.Legend();

    }

}*/
function totalfuncionarios(data_profesion_area) {
    var total_funcionarios = 0;
    for (var i = 0; i < data_profesion_area.length; i++) {
        total_funcionarios = total_funcionarios + data_profesion_area[i].numero_profesionales;
    }
    $('#total-funcionarios').html('<strong>' + total_funcionarios + '</strong>');
}

function createGrafica(data_profesion_area) {
    totalfuncionarios(data_profesion_area)
    if (data_profesion_area.length == 0) {
        $('#chartdiv').hide();
        $('#div_registros').show(2000);
        $('#div_registros').html('<strong>No existen registros. Sigue consultando</strong>');
    } else {
        $('#div_registros').hide();
        $('#chartdiv').show();
        var funcion_select = document.getElementById("select-funcion").value;
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end
        var chart = am4core.create("chartdiv", am4charts.PieChart);
        chart.responsive.enabled = true;
        // Add data
        chart.data = data_profesion_area;
        // Set inner radius
        chart.innerRadius = am4core.percent(0);
        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "numero_profesionales";
        pieSeries.dataFields.category = "estudio_area";
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
                addPersonasTodos(ev.target.dataItem.dataContext.area_id, ev.target.dataItem.dataContext.estudio_area)
            } else {
                addPersonasTable(funcion_select, ev.target.dataItem.dataContext.area_id, ev.target.dataItem.dataContext.estudio_area)
            }
        }, this);
        pieSeries.labels.template.fill = am4core.color("white");
        chart.legend = new am4charts.Legend();
        chart.legend.valign = "middle";
        //chart.legend.labels.template.text = "{rango_sri} - {value.percent.formatNumber('#.0')}%[/]";
        chart.legend.labels.template.text = "[bold]{estudio_area}";
        //series1.legendSettings.labelText = "Series: [bold]{rango_sri}[/]";
        var legendContainer = am4core.create("legenddiv", am4core.Container);
        legendContainer.width = am4core.percent(100);
        legendContainer.height = am4core.percent(100);
        chart.legend.parent = legendContainer;
    }
}

function addPersonasTable(funcion_estado, area_id, area_estudio) {
    $('#titulo-modal').html('<strong>Área de estudio: ' + area_estudio + '</strong>');
    var table = $('#table_id').DataTable();
    table.clear().draw();
    $.get('/api/detalle-profesiones-personas-area-estudio/' + funcion_estado + "/" + area_id, function(data) {
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

function addPersonasTodos(area_id, area_estudio) {
    $('#titulo-modal').html('<strong>Área de estudio: ' + area_estudio + '</strong>');
    var table = $('#table_id').DataTable();
    table.clear().draw();
    $.get('/api/detalle-profesiones-personas-area-estudios-todos/' + area_id, function(data) {
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