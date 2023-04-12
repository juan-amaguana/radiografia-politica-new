am4core.ready(function() {
	
	getSelectValueCategoria();
	//obtenerDataFuncionEstado();
 	//alert('hola'); 
}); // end am4core.ready()
 
function getSelectValue(){ 
	var categoria_select= document.getElementById("select-categoria").value;
	var funcion_select= document.getElementById("select-funcion").value;
	if (categoria_select==1||categoria_select==2) {
		obtenerDataFuncionEstado();
	}
	
		
} 

function obtenerDataFuncionEstado(){
	var funcion_select= document.getElementById("select-funcion").value;
	
	$.get('/api/patrimonios-funcion-estado/'+funcion_select,function(data_funciones_estado){
		createGrafica(data_funciones_estado);
	})
}

function obtenerDataTodosFuncionEstado(){
	
	$.get('/api/patrimonios-todos',function(data_funciones_estado){
		createGrafica(data_funciones_estado);
	})
}




function createGrafica(data_patrimonio){
	
	if (data_patrimonio.length==0) {
      $('#chartdiv').hide();
      $('#scroll-bar').hide();
      $('#div_registros').show(2000);
      $('#div_registros').html('<strong>No existen registros. Sigue consultando</strong>');

    }else{
    	$('#div_registros').hide();
    	$('#chartdiv').show();
    	$('#scroll-bar').show();
    	var data_patrimonio_persona=[];

				// Themes begin
			am4core.useTheme(am4themes_animated);
			// Themes end

			/**
			 * Chart design taken from Samsung health app
			 */

			var chart = am4core.create("chartdiv", am4charts.XYChart);
			chart.responsive.enabled = true;
			chart.scrollbarX = new am4core.Scrollbar();
			chart.scrollbarX.parent = chart.topAxesContainer;
			chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

			chart.paddingBottom = 30;

			for (var i = 0; i < data_patrimonio.length; i++) {

				var array_nombre = data_patrimonio[i].nombres_persona.split(" ");
				var array_apellido = data_patrimonio[i].apellidos_persona.split(" ");
				var patrimonio_persona = new Object();
				patrimonio_persona.nombre_corto = data_patrimonio[i].nombres_persona+"\n"+array_apellido[0];
				patrimonio_persona.nombres_persona = data_patrimonio[i].nombres_persona+data_patrimonio[i].apellidos_persona;
				patrimonio_persona.patrimonio = parseInt(data_patrimonio[i].patrimonio);
				patrimonio_persona.color = chart.colors.next();
				patrimonio_persona.imagen_persona = data_patrimonio[i].imagen_persona;

				data_patrimonio_persona.push(patrimonio_persona); 
			}

			chart.data = data_patrimonio_persona;

			var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
			categoryAxis.dataFields.category = "nombre_corto";
			categoryAxis.renderer.grid.template.strokeOpacity = 0;
			categoryAxis.renderer.minGridDistance = 10; 
			categoryAxis.renderer.labels.template.dy = 35;

			categoryAxis.renderer.tooltip.dy = 35;


			var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
			valueAxis.renderer.inside = true;
			valueAxis.renderer.labels.template.fillOpacity = 0.3;
			valueAxis.renderer.grid.template.strokeOpacity = 0;
			valueAxis.min = 0;
			valueAxis.cursorTooltipEnabled = false;
			valueAxis.renderer.baseGrid.strokeOpacity = 0;

			var series = chart.series.push(new am4charts.ColumnSeries);
			series.dataFields.valueY = "patrimonio";
			series.dataFields.categoryX = "nombre_corto";
			series.tooltipText = "{valueY.value}";
			series.tooltip.pointerOrientation = "vertical";
			series.tooltip.dy = - 6;
			series.columnsContainer.zIndex = 100;

			var columnTemplate = series.columns.template;
			columnTemplate.width = am4core.percent(500);
			columnTemplate.maxWidth = 66;
			columnTemplate.column.cornerRadius(60, 60, 10, 10);
			columnTemplate.strokeOpacity = 0;

			series.heatRules.push({ target: columnTemplate, property: "fill", dataField: "valueY", min: am4core.color("#e5dc36"), max: am4core.color("#5faa46") });
			series.mainContainer.mask = undefined;

			var cursor = new am4charts.XYCursor();
			chart.cursor = cursor;
			cursor.lineX.disabled = true;
			cursor.lineY.disabled = true;
			cursor.behavior = "none";

			var bullet = columnTemplate.createChild(am4charts.CircleBullet);
			bullet.circle.radius = 30;
			bullet.valign = "bottom";
			bullet.align = "center";
			bullet.isMeasured = true;
			bullet.mouseEnabled = false;
			bullet.verticalCenter = "bottom";
			bullet.interactionsEnabled = false;

			var hoverState = bullet.states.create("hover");
			var outlineCircle = bullet.createChild(am4core.Circle);
			outlineCircle.adapter.add("radius", function (radius, target) {
			    var circleBullet = target.parent;
			    return circleBullet.circle.pixelRadius + 10;
			})

			var image = bullet.createChild(am4core.Image);
			image.width = 60;
			image.height = 60;
			image.horizontalCenter = "middle";
			image.verticalCenter = "middle";
			image.propertyFields.href = "imagen_persona";

			image.adapter.add("mask", function (mask, target) {
			    var circleBullet = target.parent;
			    return circleBullet.circle;
			})

			var previousBullet;
			chart.cursor.events.on("cursorpositionchanged", function (event) {
			    var dataItem = series.tooltipDataItem;

			    if (dataItem.column) {
			        var bullet = dataItem.column.children.getIndex(1);

			        if (previousBullet && previousBullet != bullet) {
			            previousBullet.isHover = false;
			        }

			        if (previousBullet != bullet) {

			            var hs = bullet.states.getKey("hover");
			            hs.properties.dy = -bullet.parent.pixelHeight + 30;
			            bullet.isHover = true;

			            previousBullet = bullet;
			        }
			    }
			})
	}
	


}




