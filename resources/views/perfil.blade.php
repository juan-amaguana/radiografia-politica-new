@extends('template.landing')

@section('meta_compartir')
<meta property="og:type" content="website" />
<meta property="og:title" content="{{ $perfil->nombres_persona.' '.$perfil->apellidos_persona }}" />

@if(isset($personasCargoActual))
<meta property="og:description" content='{{ strip_tags(preg_replace("/\r|\n/", " ",$personasCargoActual->descripcion_corta )) }}' />
@else
<meta property="og:description" content='Radiografía Política' />
@endif

<meta property="og:url" content="http://radiografiapolitica.org/perfil/{{$id_perfil}}" />
<meta property="og:site_name" content="Radiografía Política" />
<meta property="article:author" content="Fundación Ciudadanía y Desarrollo" />
<meta property="article:tag" content="webdev" />
<meta property="article:tag" content="webperf" />
<meta property="fb:app_id" content="483087469210148" />
<meta property="og:image" content="{{ $perfil->picture }}" />
<meta property="og:image:secure_url" content="{{ $perfil->picture }}" />

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f1757ce593baa5e"></script>

@endsection

@section('content')
<div id="fcd-rp-search-perfil" class="container container-search-box-perfil">


  <div class="section ub-p-no">
    <div class="row">

      <div class="ub-mb-15 col s11 ub-ocultar-web center-align">
        <a @click="mostrar_datos_principales ? mostrar_datos_principales = false : mostrar_datos_principales = true" class="btn trigger blue" href="#">Datos de Perfil</a>
        <a @click="mostrar_datos_principales ? mostrar_datos_principales = false : mostrar_datos_principales = true" class="btn trigger blue" href="#">Línea de tiempo</a>
      </div>

      <div class="fcd-datos-perfil-card col s11 m4 ub-perfil-background" :class="[ mostrar_datos_principales ? 'ub-mostrar-datos-perfil' : 'ub-ocultar-datos-perfil' ]">

        <div class="row">

          <div class="col s12 m12">
              @include('partials.imagen_persona')

              <div section="perfil-bienes" class="ub-padding-15">
                @include('partials.seccion_patrimonio')

              </div>
              <hr class="white" /> <br>
              <div section="perfil-antecedentes" style="display: none">
                @include('partials.seccion_antecedentes_penales')

              </div>
              <hr class="white" />
              <div section="perfil-bienes" class="ub-padding-15">

                @include('partials.seccion_sri')


                @include('partials.modal_sri')
                <hr>
              </div>

              <div section="perfil-estudios" class="ub-padding-15">

                @include('partials.seccion_estudios')
              </div>

              <hr class="white" />


              <div section="perfil-companias" class="ub-padding-15">
                  @include('partials.seccion_companias')

              </div>

          </div>
        </div>

      </div>

      <div class="fcd-linea-tiempo-perfil-card col s12 m8" :class="[ mostrar_datos_principales ? 'ub-ocultar-datos-perfil' : 'ub-mostrar-datos-perfil' ]">
        <div class="row ub-mb-1 ub-mt-50 ub-mr-20">
          <div class="col s12 grey lighten-3 fcd-custom-color ub-pt-10 ub-pb-10"><span class="font-35 ub-text-bold ub-ocultar-mobile " style="padding-left: 30px;">{{ $perfil->nombres_persona.' '.$perfil->apellidos_persona }}</span>
          <span class="font-20 ub-text-bold ub-ocultar-web" style="padding-left: 30px;">{{ $perfil->nombres_persona.' '.$perfil->apellidos_persona }}</span>
          </div>

        </div>
        <div class="row ub-pt-10 ub-pb-15 ub-pl-25 ub-mr-20">
          <div class="section ub-pl-20 ub-mb-15">
            <span class="grey-text text-darken-3 ub-text-bold font-15">Cargo público actual:</span>
            @if(isset($posicion_actual))
            <span class="font-15" style="color: #a4a4a4;">{{$posicion_actual->nombre_posicion}}</span>
            @else
            Sin registro
            @endif

              @if(!is_null($persona->imagen_partido_politico) && strlen($persona->imagen_partido_politico)>0)
              <br><span class="grey-text text-darken-3 ub-text-bold font-15">Partido Político:</span><br>
              <div class="row">
                <div class="col s12 m3 l3">
                  <img src="{{$persona->imagen_partido_politico}}" alt="" class="responsive-img ub-ocultar-mobile center-align" >
                </div>
              </div>
              @endif

              <br><span class="grey-text text-darken-3 ub-text-bold font-15">Partidos Políticos anteriores:</span>
              <div class="row">
                @if(isset($patidosAnteriores) && !empty($patidosAnteriores))
                  @foreach($patidosAnteriores as $partido_politico)
                  <div class="col s2 m2 l2">
                    <img src="{{$partido_politico->imagen_partido_politico}}" alt="" class="responsive-img ub-ocultar-mobile center-align" width="50px;">
                  </div>
                  @endforeach
                @else
                  <div class="col s2 m2 l2">
                  Sin registro
                  </div>
                @endif
              </div>

                @if(!is_null($perfil->facebook_persona)&&strlen($perfil->facebook_persona)>0||!is_null($perfil->twitter_persona)&&strlen($perfil->twitter_persona)>0)



                  <br><span class="grey-text text-darken-3 ub-text-bold font-15">Redes sociales :</span><br>
                  <div class="col s7 m7 l4   custom-html-widget" >

                  @if(!is_null($perfil->facebook_persona)&&strlen($perfil->facebook_persona)>0)
                  <a  href="{{$perfil->facebook_persona}}" ><img src="/images/front/btn_facebook.png" width="13%"  class="responsive-img "></a>
                  @endif
                  @if(!is_null($perfil->twitter_persona)&&strlen($perfil->twitter_persona)>0)
                  <a href="https://twitter.com/{{$perfil->twitter_persona}}" target="_blank" style="padding-left: 10px;"><img src="/images/front/btn_twitter.png" width="13%"  class="responsive-img "></a>
                  @endif
                </div><br>



              @endif

              <br><span class="grey-text text-darken-3 ub-text-bold font-15">Pensiones alimenticias adeudadas:</span>
              @if(isset($perfil->pensiones_alimenticias) && $perfil->pensiones_alimenticias !== 0 )
              <span class="font-20" style="color: #a4a4a4;"><b>Sí</b></span>
              @else
              <span class="font-20" style=""><b>No</b></span>
              @endif

              @if(isset($perfil->pensiones_alimenticias) && $perfil->pensiones_alimenticias !== 0 )
              <br><span class="grey-text text-darken-3 ub-text-bold font-15"><a href="{{$perfil->pensiones_alimenticias_fuente}}">Fuente de pensiones alimenticias</a></span>
              @endif

              <br><span class="grey-text text-darken-3 ub-text-bold font-8">Actualizado: {{ $perfil->	updated_at}}</span><br>




          </div>

          <hr>
          <?php
          $nombre_politico = $perfil->nombres_persona.' '.$perfil->apellidos_persona;
          if (strlen($perfil->descripcion_persona)>150) {
            $descripcion_politico = trim(substr(strip_tags(preg_replace($personasActual->descripcion_corta )), 0, 149));
            $descripcion_politico .= "...";
          }else{
            $descripcion_politico = $perfil->descripcion_persona;
          }

          $text = 'Conoce la línea de tiempo de '.$perfil->twitter_persona.' en #Radiografíapolítica'."\n".'http://157.245.128.41:8080/perfil/'.$perfil->id;
          $text = urlencode($text);
          $urlTweet = 'https://twitter.com/intent/tweet?text='.$text;
          ?>
          <div class="section ub-pl-20 ub-mb-15">

            <div class="row left-align ">
              <div class="col s12 m12 l8  custom-html-widget">



                  <div class="fcd-button-footer-perfil fcd-btn-persona">
                    <a href="/politico-detalle/{{$persona->id}}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">cloud_download</i>Excel</a>
                    <a href="/politico-detalle-csv/{{$persona->id}}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">cloud_download</i>CSV</a>
                    @if(!is_null($persona->curriculum_persona))
                    <a href="{{$persona->curriculum_persona}}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">cloud_download</i>Hoja de vida</a>
                    @endif

                    @if(isset($posicion_actual->url_legislativo))
                    <a href="{{$posicion_actual->url_legislativo}}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_forward</i>Gestión como asambleísta</a>
                    @endif

                    @if(!is_null($persona->plan_persona))
                    <a href="{{$persona->plan_persona}}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">cloud_download</i>Plan de Gobierno</a>
                    @endif
                  </div>

              </div>
              <div class="col s7 m7 l4   custom-html-widget" style="margin-top: 15px">
                <div class="col s2 addthis_inline_share_toolbox">

                </div>
                <div class="col s2">
                    <a href="{{$urlTweet}}" target="_blank" style="padding-left: 0px; max-width: 130px !important;"><img src="/images/front/btn_twitter.png"  class="responsive-img "style="max-width: 130% !important;"></a>
                </div>
                <div class="col s2">
                    <a href="#" target="_blank" style="vertical-align: super; color: #004a6c" ><span> <strong>COMPARTIR</strong></span> </a>
                </div>

              </div>

            </div>


          </div>


          <div class="input-field col s12">
            <select id="select-actividad" onchange="getTipoActividad()">
              <option value="todos">Cargos por orden cronológico</option>
              <option value="actividades categorisada">Cargos por sector</option>
            </select>
            <label>Tipo actividad</label>
          </div>
          <div id="detalle-actividades-todos">

            @include('partials.actividades_todas')
          </div>

          <div id="detalle-actividad-sector" style="display: none">
            @include('partials.actividades_publicas')
            <div class="divider"></div>
            @include('partials.actividades_privadas')
            <div class="divider"></div>
            @include('partials.actividad_politica')
            

            {{-- @if(count($actividades_organicacion_civil)>0)
            <div class="divider"></div>
            @include('partials.fecha_actividad_organizacionales')
            @endif --}}

            @if(count($actividades_organicacion_internacional)>0)
            <div class="divider"></div>
            @include('partials.actividades_organizacion_internacional')
            @endif

          </div>





        </div>
      </div>

    </div>
  </div>

