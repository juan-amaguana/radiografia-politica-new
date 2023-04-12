@extends('template.landing')

@section('head')
<style>

  .map-chart, #legenddiv-sri {
  width: 100%;
  height: 400px;
  margin: 1em 0;
}


  .chart-verificador {
    width: 100%;
    height: 400px;

  }

</style>
@endsection

@section('content')

<div class="row section grey lighten-3">
  <div class="container">
    <div class="col 11 m10 offset-m1 l9 "><h5 class="flow-text">Funcionarios de alto rango clasificados según el monto de su declaración de impuesto a la renta</h5></div>
  </div>
</div>

<div id="fcd-rp-page" class="container">
  <div class="row">

    <div class="col s12 m12 l3">
      <div class="input-field col s12">
        <select id="select-categoria" onchange="getSelectValueCategoria();">
          <option value="todos">Todos</option>
          <option value="1">Función del Estado</option>
          <option value="2">Instituciones independientes</option>

        </select>
        <label> Categoría </label>
      </div>

      <div class="input-field col s12" id="select-secundario">
        <select id="select-funcion" onchange="getSelectValue();">
        </select>
        <label id="categorias"> Función Estado </label>
      </div>

      <div class="col s12 m12 l12">
        <div class="indicador indicador-stats blue-grey darken-1   z-depth-3 white-text center-align">
          <div class="stats-info">
            <h4>Total</h4>
            <p id="sri-total"></p>
          </div>
        </div>
      </div>

      <div class="col s12 m12 l12">
        <div class="indicador indicador-stats blue-grey darken-1   z-depth-3 white-text center-align">
          <div class="stats-info">
            <h4>Promedio</h4>
            <p id="sri-media"></p>
          </div>
        </div>
      </div>

      @include('partials.total_funcionarios')


    </div>

    <div class="col s12 m12 l9">
      <p>Conoce a los funcionarios de alto rango, clasificados según el monto de su declaración de impuesto a la renta.</p>
      <a class="modal-trigger hide-on-med-and-up" href="#ayuda-movil"><img src="/images/info.png" class="responsive-img" width="7%" alt=""></a>
      <a class="modal-trigger show-on-medium" style="display: none;" href="#ayuda-movil"><img src="/images/info.png" class="responsive-img" width="4%" alt=""></a>
      <a class="modal-trigger hide-on-med-and-down"  href="#ayuda-web"><img src="/images/info.png" class="responsive-img" width="3%" alt=""></a>

      <!-- inicio botones API -->
      <div class="fcd-button-footer-props fcd-btn-vermas hide-on-small-only">
        <a href="/excel-sri" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>Excel</a>
        <a href="/csv-sri" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>CSV</a>
        <a href="/api/json-sri" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>JSON</a>
      </div>

      <div class="fcd-button-footer-props fcd-btn-vermas hide-on-med-and-up">
        <div class="row">
          <div class="col s4" style="margin-top: 10px"><a href="/excel-sri" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>Excel</a></div>
          <div class="col s4" style="margin-top: 10px"><a href="/api/json-sri" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>JSON</a></div>
          <div class="col s4" style="margin-top: 10px"><a href="/csv-sri" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>CSV</a></div>
        </div>
      </div>
       <!-- fin botones API -->

      <div class="row">
        <div class="col s12 m4 l6"><div class="map-chart"  id="chartdiv"></div></div>
        <div class="col s12 m8 l6"><div id="legenddiv-sri" style="height: 400px"></div></div>
      </div>

      <div class="chart-verificador valign-wrapper font-30" id="div_registros" style="display: none" ></div>
      <br>

    </div>

  </div>
</div>

 <div id="modal1" class="modal modal-fixed-footer">
      <div class="modal-content">
        <h6 id="titulo-modal"></h6>
        <p>
          <table  id="table_id">
            <thead>
              <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cargo</th>
                <th>Monto declaración</th>
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

  <!-- Modal Structure -->
  @include('partials.tutorial_grafica3')
  @include('partials.tutorial_grafica3_web')

@endsection


@section('footer_scripts')

<!-- Resources -->
<script src="/plugins/amcharts4/core.js"></script>
<script src="/plugins/amcharts4/charts.js"></script>
<script src="/plugins/amcharts4/themes/material.js"></script>
<script src="/plugins/amcharts4/themes/animated.js"></script>



<!-- Script de las graficas -->

<script src="/js/graficas_radiografia_politica/nuevas_graficas/graficas_sri_rango_funcion_estado2.js"></script>
<script src="/js/graficas_radiografia_politica/nuevas_graficas/carga_select_genero.js"></script>
<script src="/js/datatable/configDataTable.js"></script>


@endsection
