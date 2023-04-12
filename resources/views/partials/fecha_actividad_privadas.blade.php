  <!-- Modal Structure -->
<p>
  @if(!is_null($actividad_privadas->anio_inicio)&&!is_null($actividad_privadas->anio_fin))
    {{$actividad_privadas->anio_inicio}}-{{$actividad_privadas->anio_fin}}
  @else
    @if(!is_null($actividad_privadas->anio_inicio)&&is_null($actividad_privadas->anio_fin))
        {{$actividad_privadas->anio_inicio}}
    @endif
  @endif
</p>