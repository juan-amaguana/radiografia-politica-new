@extends('template.landing')

@section('head')
<style>
  .chart-barras-horizontales {
    width: 100%;
    height: 450px;
    
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
    <div class="col 11 m10 offset-m1 l9 "><h5 class="flow-text">Funcionarios de alto rango con más patrimonio declarado</h5> </div>
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

    </div>

    <div class="col s12 m12 l9">
      <p>Conoce a los 5 funcionarios de alto rango con más patrimonio declarado por función del Estado, instituciones independientes y global, así como los totales y promedios.</p>

      <a class="modal-trigger hide-on-med-and-up" href="#ayuda-movil"><img src="/images/info.png" class="responsive-img" width="7%" alt=""></a>
      <a class="modal-trigger show-on-medium" style="display: none;" href="#ayuda-movil"><img src="/images/info.png" class="responsive-img" width="4%" alt=""></a>
      <a class="modal-trigger hide-on-med-and-down"  href="#ayuda-web"><img src="/images/info.png" class="responsive-img" width="3%" alt=""></a>
      
      <!-- inicio botones descarga -->
      
      <div class="fcd-button-footer-props fcd-btn-vermas hide-on-small-only">
        <a href="/excel-patrimonio" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>Excel</a>
        <a href="/csv-patrimonio" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>CSV</a>
        <a href="/api/json-patrimonio" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>JSON</a>
      </div>

      <div class="fcd-button-footer-props fcd-btn-vermas hide-on-med-and-up">
        <div class="row">
          <div class="col s4" style="margin-top: 10px"><a href="/excel-patrimonio" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>Excel</a></div>
          <div class="col s4" style="margin-top: 10px"><a href="/api/json-patrimonio" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>JSON</a></div>
          <div class="col s4" style="margin-top: 10px"><a href="/csv-patrimonio" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_downward</i>CSV</a></div> 
        </div>
      </div>
      <!-- fin botones descarga -->


      <div class="scroller" id="scroll-bar">

        <div class="chart-barras-horizontales" id="chartdiv"></div>
      </div>
      <div class="chart-verificador valign-wrapper font-30" id="div_registros" style="display: none" ></div> 
        <br>
        
    </div>

  </div>
</div>

<!-- Modal Structure -->
@include('partials.tutorial_grafica1')
@include('partials.tutorial_grafica1_web')



@endsection


@section('footer_scripts')

<!-- Resources -->
<script src="/plugins/amcharts4/core.js"></script>
<script src="/plugins/amcharts4/charts.js"></script>
<script src="/plugins/amcharts4/themes/animated.js"></script>



<!-- Script de las graficas -->

<script src="/js/graficas_radiografia_politica/nuevas_graficas/graficas_patrimonio_funcion_estado.js"></script>
<script src="/js/graficas_radiografia_politica/nuevas_graficas/carga_select_genero.js"></script>


@endsection