</div>
<div id="fcd-rp-search" :action="'{{ url('/') }}'">
  <div class="section perfiles-politicos " >
    <div class="row ">

      <div class="container light slogan">
        <div class="textwidget custom-html-widget">
          <h1 style="color: #fff;margin: 0;">Perfiles más visitados</h1>
          <h2 style="color: #fff ;margin: 0 0 40px 0;" >Mira los perfiles más visitados del portal</h2>
        </div>

      </div>
      <hr> <br>
        <div class="col  l1 hide-on-med-and-down"></div>
        <div class=" col s4 m3 l2 center-align" v-for="perfil in most_visited" v-if="perfil.picture !== null" >
        <div class="imagen-perfil-circle">
          <a :href="'/perfil/' + perfil.id" ><img :src="perfil.picture" class="circle responsive-img hoverable amber ub-padding-2" width="80%"></a>
        <div class="imagen-perfil-circle-overlay"><div class="imagen-perfil-circle-text"><a class="link-no-style" :href="'/perfil/' + perfil.id">Ver perfil</a></div></div><br>
        </div>

        <span class="search-card-text-1 card-title activator white-text text-darken-4">@{{ perfil.nombres_persona + ' ' + perfil.apellidos_persona }}</span>
      </div>





    </div>
  </div>
