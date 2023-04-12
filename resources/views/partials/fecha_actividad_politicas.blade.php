  <!-- Modal Structure -->
<p>
  @if(!is_null($actividad_politicas->anio_inicio)&&!is_null($actividad_politicas->anio_fin))
    {{$actividad_politicas->anio_inicio}}-{{$actividad_politicas->anio_fin}}
  @else
    @if(!is_null($actividad_politicas->anio_inicio)&&is_null($actividad_politicas->anio_fin))
        {{$actividad_politicas->anio_inicio}}
    @endif
  @endif
</p>