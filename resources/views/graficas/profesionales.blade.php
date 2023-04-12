@extends('template.landing')

@section('head')
<style>
  .map-chart {
    width: 100%;
  max-width: 100%;
height:550px;
  }

  .chart-verificador {
    width: 100%;
    height: 400px;

  }
  .table-class{
    width: 100%;

  }

</style>
@endsection

@section('content')

<div class="row section grey lighten-3">
    <div class="container">
    <div class="col 11 m10 offset-m1 l9 "><h5 class="flow-text">Funcionarios de alto rango clasificados según su profesión </h5></div>
    </div>
</div>

<div id="fcd-rp-page" class="container">
  <div class="row">

      <div class="col s12 m12 l3">
      <div class="input-field col s12">
        <select id="select-categoria" onchange="getSelectValueCategoria();">
          <option value="1">Función del Estado</option>
          <option value="2">Instituciones independientes</option>
          <option value="todos">Todos</option>
        </select>
        <label> Categoría </label>
      </div>

      <div class="input-field col s12" id="select-secundario">
        <select id="select-funcion" onchange="getSelectValue();">
        </select>
        <label id="categorias"> Función Estado </label>
      </div>
      <a class="waves-effect waves-light btn" onclick="otrasProfesiones();">Otras profesiones</a>
    </div>
      <div class="col s12 m12 l9">
        <p>En esta gráfica encontrarás a los funcionarios clasificados según su profesión.</p>
        <a class="modal-trigger hide-on-med-and-up" href="#ayuda-movil"><img src="/images/info.png" class="responsive-img" width="7%" alt=""></a>
      <a class="modal-trigger show-on-medium" style="display: none;" href="#ayuda-movil"><img src="/images/info.png" class="responsive-img" width="4%" alt=""></a>
      <a class="modal-trigger hide-on-med-and-down"  href="#ayuda-web"><img src="/images/info.png" class="responsive-img" width="3%" alt=""></a>
      <!-- inicio botones API -->
      <div class="fcd-button-footer-props fcd-btn-vermas hide-on-small-only">
        <a href="/excel-estudio" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>Excel</a>
        <a href="/csv-estudio" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>CSV</a>
        <a href="/api/json-estudio" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>JSON</a>
      </div>

      <div class="fcd-button-footer-props fcd-btn-vermas hide-on-med-and-up">
        <div class="row">
          <div class="col s4" style="margin-top: 10px"><a href="/excel-estudio" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>Excel</a></div>
          <div class="col s4" style="margin-top: 10px"><a href="/api/json-estudio" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>JSON</a></div>
          <div class="col s4" style="margin-top: 10px"><a href="/csv-estudio" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>CSV</a></div>
        </div>
      </div>
      <!-- fin botones API -->

        <div class="map-chart" id="chartdiv"></div>
        <div class="table-class" id="data_table" style="display: none">
          <table  id="table_id2">
            <thead>
              <tr>
                <th>Profesion</th>
                <th>Número</th>
                <th>Acción</th>
              </tr>
            </thead>

            <tbody>



            </tbody>
          </table>
        </div>
        <div class="chart-verificador valign-wrapper font-30" id="div_registros" style="display: none" ></div>

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
  <div id="modal2" class="modal">
    <div class="modal-content">
      <h4 id="titulo-modal-profesion"></h4>
      <p>
        <table  id="table_id3">
            <thead>
              <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cargo</th>
                <th>Tipo función</th>
                <th>Función</th>
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
  @include('partials.tutorial_grafica2')
  @include('partials.tutorial_grafica2_web')

@endsection


@section('footer_scripts')
<!-- Resources -->
<script src="/plugins/amcharts4/core.js"></script>
<script src="/plugins/amcharts4/charts.js"></script>
<script src="/plugins/amcharts4/themes/animated.js"></script>

<!-- Script de las graficas -->

<script src="/js/graficas_radiografia_politica/graficas_profesiones.js"></script>
<script src="/js/graficas_radiografia_politica/nuevas_graficas/carga_select_genero.js"></script>
<script src="/js/datatable/configDataTable.js"></script>

@endsection
