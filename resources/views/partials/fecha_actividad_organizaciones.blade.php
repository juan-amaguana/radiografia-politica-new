  <!-- Modal Structure -->
<p>
  @if(!is_null($actividad_organizacion_civil->anio_inicio)&&!is_null($actividad_organizacion_civil->anio_fin))
    {{$actividad_organizacion_civil->anio_inicio}}-{{$actividad_organizacion_civil->anio_fin}}
  @else
    @if(!is_null($actividad_organizacion_civil->anio_inicio)&&is_null($actividad_organizacion_civil->anio_fin))
        {{$actividad_organizacion_civil->anio_inicio}}
    @endif
  @endif
</p>