


am4core.ready(function() {

crearCharts();

}); // end am4core.ready()


function getSelectValue(){
   crearCharts();
}


function crearCharts(){
  var selectedValue= document.getElementById("select-anio").value;
  var selectedSexo= document.getElementById("select-sexo").value;

$.get('/api/personas-cargos',function (data_personas){
		var data_json =[];
		console.log(data_personas);
		for (var i = 0; i < data_personas.length; i++) {
			var data_cargo = new Object();
			data_cargo.name = data_personas[i].nombre_posicion;
			data_cargo.value = 15;
			//arrayProperties.push(properties);
			var arrayChildren = new Array();
			var data_children = data_personas[i].persona;
			//console.log(data_children[0].nombres_persona);
			
			for (var j = 0; j < data_children.length; j++) {
				var children_json = new Object();
				if (selectedSexo == "M"&& data_children[j].genero_persona == 1) {
					
					children_json.name = data_children[j].nombres_persona+' '+data_children[j].apellidos_persona;
					children_json.value = 1;
					arrayChildren.push(children_json);
					console.log(data_children[j].nombres_persona);
				}

				if (selectedSexo == "F"&& data_children[j].genero_persona == 0) {
					
					children_json.name = data_children[j].nombres_persona+' '+data_children[j].apellidos_persona;
					children_json.value = 1;
					arrayChildren.push(children_json);
					console.log(data_children[j].nombres_persona);
				}

				if (selectedSexo == "MF") {
					
					children_json.name = data_children[j].nombres_persona+' '+data_children[j].apellidos_persona;
					children_json.value = 1;
					arrayChildren.push(children_json);
					console.log(data_children[j].nombres_persona);	
				}
				
				
			}

			data_cargo.children = arrayChildren;

			data_json.push(data_cargo);
		}
		// Themes begin
	am4core.useTheme(am4themes_animated);
	// Themes end



	var chart = am4core.create("chartdiv", am4plugins_forceDirected.ForceDirectedTree);
	chart.legend = new am4charts.Legend();

	var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries())

	//console.log(arrayProperties);

	networkSeries.data = data_json;

	networkSeries.dataFields.linkWith = "linkWith";
	networkSeries.dataFields.name = "name";
	networkSeries.dataFields.id = "name";
	networkSeries.dataFields.value = "value";
	networkSeries.dataFields.children = "children";

	networkSeries.nodes.template.tooltipText = "{name}";
	networkSeries.nodes.template.fillOpacity = 1;

	networkSeries.nodes.template.label.text = "{name}"
	networkSeries.fontSize = 8;
	networkSeries.maxLevels = 2;
	networkSeries.maxRadius = am4core.percent(6);
	networkSeries.manyBodyStrength = -16;
	networkSeries.nodes.template.label.hideOversized = true;
	networkSeries.nodes.template.label.truncate = true;
	});


} 