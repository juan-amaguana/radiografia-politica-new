
function getSelectValueCategoria(){

	var categoria_select= document.getElementById("select-categoria").value;
	if (categoria_select == 1) {
		$('#select-secundario').show();
		cargarComboFuncionEstado();
	}else if (categoria_select == 2){
		$('#select-secundario').show();
		cargarComboIndependientes();
	}
	else{
		ocultarSelectFuncion();
	}

}

function ocultarSelectFuncion(){
	$('#select-secundario').hide();
	obtenerDataTodosFuncionEstado();
}
 

function cargarComboFuncionEstado(){
	$.get('/api/funciones-estado',function(data_funciones_estado){
		
		opcionesComboSecundario(data_funciones_estado);
		obtenerDataFuncionEstado();
	});
} 

function cargarComboFuncionEstadoNoAsincrona(){
	$.ajax({
		async:false,
		cache:false,
		type: 'GET',
		url: "/api/funciones-estado",
		success:  function(data_funciones_estado){
			opcionesComboSecundario(data_funciones_estado);
		},
		beforeSend:function(){},
		error:function(objXMLHttpRequest){}
	});
}

function cargarComboIndependientes(){

	$.get('/api/instituciones-independientes',function(data_independientes){
		opcionesComboSecundario(data_independientes);
		obtenerDataFuncionEstado();
	});
	
	
}


function opcionesComboSecundario(data){
	var Options="";
	$.each(data, function(i, val){ 
		Options=Options+"<option value='"+val.id+"'>"+val.nombre+"</option>";
	});
	

	$('#select-funcion').empty();
	$('#select-funcion').append(Options);
	$("#select-funcion").formSelect();
}