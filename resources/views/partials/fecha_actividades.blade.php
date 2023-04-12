  <!-- Modal Structure -->
<p>
  @if(!is_null($actividad_persona->anio_inicio)&&!is_null($actividad_persona->anio_fin))
    {{$actividad_persona->anio_inicio}}-{{$actividad_persona->anio_fin}}
  @else
    @if(!is_null($actividad_persona->anio_inicio)&&is_null($actividad_persona->anio_fin))
        {{$actividad_persona->anio_inicio}}
    @endif
  @endif
</p>