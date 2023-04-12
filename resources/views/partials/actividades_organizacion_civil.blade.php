<div class="section ub-pl-20">
  <h5 class="center-align ub-text-bold fcd-custom-color">CARGOS EN ORGANIZACIÓN DE LA SOCIEDAD CIVIL</h5>

  @if($actividades_organicacion_civil->count() == 0)
  <p class="ub-mt-30 center-align ub-font-weight-600 font-16">No existen registros de cargos en el sector público.</p>
  @endif

  <div class="timeline-container timeline-container-color-yellow">
    @foreach ($actividades_organicacion_civil as $actividad_organizacion_civil)

    @if ($actividad_organizacion_civil->id%2  == 0)
    <div class="timeline-block timeline-block-right">
     @else
     <div class="timeline-block timeline-block-left">
       @endif
       <div class="timeline-marker timeline-color-yellow"></div>
       <div class="timeline-content">
        <h3>{{ $actividad_organizacion_civil->anio_inicio }}</h3>
        @if(is_null($actividad_organizacion_civil->nombre_fuente_actividad))
        <span>{{ strip_tags(preg_replace('/&nbsp;/', ' ',$actividad_organizacion_civil->descripcion_corta )) }}</span>
        @include('partials.fecha_actividad_organizacionales')
        <p>{!! $actividad_organizacion_civil->descripcion !!}</p>
        @else
          <span>{{ $actividad_organizacion_civil->descripcion_corta }}</span>
          @include('partials.fecha_actividad_organizacionales')
          <p>
            <span>Fuente: {{$actividad_organizacion_civil->nombre_fuente_actividad}}</span> <br>  
          </p>
          <p>
            <span><a href="{{$actividad_organizacion_civil->link_fuente_actividad}}">{{$actividad_organizacion_civil->link_fuente_actividad}}</a></span>
          </p>
        @endif
      </div>
    </div>

    @endforeach
  </div>

</div> 