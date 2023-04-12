
@extends('template.landing')

@section('nav_extras')
@endsection

@section('content')
<div class="row section grey lighten-3">
    <div class="container">
    <div class="col 11 m10 offset-m1 l9 offset-l1"><h5 class="flow-text">Radiografía Política</h5></div>
    </div>    
</div>
<div id="fcd-rp-page" class="container light ">
    
    <div class="row">


      <div class="col s12 m10 offset-m1 l10 offset-l1 section">
        <div class="section">

          <div id="grid-mision">
            <strong> <h5 class="titulo"> Quiénes somos</h5></strong>
            <div class="descripcion">{!!$administracion->mision!!}</div>
          </div>

          <div id="grid-vision" style="display: none;">
            <strong><h5 class="titulo">Visión</h5></strong>
            <div class="descripcion">{!!$administracion->vision!!}</div>
          </div>

        </div>

      </div>

    </div>

    <br><br>

</div>

@endsection

