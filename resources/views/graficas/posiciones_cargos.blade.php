@extends('template.landing')

@section('head')
<style>
  .map-chart {
    width: 100%;
  max-width: 100%;
height:550px;
  }

</style>
@endsection

@section('content')

<div class="row section grey lighten-3">
    <div class="container">
    <div class="col 11 m10 offset-m1 l9 "><h5 class="flow-text">MOVIMIENTO DE CAUSAS CONSOLIDADO (JUECES Y CONJUECES)</h5></div>
    </div>    
</div>

<div id="fcd-rp-page" class="container">
  <div class="row">

      <div class="col s12 m12 l3">
        <div class="input-field col s12">
          <select id="select-anio" onchange="getSelectValue();">

            
            <option value="1,2,3,4,5">Grupo 1</option>
          
          </select>
          <label> Grupos Posiciones </label>
        </div>
        <br><br>
        <div class="input-field col s12">
          <select id="select-sexo" onchange="getSelectValue();">
            <option value="F">Femenino</option>
            <option value="M">Masculino</option>
            <option value="MF">Masculino y Femenino</option>
            
            
          </select>
          <label> Sexo </label>
        </div>
        <br><br> 
      </div>

      <div class="col s12 m12 l9">
        <div class="map-chart" id="chartdiv"></div>
      </div>
     
  </div>
</div>

@endsection


@section('footer_scripts')
<!-- Resources -->
<script src="/plugins/amcharts4/core.js"></script>
<script src="/plugins/amcharts4/charts.js"></script>
<script src="/plugins/amcharts4/plugins/forceDirected.js"></script>
<script src="/plugins/amcharts4/themes/animated.js"></script>

<!-- Script de las graficas -->

<script src="/js/graficas_radiografia_politica/graficas_cargos_posiciones.js"></script>

@endsection