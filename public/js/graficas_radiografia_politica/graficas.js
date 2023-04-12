
var graficaBarChart = function(){
	"use strict";

	$.get('/api/personas-partidos-politicos',function (data_personas){ 

	var chart = c3.generate({
		bindto: '#chart-radio',
		data: {
			json: {total_personas: data_personas['personas_radiografia_politica'],
            },

	type: 'bar',
	onclick: function (d, element) { console.log("onclick", d, element); },
	onmouseover: function (d) { console.log("onmouseover", d); },
	onmouseout: function (d) { console.log("onmouseout", d); }
	},
	axis: {
		x: {
			type: 'category',
			categories: data_personas['titles']
		}
	},
	bar: {
		width: {
			ratio: 0.3,
	//            max: 30
	},
	}
	});

});

}

var graficaBarChartEstudios = function(){
	"use strict";
	var partido_politico_id = document.getElementById("partido_politico_bar").value;

	$.get('/api/personas-estudios/'+partido_politico_id,function (data_personas){ 

	var chart = c3.generate({
		bindto: '#chart-bar-estudios',
		data: {
			json: data_personas,

	type: 'bar',
	onclick: function (d, element) { console.log("onclick", d, element); },
	onmouseover: function (d) { console.log("onmouseover", d); },
	onmouseout: function (d) { console.log("onmouseout", d); }
	},
	axis: {
		x: {
			type: 'category',
			categories: 'Alianza pais'
		}
	},
	bar: {
		width: {
			ratio: 0.3,
	//            max: 30
	},
	}
	});

});

}

var graficaDountchart = function(){
	"use strict";

	var partido_politico_id = document.getElementById("partido_politico").value;

	$.get('/api/sexo/personas-partidos-politicos/'+partido_politico_id,function (data_personas){ 
	
	var chart = c3.generate({
		bindto: '#pie-chart',
		data: {
			json:data_personas['personas_radiografia_politica'],

			type : 'donut',
			onmouseover: function (d, i) { console.log("onmouseover", d, i, this); },
			onmouseout: function (d, i) { console.log("onmouseout", d, i, this); },
			onclick: function (d, i) { console.log("onclick", d, i, this); },
		},
		donut: {
        title: data_personas['partido_politico'].nombre_partido_politico
    }
	});


});

}

var GraficasRadiografiaPolitica = function () {
	"use strict";
    return {
        //main function
        init: function () {
        	graficaBarChart();
        	graficaBarChartEstudios();
            graficaDountchart();
            
        }
    };
}();