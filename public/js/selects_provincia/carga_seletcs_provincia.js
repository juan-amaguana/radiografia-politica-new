function getSelectValueProvincia(){

  var selectedValue= document.getElementById("select-provincia").value;
  if(selectedValue==""){
          //alert("no exite id");
          var html_select_vacio = '<option value="">Seleccione un canton</option>';
          document.getElementById("select-canton").innerHTML = html_select_vacio;
          console.log(html_select_vacio);
          
        }else
        $.get('/api/provincia/'+selectedValue+'/cantones',function(data){
          var html_select = '<option value="">Seleccione un canton</option>';
          for (var i = 0; i <data.length; i++) {

            html_select += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
          }
          document.getElementById("select-canton").innerHTML = html_select;


          $('#select-parroquia').empty().append('<option value="">Seleccione una provincia antes que el canton</option>');

        });  
}


function getSelectValueCanton(){

  var selectedValue= document.getElementById("select-canton").value;
  if(selectedValue==""){
          //alert("no exite id");
          var html_select_vacio = '<option value="">Seleccione un canto</option>';
          document.getElementById("select-parroquia").innerHTML = html_select_vacio;
          console.log(html_select_vacio);
          
        }else
        $.get('/api/canton/'+selectedValue+'/parroquias',function(data){
          var html_select = '<option value="">Seleccione una parroquia</option>';
          for (var i = 0; i <data.length; i++) {

            html_select += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
          }
          document.getElementById("select-parroquia").innerHTML = html_select;




        });  
}