</div>
@endsection

@section('footer_scripts')
<script src="{{ url('/js/app_main.js') }}"></script>
<script src="{{ url('/js/app_perfil.js') }}"></script>
<script src="/js/perfil/carga_actividades_perfil.js"></script>
<script type="text/javascript" src="//connect.facebook.net/en_US/sdk.js"></script>
<script src="//platform.twitter.com/widgets.js"></script>

<script>

  $(document).ready(function() {
    FB.init({
      appId      : '483087469210148',
      xfbml      : true,
      version    : 'v5.0'
    });
    FB.AppEvents.logPageView();
  });
</script>
@if(isset($posicion_actual))
<script>


$( ".shareBtn" ).click(function() {

  FB.ui({
    method: 'share_open_graph',
    action_type: 'og.shares',
    action_properties: JSON.stringify({
        object : {

           'og:type': 'website',
           'og:title': '{{ $perfil->nombres_persona.' '.$perfil->apellidos_persona }}',
           'og:description': '{{$posicion_actual->nombre_posicion}}',
           'og:url': 'http://157.245.128.41:8080/perfil/{{$id_perfil}}',
           'og:site_name': 'Radiografía Política',
           'article:author': 'Fundación Ciudadanía y Desarrollo',
           'article:tag': 'webdev',
           'article:tag': 'webperf',
           'fb:app_id': '483087469210148',
           'og:image': '{{ $perfil->picture }}',
           'og:image:secure_url': '{{ $perfil->picture }}',



        }
    })
    },
    // callback
    function(response) {});
});
</script>
@else
<script>


$( ".shareBtn" ).click(function() {

  FB.ui({
    method: 'share_open_graph',
    action_type: 'og.shares',
    action_properties: JSON.stringify({
        object : {

           'og:type': 'website',
           'og:title': '{{ $perfil->nombres_persona.' '.$perfil->apellidos_persona }}',
           'og:description': 'Radiografía Política',
           'og:url': 'http://157.245.128.41:8080/perfil/{{$id_perfil}}',
           'og:site_name': 'Radiografía Política',
           'article:author': 'Fundación Ciudadanía y Desarrollo',
           'article:tag': 'webdev',
           'article:tag': 'webperf',
           'fb:app_id': '483087469210148',
           'og:image': '{{ $perfil->picture }}',
           'og:image:secure_url': '{{ $perfil->picture }}',



        }
    })
    },
    // callback
    function(response) {});
});
</script>
@endif


@endsection

