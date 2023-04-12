


am4core.ready(function() {

crearCharts();

}); // end am4core.ready()


function getSelectValue(){
   crearCharts();
}


function crearCharts(){
	var selectedValue= document.getElementById("select-anio").value;
	$.get('/api/patrimonio/'+selectedValue,function (data_patrimonio){
		var data_patrimonios = [];
		for (var i = 0; i < data_patrimonio.length; i++) {
			var nombre_persona;
			var nombres_persona = data_patrimonio[i].nombres_persona.split(" ");
			var apellidos_persona = data_patrimonio[i].apellidos_persona.split(" ");

				nombre_persona = nombres_persona[0]+" "+apellidos_persona[0];
				console.log(nombre_persona);
			
			var patrimonio_persona = {"persona": nombre_persona,
									"nombre_persona":data_patrimonio[i].nombres_persona+" "+data_patrimonio[i].apellidos_persona,
									"activos": parseInt(data_patrimonio[i].activos),
									"pasivos": parseInt(data_patrimonio[i].pasivos),
									"patrimonio": parseInt(data_patrimonio[i].patrimonio),

								}

			//console.log (profesion_data);

			data_patrimonios.push(patrimonio_persona)
		}
		 // Themes begin
		am4core.useTheme(am4themes_animated);
		// Themes end

		// Create chart instance
		var chart = am4core.create("chartdiv", am4charts.XYChart);


		// Add data
		chart.data = data_patrimonios;

		// Create axes
		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "persona";
		categoryAxis.renderer.grid.template.location = 0;


		var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		valueAxis.renderer.inside = true;
		valueAxis.renderer.labels.template.disabled = true;
		valueAxis.min = 0;

		// Create series
		function createSeries(field, name) {
		  
		  // Set up series
		  var series = chart.series.push(new am4charts.ColumnSeries());
		  series.name = name;
		  series.dataFields.valueY = field;
		  series.dataFields.categoryX = "persona";
		  series.sequencedInterpolation = true;
		  
		  // Make it stacked
		  series.stacked = true;
		  
		  // Configure columns
		  series.columns.template.width = am4core.percent(60);
		  series.columns.template.tooltipText = "[bold]{name}[/]\n[font-size:14px]{nombre_persona}: {valueY}";
		  
		  // Add label
		  var labelBullet = series.bullets.push(new am4charts.LabelBullet());
		  labelBullet.label.text = "{valueY}";
		  labelBullet.locationY = 0.5;
		  
		  return series;
		}

		createSeries("activos", "Activos");
		createSeries("pasivos", "Pasivos");
		createSeries("patrimonio", "Patrimonio");


		// Legend
		chart.legend = new am4charts.Legend();
	});

} 
