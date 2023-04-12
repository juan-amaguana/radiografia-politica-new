$( document ).ready(function() {
  var selectedValue= document.getElementById("select-provincia").value;
  var selectedValueCanton= document.getElementById("edit_canton_id").value;
  if (selectedValue!=null) {
    $.get('/api/provincia/'+selectedValue+'/cantones',function(data){
          var html_select = '<option value="">Seleccione un canton</option>';
          for (var i = 0; i <data.length; i++) {
            if (selectedValueCanton == data[i].id) {
              html_select += '<option value="'+data[i].id+'" selected>'+data[i].nombre+'</option>';
            }else
            html_select += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
          }
          document.getElementById("select-canton").innerHTML = html_select;


          $('#select-parroquia').empty().append('<option value="">Seleccione una provincia antes que el canton</option>');

        }); 
  }

  var selectedValueParroquia= document.getElementById("edit_parroquia_id").value;

  if (selectedValueCanton!=null) {
    $.get('/api/canton/'+selectedValueCanton+'/parroquias',function(data){
          var html_select_parroquia = '<option value="">Seleccione una parroquia</option>';
          for (var i = 0; i <data.length; i++) {
            if (data[i].id==selectedValueParroquia) {
              html_select_parroquia += '<option value="'+data[i].id+'"selected>'+data[i].nombre+'</option>';
            }else
            html_select_parroquia += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
          }
          document.getElementById("select-parroquia").innerHTML = html_select_parroquia;
        });  
  }
});

