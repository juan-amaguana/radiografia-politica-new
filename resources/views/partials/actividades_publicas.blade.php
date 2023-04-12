<div class="section ub-pl-20">
  <h5 class="center-align ub-text-bold fcd-custom-color">CARGOS EN EL SECTOR PÚBLICO</h5>

  @if($actividad_publica->count() == 0)
  <p class="ub-mt-30 center-align ub-font-weight-600 font-16">No existen registros de cargos en el sector público.</p>
  @endif

  <div class="timeline-container timeline-container-color-yellow">
    @foreach ($actividad_publica as $actividades_publicas)

    @if ($actividades_publicas->id%2  == 0)
    <div class="timeline-block timeline-block-right">
     @else
     <div class="timeline-block timeline-block-left">
       @endif
       <div class="timeline-marker timeline-color-yellow"></div>
       <div class="timeline-content">
        <h3>{{ $actividades_publicas->anio_inicio }}</h3>
        @if(is_null($actividades_publicas->nombre_fuente_actividad))
        <span>{{ strip_tags(preg_replace('/&nbsp;/', ' ',$actividades_publicas->descripcion_corta )) }}</span>
        @include('partials.fecha_actividad_publicas')
        <p>{!! $actividades_publicas->descripcion !!}</p>
        @else
          <span>{{ $actividades_publicas->descripcion_corta }}</span>
          @include('partials.fecha_actividad_publicas')
          <!--span>2018-2015</span-->
          <p>
            <span>Fuente: {{$actividades_publicas->nombre_fuente_actividad}}</span> <br>  
          </p>
          <p>
            <span><a href="{{$actividades_publicas->link_fuente_actividad}}">{{$actividades_publicas->link_fuente_actividad}}</a></span>
          </p>
        @endif
      </div>
    </div>

    @endforeach
  </div>

</div> 