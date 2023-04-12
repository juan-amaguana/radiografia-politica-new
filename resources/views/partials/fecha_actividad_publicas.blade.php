  <!-- Modal Structure -->
<p>
  @if(!is_null($actividades_publicas->anio_inicio)&&!is_null($actividades_publicas->anio_fin))
    {{$actividades_publicas->anio_inicio}}-{{$actividades_publicas->anio_fin}}
  @else
    @if(!is_null($actividades_publicas->anio_inicio)&&is_null($actividades_publicas->anio_fin))
        {{$actividades_publicas->anio_inicio}}
    @endif
  @endif
</p>