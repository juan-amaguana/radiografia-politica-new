<div class="section ub-pl-20">
  <h5 class="center-align ub-text-bold fcd-custom-color">ACTIVIDAD POLÍTICA</h5>

  @if($actividad_politica->count() == 0)
  <p class="ub-mt-30 center-align ub-font-weight-600 font-16">No existen registros de actividad política.</p>
  @endif

  <div class="timeline-container timeline-container-color-red">
    @foreach ($actividad_politica as $actividad_politicas)

    @if($actividad_politicas =='')
    <span>No se encuentra datos</span>

    @else
    @if ($actividad_politicas->id%2  == 0)
    <div class="timeline-block timeline-block-right">
      @else
      <div class="timeline-block timeline-block-left">
        @endif

        <div class="timeline-marker timeline-color-red"></div>
        <div class="timeline-content">
         <h3>{{ $actividad_politicas->anio_inicio }}</h3>
         @if(is_null($actividad_politicas->nombre_fuente_actividad))
         <span>{{ $actividad_politicas->descripcion_corta }}</span>
         @include('partials.fecha_actividad_politicas')
         <p>{{ strip_tags ($actividad_politicas->descripcion)}}</p>
         @else
         <span>{{ $actividad_politicas->descripcion_corta }}</span>
         @include('partials.fecha_actividad_politicas')
          <p>
            <span>Fuente: {{$actividad_politicas->nombre_fuente_actividad}}</span> <br>  
          </p>
          <p>
            <span><a href="{{$actividad_politicas->link_fuente_actividad}}">{{$actividad_politicas->link_fuente_actividad}}</a></span>
          </p>
         @endif
       </div>
     </div>
     @endif
     @endforeach

   </div>


 </div> 