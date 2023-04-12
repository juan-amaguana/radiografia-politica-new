@extends('template.landing')

@section('nav_extras')
@endsection

@section('content')

<div class="row section grey lighten-3">
    <div class="container">
    <div class="col  m10  l9 "><h5 class="flow-text">Validación Datos</h5></div>
    </div>
</div>

<div id="fcd-rp-page" class="container">
   <div class="row">

    <div class="col s12 m10 offset-m1 l10 offset-l1 section">
        <div class="section">


            @if(count($errores_excel)>0)
              <div class="card-panel red  white-text z-depth-5">
                <p>Estimado <strong>{{$sumate_iniciativa->nombre_aportante}}</strong> exiten errores en el archivo para guardar su registro corrija los siguientes errores:</p>
                <ul>
                  @foreach($errores_excel as $error)
                    <li>{{ $error  }}</li>
                  @endforeach
                </ul>
                <a href="/sumate-a-la-iniciativa"  class="waves-effect waves-light red btn" style="background-color: #2E86C1 !important;"><i class="material-icons left">arrow_back</i>Regresar</a>

              </div>
            @else
              hola
            @endif

        </div>

      </div>

  </div>

</div>

@endsection
