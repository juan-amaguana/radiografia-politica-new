@extends('template.landing') 

@section('head')
<style>
#chartdiv {
  width: 100%;
  height: 600px;
}

#chartdiv_servidores {
  width: 100%;
  height: 500px;
}

#chartdiv_consultorios {
  width: 100%;
  height: 400px
}

</style>
@endsection

@section('nav_extras')
<div class="nav-content"> 
  <div class="nav-header nav-content-title center">
    <br /><h3> Proposito del Observatorio Judicial</h3>
    <br>
</div>
</div>
@endsection

@section('content')

<div class="container light ">
    
    <div class="row">
        <div class="col s12 m12  l11 offset-l1 notification section"> @include('flash::message')</div>

<div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h6 id="titulo-modal"></h6>
      <p>
          <table  id="table_id">
            <thead>
              <tr>
                  <th>Consultorio</th>
                  <th>Canton</th>
                  <th>Direccion</th>
                  <th>Organizacion</th>
                  <th>Abogados</th>
              </tr>
          </thead>

          <tbody>
            
            

        </tbody>
    </table>
      </p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
    </div>
  </div>

  
        
    </div>
    <div class="row">
            <div id="chartdiv"></div>
    </div>
    <div class="row">
            <div id="chartdiv_servidores"></div>
    </div>

    <div class="row">
        <div class="col s12 m6 l6">
            <div id="chartdiv_consultorios"></div>
        </div>
            
    </div>

</div>



 

<br><br><br>
@endsection

@section('footer_scripts')
<!-- Resources -->
<script src="/plugins/amcharts4/core.js"></script>
<script src="/plugins/amcharts4/charts.js"></script>
<script src="/plugins/amcharts4/maps.js"></script>
<script src="/plugins/amcharts4/themes/dataviz.js"></script>
<script src="/plugins/amcharts4/themes/animated.js"></script>


<script>
    function ObtenerTodoMenu() {
    let provicias_consultorios;
    $.ajax({
        async: false,
        type: 'get',
        url: '/api/conteo-consultorio',
        success: function (data) {
            
            provicias_consultorios = data;
        },
        error: function (request, status, error) {
            alert(jQuery.parseJSON(request.responseText).Message);
        }
    });
    return provicias_consultorios;
}
</script>

<!-- Script de las graficas -->
<script src="/js/estadisticas_observatorio_judicial/estadisticas_accesibilidad.js"></script>
<script src="/js/estadisticas_observatorio_judicial/estadistica_servidores.js"></script>
<script src="/js/estadisticas_observatorio_judicial/estadistica_consultorios.js"></script>

{{-- <script>
  $(document).ready( function () {
    
    $('#table_id').DataTable({
      "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
    });
  $("select").val('10');
  $('select').addClass("browser-default");
  //$('select').material_select();
} );
</script> --}}
@endsection



