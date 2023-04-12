<div class="row ub-perfil-justice-section">
	@if($perfil->antecedentes_penales==0)
	<div class="col s10 m12 center-align ub-perfil-legal-background-image center-align ub-ocultar-mobile">
		<br><br>
		<li for="" class="ub-remove-li-points ub-perfil-titulo-section ub-font-weight-100 font-20">Antecedentes<br>Penales:</li>
		<li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-text-bold font-40">NO</li>
	</div>
	<div class="col s10 center-align ub-perfil-legal center-align ub-ocultar-web">
		<li for="" class="ub-remove-li-points ub-perfil-titulo-section ub-font-weight-100 font-15">Antecedentes Penales:</li>
		<li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-text-bold font-30">NO</li>
	</div>
	@else
	<div class="col s10 m12 center-align ub-perfil-legal-background-image center-align ub-ocultar-mobile">
		<br><br>
		<li for="" class="ub-remove-li-points ub-perfil-titulo-section ub-font-weight-100 font-20">Antecedentes<br>Penales:</li>
		<li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-text-bold font-40">SI</li>
	</div>
	<div class="col s10 center-align ub-perfil-legal center-align ub-ocultar-web">
		<li for="" class="ub-remove-li-points ub-perfil-titulo-section ub-font-weight-100 font-15">Antecedentes Penales:</li>
		<li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-text-bold font-30">SI</li>
	</div>
	@endif



</div>

<div class="row" >
	<div class="col s12 m12 l8 botones-archivos-perfil" >
		<div class="fcd-button-footer-perfil fcd-btn-archivo">
			@if(!is_null($perfil->url_penal)&&strlen($perfil->url_penal)>5)
			<a href="{{$perfil->url_penal}}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_forward</i>Fuente</a>
			@endif
			@if(!is_null($perfil) && !is_null($perfil->nombre_archivo_penal))
			<a href="{{$perfil->nombre_archivo_penal}}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">cloud_download</i>Archivo</a>
			@else
			<a href="" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">cloud_download</i>Archivo</a>
			@endif
		</div>
	</div>

</div>
