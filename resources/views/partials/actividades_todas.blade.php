<div class="section ub-pl-20">
  <h5 class="center-align ub-text-bold fcd-custom-color">CARGOS POR ORDEN CRONOLÓGICO</h5>

  @if($actividades_persona->count() == 0)
  <p class="ub-mt-30 center-align ub-font-weight-600 font-16">No existen registros de actividades.</p>
  @endif

  <div class="timeline-container timeline-container-color-yellow">
    @foreach ($actividades_persona as $actividad_persona)

    @if ($actividad_persona->id%2  == 0)
    <div class="timeline-block timeline-block-right">
     @else
     <div class="timeline-block timeline-block-left">
       @endif
       <div class="timeline-marker timeline-color-yellow"></div>
       <div class="timeline-content">
        <h3>{{ $actividad_persona->anio_inicio }}</h3>
        @if(is_null($actividad_persona->nombre_fuente_actividad))
        <span>{{ strip_tags(preg_replace('/&nbsp;/', ' ',$actividad_persona->descripcion_corta )) }}</span>
        @include('partials.fecha_actividades')
        <p>{!! $actividad_persona->descripcion !!}</p>
        @else
          <span>{{ $actividad_persona->descripcion_corta }}</span>
          @include('partials.fecha_actividades')
          <p>
            <span>Fuente: {{$actividad_persona->nombre_fuente_actividad}}</span> <br>  
          </p>
          <p>
            <span><a href="{{$actividad_persona->link_fuente_actividad}}">{{$actividad_persona->link_fuente_actividad}}</a></span>
          </p>
        @endif
      </div>
    </div>

    @endforeach
  </div>

</div>  