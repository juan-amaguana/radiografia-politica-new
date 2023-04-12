<div class="row">
  <div class="col s4 m3 center-align">
    <img class="responsive-img circle center-align" src="{{ url("images/education.png") }}" alt="" width="80%">
  </div>
  <div class="col s12 m9">
    <li for="" class="ub-remove-li-points ub-perfil-titulo-section ub-text-bold font-25">

      @if(!is_null($estudios))
      {{ $estudios->profesion_estudio }}
      @else
      No existe datos
      @endif
    </li>
    <li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-font-weight-100 font-16"><strong>
      @if(!is_null($estudios))
      {{ $estudios->pregrado_estudio }}
      @else
      No existe datos
      @endif </strong>Títulos Universitario</li>
    <li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-font-weight-100 font-16"><strong>
    @if(!is_null($estudios))
      {{ $estudios->posgrado_estudio }}
      @else
      No existe datos
      @endif
    </strong>Títulos de cuarto nivel</li>
    <li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-font-weight-100 font-16"><strong>{{ $estudios->phd_estudio }} </strong>PhD</li>
  </div>
  <?php
$nombre_politico_estudios = $perfil->nombres_persona . ' ' . $perfil->apellidos_persona;
if (!is_null($estudios)) {
    $profesion_estudio         = (int) $estudios->profesion_estudio;
    $estudios_pregrado_estudio = (int) $estudios->pregrado_estudio;
    $estudios_posgrado_estudio = (int) $estudios->posgrado_estudio;
    $estudios_phd_estudio      = (int) $estudios->phd_estudio;

    $tot_estudios = $profesion_estudio + $estudios_pregrado_estudio + $estudios_posgrado_estudio + $estudios_phd_estudio;
} else {
    $tot_estudios = 'No existe datos';
}

$text_estudios    = 'Sabías que ' . $perfil->twitter_persona . ' tiene ' . $tot_estudios . ' títulos registrados en @SENESCYT? Conoce más sobre su formación en Radiografía ' . 'http://157.245.128.41:8080/perfil/' . $perfil->id;
$text_estudios    = urlencode($text_estudios);
$url_tweet_studio = 'https://twitter.com/intent/tweet?text=' . $text_estudios;
?>


  <div class="row">
      <div class="col s12 m12 l8 botones-archivos-perfil" >
        <div class="fcd-button-footer-perfil fcd-btn-archivo">
          <a href="{{ $estudios->url_estudio }}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_forward</i>Fuente</a>
          <a href="{{ $estudios->nombre_archivo_estudio }}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">cloud_download</i>Archivo</a>
        </div>
      </div>
      <div  class="botones-redes-sociales-perfil valign-wrapper col s12 m12 l4">
        <div class="custom-html-widget" style="margin-top: 15px">

          <a href="{{$url_tweet_studio}}" target="_blank" style="padding-left: 10px"><img src="/images/front/btn_twitter_gray_light.png" width="25%"  class="responsive-img "></a>
          <a href="#" target="_blank" class="text-button-compartir" ><span> <strong>COMPARTIR</strong></span> </a>

        </div>
      </div>
    </div>
    <div  style="display: none;" class="botones-redes-sociales-perfil-2 valign-wrapper col s12 m12">
      <div class="  custom-html-widget">
        <a href="{{$url_tweet_studio}}" target="_blank" style="padding-left: 10px"><img src="/images/front/btn_twitter_gray_light.png" width="10%"  class="responsive-img "></a>
        <a href="#" target="_blank" class="text-button-compartir" ><span> <strong>COMPARTIR</strong></span> </a>
      </div>
    </div>
</div>