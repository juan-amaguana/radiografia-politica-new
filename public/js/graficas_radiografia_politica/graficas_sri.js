


am4core.ready(function() {

crearCharts();

}); // end am4core.ready()


function getSelectValue(){
   crearCharts();
}


function crearCharts(){
	var selectedValue= document.getElementById("select-anio").value;
	$.get('/api/sri/'+selectedValue,function (data_sri){
		
		 // Themes begin
		am4core.useTheme(am4themes_animated);
		// Themes end

		// Create chart instance
		var chart = am4core.create("chartdiv", am4charts.XYChart);


		// Add data
		chart.data = data_sri;

		// Create axes
		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "nombre";
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
		  series.dataFields.categoryX = "nombre";
		  series.sequencedInterpolation = true;
		  
		  // Make it stacked
		  series.stacked = true;
		  
		  // Configure columns
		  series.columns.template.width = am4core.percent(60);
		  series.columns.template.tooltipText = "[bold]{name}[/]\n[font-size:14px]{nombres_completos}: {valueY}";
		  
		  // Add label
		  var labelBullet = series.bullets.push(new am4charts.LabelBullet());
		  labelBullet.label.text = "{valueY}";
		  labelBullet.locationY = 0.5;
		  
		  return series;
		}

		createSeries("sri_rentas", "SRI rentas");
		createSeries("sri_divisa", "SRI divisas");


		// Legend
		chart.legend = new am4charts.Legend();
	});

} 
