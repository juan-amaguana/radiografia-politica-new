@if(isset($sri_renta))
<div class="row">
	<div class="col s4 m3 center-align">
		<img class="responsive-img circle center-align ub-ocultar-mobile" src="{{ url("images/money.png") }}" alt="" width="80%">
		<img class="responsive-img circle center-align ub-ocultar-web" src="{{ url("images/money.png") }}" alt="" width="50%">
	</div>

	<div class="col s12 m9">
		<li for="" class="ub-remove-li-points ub-perfil-titulo-section ub-font-weight-100 font-16">Impuesto a la renta :
			@if(!is_null($sri_renta))
			{{ $sri_renta->anio_sri }}
			@else
			No existe datos
			@endif


		</li>
		<li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-text-bold font-25">



			@if($sri_renta->declaracion == 2)
				$ {{ number_format($sri_renta->valor_impuesto_sri,2,",",".") }}
			@else
				<span class="font-13">Declaración no presentada</span>
			@endif
		</li>
		<li class="ub-remove-li-points ub-perfil-titulo-section ub-font-weight-100 font-16"><a class="modal-trigger text-yellow-fcd"  href="#modal1">+ ver mas detalle</a></li>
	</div>

</div>
@endif
<div class="row">
	<div class="col s4 m3 center-align">
		<img class="responsive-img circle center-align ub-ocultar-web" src="{{ url("images/capital_increase.png") }}" alt="" width="50%">
		<img class="responsive-img circle center-align ub-ocultar-mobile" src="{{ url("images/capital_increase.png") }}" alt="" width="80%">
	</div>

	<div class="col s12 m9">
		<li for="" class="ub-remove-li-points ub-perfil-titulo-section ub-font-weight-100 font-16">Impuesto a la Salida de<br>Divisas :

			@if(!is_null($sri_divisas))
			{{ $sri_divisas->anio_sri }}
			@else
			No existe datos
			@endif
		</li>
		<li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-text-bold font-25">



			@if($sri_divisas->declaracion == 2)
				$ {{ number_format($sri_divisas->valor_impuesto_sri,2,",",".") }}
			@else
				<span class="font-13">Declaración no presentada</span>
			@endif
		</li>
			<li class="ub-remove-li-points ub-perfil-titulo-section ub-font-weight-100 font-16"><a class="modal-trigger text-yellow-fcd" href="#modal2">+ ver mas detalle</a></li>
		</div>
		@if(isset($sri_renta))
		<?php
$nombre_politico_sri = $perfil->nombres_persona . ' ' . $perfil->apellidos_persona;
if ($sri_renta->declaracion == 2) {
    $descripcion_sri = number_format($sri_renta->valor_impuesto_sri, 2, ",", ".");
} else {
    $descripcion_sri = 'Sin declaración';
}

$text_sri      = 'Sabías que ' . $perfil->twitter_persona . ' pagó ' . $descripcion_sri . ' por impuesto a la renta el año pasado? Mira más en Radiografía Política ' . 'http://157.245.128.41:8080/perfil/' . $perfil->id;
$text_sri      = urlencode($text_sri);
$url_tweet_sri = 'https://twitter.com/intent/tweet?text=' . $text_sri;
?>


		<div class="row">
			<div class="col s12 m12 l8 botones-archivos-perfil" >
				<div class="fcd-button-footer-perfil fcd-btn-archivo">
					<a href="{{ $sri_renta->url_sri }}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_forward</i>Fuente</a>
					<a href="{{ $sri_renta->nombre_archivo_sri }}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">cloud_download</i>Archivo</a>
				</div>
			</div>
			<div  class="botones-redes-sociales-perfil valign-wrapper col s12 m12 l4">
				<div class="custom-html-widget" style="margin-top: 15px">

					<a href="{{$url_tweet_sri}}"  target="_blank" style="padding-left: 10px"><img src="/images/front/btn_twitter_gray_light.png" width="25%"  class="responsive-img "></a>
					<a href="#" target="_blank" class="text-button-compartir" ><span> <strong>COMPARTIR</strong></span> </a>
				</div>
			</div>
		</div>
		<div  style="display: none;" class="botones-redes-sociales-perfil-2 valign-wrapper col s12 m12">
			<div class="  custom-html-widget">
				<a href="#" class="shareBtn" target="_blank"><img src="/images/front/btn_facebook_gray_light.png" width="10%"  class="responsive-img "></a>
				<a href="{{$url_tweet_sri}}" target="_blank" style="padding-left: 10px"><img src="/images/front/btn_twitter_gray_light.png" width="10%"  class="responsive-img "></a>
			</div>
		</div>
		@endif
</div>