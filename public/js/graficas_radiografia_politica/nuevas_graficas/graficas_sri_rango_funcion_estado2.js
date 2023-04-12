am4core.ready(function() {
	
	getSelectValueCategoria()
	
	calcularTotalMediaSri()

	

}); // end am4core.ready()  
 
function getSelectValue(){

	var categoria_select= document.getElementById("select-categoria").value;
	var funcion_select= document.getElementById("select-funcion").value;
	if (categoria_select==1||categoria_select==2) {
		obtenerDataFuncionEstado();
	}
	if(categoria_select=="todos"){
		//alert('entre');
		obtenerDataTodosFuncionEstado();
	}
	
	 
} 

function obtenerDataFuncionEstado(){
	var funcion_select= document.getElementById("select-funcion").value;
	
	$.get('/api/sri-renta-rango-funcion-estado-nuevo/'+funcion_select,function (data_funciones_estado){

			createGrafica(data_funciones_estado);
		
	})
	
}

function obtenerDataTodosFuncionEstado(){
	$.get('/api/sri-renta-rango-funcion-estado-todos-nuevo',function(data_funciones_estado){
			createGrafica(data_funciones_estado);
		
	})
}




function createGrafica(data_sri_renta){
	totalfuncionarios(data_sri_renta);
		 am4core.useTheme(am4themes_material);
	am4core.useTheme(am4themes_animated);
	// Themes end

	// Create chart instance
	var chart = am4core.create("chartdiv", am4charts.PieChart);
	chart.responsive.enabled = true;

	// Add data
	chart.data = data_sri_renta;

	// Set inner radius
	chart.innerRadius = am4core.percent(0);

	// Add and configure Series
	var pieSeries = chart.series.push(new am4charts.PieSeries());
	pieSeries.dataFields.value = "total_personas";
	pieSeries.dataFields.category = "rango_sri";
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
		var funcion_select= document.getElementById("select-funcion").value;
		var categoria_select_consulta= document.getElementById("select-categoria").value;

		if (categoria_select_consulta=='todos') {
			addPersonasTodos(ev.target.dataItem.dataContext.rango_declaracion)
		}else{
			addPersonasTable(funcion_select,ev.target.dataItem.dataContext.rango_declaracion)
		}
		//alert(ev.target.dataItem.dataContext.rango_declaracion);


	}, this);
	
	pieSeries.labels.template.fill = am4core.color("white");
	

	chart.legend = new am4charts.Legend();
	
	chart.legend.valign = "middle";
	//chart.legend.labels.template.text = "{rango_sri} - {value.percent.formatNumber('#.0')}%[/]";
	chart.legend.labels.template.text = "[bold]{rango_sri}";
	//series1.legendSettings.labelText = "Series: [bold]{rango_sri}[/]";
	var legendContainer = am4core.create("legenddiv-sri", am4core.Container);
	legendContainer.width = am4core.percent(100);
	legendContainer.height = am4core.percent(100);
	chart.legend.parent = legendContainer;



		
		
}

function totalfuncionarios(data_sri){
	var total_funcionarios=0;
	for (var i = 0; i < data_sri.length; i++) {
		total_funcionarios = total_funcionarios+data_sri[i].total_personas;
	}

	$('#total-funcionarios').html('<strong>'+total_funcionarios+'</strong>');
}

function addPersonasTable(funcion_estado,rango_declaracion){
	$('#titulo-modal').html('<strong>Rango de declaración: '+rango_declaracion+'</strong>');
		    var table = $('#table_id').DataTable();
		    table.clear().draw();
		    $.get('/api/sri-renta-rango-funcion-estado/'+funcion_estado+"/"+rango_declaracion,function(data){
		      for (var i = 0; i <data.length; i++) {

		            table.row.add( [
		            	data[i].nombres_persona,
		            	data[i].apellidos_persona,
		            	data[i].cargo,
		            	data[i].valor_impuesto_sri
		            	] ).draw( false ); 
		        }
		        $('#modal1').modal('open'); 
		    });
}


function addPersonasTodos(rango_declaracion){
	$('#titulo-modal').html('<strong>Rango de declaración: '+rango_declaracion+'</strong>');
		    var table = $('#table_id').DataTable();
		    table.clear().draw();
		    $.get('/api/sri-renta-rango-funcion-estado-todos/'+rango_declaracion,function(data){
		      for (var i = 0; i <data.length; i++) {

		            table.row.add( [
		            	data[i].nombres_persona,
		            	data[i].apellidos_persona,
		            	data[i].cargo,
		            	data[i].valor_impuesto_sri
		            	] ).draw( false ); 
		        }
		        $('#modal1').modal('open'); 
		    });
}

function calcularTotalMediaSri(){
	$.get('/api/sri-renta-rango-funcion-estado-todos-nuevo',function(data){
		var total_sri=0;
		var total_personas=0;

			for (var i = 0; i < data.length; i++) {
				total_sri= total_sri+parseFloat(data[i].total_declaracion);
				total_personas = total_personas+data[i].total_personas;
			}

		var media_sri = total_sri/total_personas;
		if (total_sri>0) {
			$('#sri-total').html('<strong>$'+ new Intl.NumberFormat().format(total_sri)+'</strong>');
			$('#sri-media').html('<strong>$'+ new Intl.NumberFormat().format(media_sri.toFixed(2))+'</strong>');
		}else{
			$('#sri-total').html('<strong> No existen registros</strong>');
			$('#sri-media').html('<strong> No existen registros</strong>');
		}
		

		
	}) 
}