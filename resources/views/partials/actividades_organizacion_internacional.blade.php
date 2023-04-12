<div class="section ub-pl-20">
  <h5 class="center-align ub-text-bold fcd-custom-color">CARGOS EN ORGANIZACIÓN INTERNACIONAL</h5>

  @if($actividades_organicacion_internacional->count() == 0)
  <p class="ub-mt-30 center-align ub-font-weight-600 font-16">No existen registros de cargos en el sector privado.</p>
  @endif

  <div class="timeline-container timeline-container-color-blue">
    @foreach ($actividades_organicacion_internacional as $actividad_organizacion_internacional)

    @if ($actividad_organizacion_internacional->id%2  == 0)
    <div class="timeline-block timeline-block-right">
      @else
      <div class="timeline-block timeline-block-left">
        @endif
        <div class="timeline-marker timeline-color-blue"></div>
        <div class="timeline-content">
         <h3>{{ $actividad_organizacion_internacional->anio_inicio }}</h3>
         @if(is_null($actividad_organizacion_internacional->nombre_fuente_actividad))
         <span>{{ strip_tags(preg_replace('/&nbsp;/', ' ',$actividad_organizacion_internacional->descripcion_corta )) }}</span>
        @include('partials.fecha_actividad_internacionales')

         <p>{!! $actividad_organizacion_internacional->descripcion!!}</p>
         @else
         <span>{{ $actividad_organizacion_internacional->descripcion_corta }}</span>
        @include('partials.fecha_actividad_internacionales')

          <p>
            <span>Fuente: {{$actividad_organizacion_internacional->nombre_fuente_actividad}}</span> <br>  
          </p>
          <p>
            <span><a href="{{$actividad_organizacion_internacional->link_fuente_actividad}}">{{$actividad_organizacion_internacional->link_fuente_actividad}}</a></span>
          </p>
         @endif
       </div>
     </div>
     @endforeach

   </div>

 </div> 