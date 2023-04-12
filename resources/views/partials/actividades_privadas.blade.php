<div class="section ub-pl-20">
  <h5 class="center-align ub-text-bold fcd-custom-color">CARGOS EN EL SECTOR PRIVADO</h5>

  @if($actividad_privada->count() == 0)
  <p class="ub-mt-30 center-align ub-font-weight-600 font-16">No existen registros de cargos en el sector privado.</p>
  @endif

  <div class="timeline-container timeline-container-color-blue">
    @foreach ($actividad_privada as $actividad_privadas)

    @if ($actividad_privadas->id%2  == 0)
    <div class="timeline-block timeline-block-right">
      @else
      <div class="timeline-block timeline-block-left">
        @endif
        <div class="timeline-marker timeline-color-blue"></div>
        <div class="timeline-content">
         <h3>{{ $actividad_privadas->anio_inicio }}</h3>
         @if(is_null($actividad_privadas->nombre_fuente_actividad))
         <span>{{ strip_tags(preg_replace('/&nbsp;/', ' ',$actividad_privadas->descripcion_corta )) }}</span>
         @include('partials.fecha_actividad_privadas')
         <p>{!! $actividad_privadas->descripcion!!}</p>
         @else
         <span>{{ $actividad_privadas->descripcion_corta }}</span>
         @include('partials.fecha_actividad_privadas')
          <p>
            <span>Fuente: {{$actividad_privadas->nombre_fuente_actividad}}</span> <br>  
          </p>
          <p>
            <span><a href="{{$actividad_privadas->link_fuente_actividad}}">{{$actividad_privadas->link_fuente_actividad}}</a></span>
          </p>
         @endif
       </div>
     </div>
     @endforeach

   </div>

 </div> 