<div class="row">
  <div class="col s5 m9 right-align">
    <img class="responsive-img ub-ocultar-mobile circle center-align" src="{{ url("images/home.png") }}" alt="" width="70%">
    <img class="responsive-img ub-ocultar-web circle center-align" src="{{ url("images/home.png") }}" alt="" width="50%">
  </div>
  <div class="col s12 m9 center-align">
    <li for="" class="ub-remove-li-points ub-perfil-titulo-section ub-font-weight-100 font-16">Declaración de Bienes</li>
    <li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-text-bold font-20"></li>
  </div>
  @if($patrimonio && $patrimonio->publicar !== "ND")
  <div class="col m6 right-align">
    <li for="" class="ub-remove-li-points ub-perfil-campo-section ub-font-weight-100 font-16">Activos:</li>
    <li for="" class="ub-remove-li-points ub-perfil-campo-section ub-font-weight-100 font-16">Pasivos:</li>
    <li for="" class="ub-remove-li-points ub-perfil-campo-section ub-font-weight-100 font-16">Patrimonio:</li>
    <li for="" class="ub-remove-li-points ub-perfil-campo-section ub-font-weight-100 font-16">Inmuebles:</li>
    <li for="" class="ub-remove-li-points ub-perfil-campo-section ub-font-weight-100 font-16">Vehículos:</li>
  </div>
  <div class="col m6 left-align">
    <li for="" class="ub-remove-li-points ub-perfil-data-section ub-text-bold font-16">
      @if(!is_null($patrimonio))
      ${{number_format($patrimonio->activos,2,",",".")  }}
      @else
      No existen datos
      @endif
    </li>

    <li for="" class="ub-remove-li-points ub-perfil-data-section ub-text-bold font-16">

      @if(!is_null($patrimonio))
      ${{number_format($patrimonio->pasivos,2,",",".") }}
      @else
      No existen datos
      @endif
    </li>
    <li for="" class="ub-remove-li-points ub-perfil-data-section ub-text-bold font-16">

      @if(!is_null($patrimonio))
      $ {{number_format($patrimonio->patrimonio,2,",",".")  }}
      @else
      No existen datos
      @endif
    </li>
    <li for="" class="ub-remove-li-points ub-perfil-data-section ub-text-bold font-16">
      @if(!is_null($patrimonio) &&  $patrimonio->numero_casas)
      {{ $patrimonio->numero_casas }}
      @else
      No existen datos
      @endif
    </li>
    <li for="" class="ub-remove-li-points ub-perfil-data-section ub-text-bold font-16">
      @if(!is_null($patrimonio) &&  $patrimonio->numero_carros)
      {{ $patrimonio->numero_carros }}
      @else
      No existen datos
      @endif
    </li>
  </div>
  @else
  <div class="col m6 left-align" >
    No existen datos
  </div>
  @endif
  <?php
$nombre_politico_patrimonio = $perfil->nombres_persona . ' ' . $perfil->apellidos_persona;

if (!is_null($patrimonio)) {
    $descripcion_patrimonio = 'Activos: ' . $patrimonio->activos . "\n" . 'Pasivos: ' . $patrimonio->pasivos . "\n" . 'Patrimonio: ' . $patrimonio->patrimonio;
} else {
    $descripcion_patrimonio = 'Activos: No existen datos \n Pasivos: No existen datos \n' . 'Patrimonio: No existen datos ';
}

$text_patrimonio = 'Cómo ha evolucionado el patrimonio de ' . $perfil->twitter_persona . " en los últimos años? Mira su declaración en Radiografía " . "\n" . $descripcion_patrimonio . "\n" . 'http://157.245.128.41:8080/perfil/' . $perfil->id;

$url_tweet_patrimonio = 'https://twitter.com/intent/tweet?text=' . $text_patrimonio;
?>
  <div class="row">
    <div class="col s12 m12 l8 botones-archivos-perfil" >
      <div class="fcd-button-footer-perfil fcd-btn-archivo">
        @if(!is_null($patrimonio))
        <a href="{{$patrimonio->url_patrimonio}}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_forward</i>Fuente</a>
        @else
        <a href="" class="waves-effect waves-light btn"><i class="material-icons right">arrow_forward</i>Fuente</a>
        @endif

        @if(!is_null($patrimonio))
        <a href="{{$patrimonio->nombre_archivo_patrimonio1}}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">cloud_download</i>Archivo</a>
        @else
        <a href="" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">cloud_download</i>Archivo</a>
        @endif


      </div>
    </div>
    <div  class="botones-redes-sociales-perfil valign-wrapper col s12 m12 l4">
      <div class="custom-html-widget" style="margin-top: 15px">
        <span></span>
        <a href="{{$url_tweet_patrimonio}}" target="_blank" style="padding-left: 10px"><img src="/images/front/btn_twitter_gray_light.png" width="25%"  class="responsive-img "></a>
        <a href="#" target="_blank" class="text-button-compartir" ><span> <strong>COMPARTIR</strong></span> </a>
      </div>
    </div>
  </div>
  <div  style="display: none;" class="botones-redes-sociales-perfil-2 valign-wrapper col s12 m12">
    <div class="  custom-html-widget">

      <a href="{{$url_tweet_patrimonio}}" target="_blank" style="padding-left: 10px"><img src="/images/front/btn_twitter_gray_light.png" width="10%"  class="responsive-img "></a>

      <a href="#" target="_blank" class="text-button-compartir" ><span> <strong>COMPARTIR</strong></span> </a>
    </div>
  </div>

</div>