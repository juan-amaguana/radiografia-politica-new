@extends('template.landing')

@section('nav_extras')
<div class="slider ub-ocultar-mobile">
  <ul class="slides">
    <li>
      <img src="/img/slider/slider-2.jpg"> 
      <div class="caption center-align">

      </div>
    </li>
    {{-- <li>
      <img src="/img/slider/2.jpg">
      <div class="caption right-align">
        <h3>Utiliza nuestro buscador</h3>
        <h5 class="light grey-text text-lighten-3">para encontrar un perfil específico.</h5>
      </div>
    </li> --}}
  </ul>
</div>
@endsection

@section('content')
<div class="center-align boton-pulse hide-on-small-only">
  <a class="btn-floating pulse " id="scroll-data" ><i class="material-icons">arrow_downward</i></a>  
</div>



 
<div id="fcd-rp-search" :action="'{{ url('/') }}'">
<div class="container  container-search-box">

  <div class="section">

    <form action="#" method="post" @submit.prevent="onSubmit" :action="action">

      <div class="row">

        <template id="perfil-politico">

        <div class="col s12 m12 l3">

            <ul id="opciones-filtrado" class="sidenav collapsible expandable remove_border filtros-busqueda">

            <li class="ub-ocultar-web">
              <div class="user-view">
                <div class="background blue side-nav-custom">Filtrar Perfiles</div>
              </div>
            </li>

            <!-- <a class='dropdown-trigger btn-small ub-custom-search-order blue' href='#' data-target='dropdown1'>Descargar Datos</a>
            <ul id='dropdown1' class='dropdown-content'>
              <li><a href="#!">CSV</a></li>
              <li><a href="#!">Excel</a></li>
              <li><a href="#!">Json</a></li>
            </ul> -->

              <br /><br />

              <!-- <div class="row">
                <div class="col s4"><p class="blue-text text-darken-1 waves-effect waves-light" @click="opensearchtabs"><i class="ub-icons-material material-icons">insert_chart</i> Abrir</p></div>
                <div class="col s4"><p class="blue-text text-darken-1 waves-effect waves-light" @click="closesearchtabs"><i class="ub-icons-material material-icons">clear_all</i> Cerrar</p></div>
              </div> -->


              <!-- <li>
                <div class="collapsible-header">Género<i class="caret material-icons">keyboard_arrow_down</i></div>
                <div class="collapsible-body">
                  <p><label><input type="checkbox" class="filled-in"/><span>Masculino</span></label></p>
                  <p><label><input type="checkbox" class="filled-in"/><span>Femenino</span></label></p>
                </div>
              </li> -->
              <!-- <li>
                <div class="collapsible-header">Categoría<i class="caret material-icons">keyboard_arrow_down</i></div>
                <div class="collapsible-body">
                  <p><label><input type="checkbox" class="filled-in"/><span>Trasnparencia</span></label></p>
                  <p><label><input type="checkbox" class="filled-in"/><span>Participación Ciudadana</span></label></p>
                  <p><label><input type="checkbox" class="filled-in"/><span>Justicia</span></label></p>
                  <span class="blue-text text-darken-1 text-view-more">+ Ver más</span>
                </div>
              </li> -->
              <li class="ub-pl-20 ub-pr-20">
                <div class="collapsible-header">Función del Estado<i class="caret material-icons">keyboard_arrow_down</i></div>
                <div class="collapsible-body">

                  <p><label><input type="checkbox" class="filled-in" v-on:change="show_data()" :value="2" v-model="checkedFuncionEstado" /><span>Ejecutivo</span></label></p>
                  <p><label><input type="checkbox" class="filled-in" :value="1" v-model="checkedFuncionEstado"  v-on:change="show_data();activate_option_legislativo($event)"/><span>Legislativo</span></label></p>
                  <p><label><input type="checkbox" class="filled-in" v-on:change="show_data()" :value="3" v-model="checkedFuncionEstado" /><span>Judicial</span></label></p>
                  <p><label><input type="checkbox" class="filled-in" v-on:change="show_data()" :value="4" v-model="checkedFuncionEstado" /><span>Transparencia y Control Social</span></label></p>
                  <p><label><input type="checkbox" class="filled-in" v-on:change="show_data()" :value="5" v-model="checkedFuncionEstado" /><span>Electoral</span></label></p>

                </div>
              </li>
              <li class="animated fadeInLeft faster ub-pl-20 ub-pr-20" :class="[ funcion_legislativa ? 'ub-mostrar' : 'ub-ocultar' ]">
                <div class="collapsible-header">Partido<i class="caret material-icons">keyboard_arrow_down</i></div>
                <div class="collapsible-body">

                  <p v-for="partido in (vermas_partidos ? partidos_politicos : partidos_politicos.slice(0, 7))" v-if="partido !== null"><label><input type="checkbox" class="partidos_checkbox filled-in" v-on:change="show_data()" :value="partido" v-model="checkedPartidos"/><span>@{{ partido }}</span></label></p>
                  <span class="blue-text text-darken-1 text-view-more" @click="vermas_partidos ? vermas_partidos = false : vermas_partidos = true">@{{ vermas_partidos ? "- Ver menos" : "+ Ver más" }}</span>

                </div>
              </li>
              <li class="ub-pl-20 ub-pr-20">
                <div class="collapsible-header">Otras Instituciones<i class="caret material-icons">keyboard_arrow_down</i></div>
                <div class="collapsible-body">

                  <p><label><input type="checkbox" class="filled-in" v-on:change="show_data()" :value="6" v-model="checkedInstitucion" /><span>Procuraduría General del Estado</span></label></p>
                  <p><label><input type="checkbox" class="filled-in" v-on:change="show_data()" :value="7" v-model="checkedInstitucion" /><span>Corte Constitucional</span></label></p>

                </div>
              </li>
              <li class="ub-pl-20 ub-pr-20">
                <div class="collapsible-header">Cargo<i class="caret material-icons">keyboard_arrow_down</i></div>
                <div class="collapsible-body">

                  <p v-for="cargo in (vermas_cargos_politicos ? cargos_politicos : cargos_politicos.slice(0, 7))" v-if="cargo !== null"><label><input type="checkbox" class="cargos_checkbox filled-in" v-on:change="show_data()" :value="cargo" v-model="checkedCargos"/><span>@{{ cargo }}</span></label></p>
                  <span class="blue-text text-darken-1 text-view-more" @click="vermas_cargos_politicos ? vermas_cargos_politicos = false : vermas_cargos_politicos = true">@{{ vermas_cargos_politicos ? "- Ver menos" : "+ Ver más" }}</span>

                </div>
              </li>
              <li class="ub-pl-20 ub-pr-20">
                <div class="collapsible-header">Categoría<i class="caret material-icons">keyboard_arrow_down</i></div>
                <div class="collapsible-body">
                  <p><label><input type="checkbox" class="filled-in" v-on:change="show_data()" :value="1" v-model="checkedEstadoPolitico" /><span>Funcionario</span></label></p>
                  <p><label><input type="checkbox" class="filled-in" v-on:change="show_data()" :value="2" v-model="checkedEstadoPolitico" /><span>Postulante</span></label></p>
                  <p><label><input type="checkbox" class="filled-in" v-on:change="show_data()" :value="3" v-model="checkedEstadoPolitico" /><span>Candidato</span></label></p>
                </div>
              </li>
            </ul>

        </div>

        <div class="col s12 m12 l9 search-box">

          <div id="div-card-politicos"  class="row section scrollspy">

            <div class="input-field col s12 m12 l10 xl10">
              <div class="input-field col s12">
                <i class="search-icon material-icons prefix"><img src="/images/front/btn_icono_busqueda.png" width="70%" alt=""></i>
                <div class="chips chips-placeholder input-field-custom-1"></div>
              </div>
              <!-- <input v-model="buscar" id="buscar" type="text" class="validate" @input="show_data()">
              <label for="buscar">Buscar</label> -->
            </div>

            <div class="input-field col m2 l2 xl2 ub-custom-height-3 valign-wrapper center-align ub-ocultar-mobile">

              <a class='dropdown-trigger ub-custom-search-order boton-ordenar'  data-target='dropdown2'><img src="/images/front/btn_ordernar.png" width="100%" alt=""></a>
              <ul id='dropdown2' class='dropdown-content'>
                <li><a @click="search_order = 'asc'; show_data()">A-Z</a></li>
                <li><a @click="search_order = 'desc'; show_data()">Z-A</a></li>
               <!--<li><a @click="search_order = 'cargo'; show_data()">Cargo</a></li>-->
              </ul>
            </div>

          </div>

          <div class="row">
            <div class="col s9 search-box-align-center">
              <span class="ub-font-weight-500 font-16">Resultados Encontrados: <strong class="orange-text ub-font-weight-600 font-22">@{{ total_records }}</strong></span><br>
              <label :class="[ total_records != 0 ? 'ub-mostrar' : 'ub-ocultar' ]" class="ub-font-weight-400 font-14">Total: @{{ total_pages }} páginas</label><br />
            </div>
            <div class="col s3">
              <select v-model="number_page_results" @change="current_page = 1; show_data()">
                <option :value = "10" selected>10</option>
                <option :value = "25">25</option>
                <option :value = "50">50</option>
                <option :value = "75">75</option>
                <option :value = "100">100</option>
                <option :value = "'todos'">Todos</option>
              </select>
            </div>
          </div>

          <!-- Preloader -->
          <!-- <div class="progress" :class="[ loading_search ? 'ub-mostrar' : 'ub-ocultar' ]"><div class="indeterminate"></div></div> -->
          <div class="preloader-background" :class="[ loading_search ? 'ub-mostrar-preloader' : 'ub-ocultar-preloader' ]">
            <div class="preloader-wrapper big active">
              <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>

              <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>

              <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>

              <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>
            </div>
            <p class="blinking">Cargando Perfiles...</p>
          </div>

          <div class="row">
            <div class="col s12 resultados-search-box">

              <!-- <div class="icon-preview col s1 m1 ub-ocultar-mobile" @click="cuadricula_search_view = true; lineal_search_view = false"><i class="material-icons dp48 waves-effect">view_comfy</i></div>
              <div class="icon-preview col s1 m1 ub-ocultar-mobile" @click="cuadricula_search_view = false; lineal_search_view = true"><i class="material-icons dp48 waves-effect">view_headline</i></div> -->

              <ul id="search_pagination" class="pagination">
                <li v-for="search_page in search_pages" v-bind:class="search_page.list_class"><a @click="show_data(search_page.action)" v-html="search_page.text"></a></li>
              </ul>

                <div  class="row" :class="[ cuadricula_search_view ? 'ub-mostrar' : 'ub-ocultar' ]">
                  <div class="col s6 m4 l4 xl3 animated zoomIn fast" v-for="perfil in display_records">
                    <div class="card sticky-action" style="overflow: visible; height: 370px">
                      <div class="imagen-perfil-card card-image waves-effect waves-block waves-light" v-on:click="ver_perfil(perfil.id)" >
                        <img v-if="perfil.picture !== null" class="responsive-img" :src="perfil.picture" alt="">
                        <img v-else class="responsive-img" src="http://icons.iconarchive.com/icons/paomedia/small-n-flat/512/user-male-icon.png" alt="">
                        <div class="imagen-perfil-card-overlay"><div class="imagen-perfil-card-text">Ver perfil</div></div>
                      </div>
                      <a :href="'/perfil/' + perfil.id" class="white-text">
                      <div class="card-content ub-custom-card-content">
                        <span class="search-card-text-1 card-title activator grey-text text-darken-4">@{{ perfil.name + ' ' + perfil.lastname }}</span>
                        <!-- <span class="search-card-text-2 ub-card-title ub-ocultar-mobile">Partido político: </span>@{{ perfil.partido }}<br> -->
                      </div>
                      <div class="card-action" >
                        

                          <ul class="valign-wrapper" >
                            <li style="width: 77%; text-align: left;"><span>Ver perfil</span></li>
                            <li style="width: 18%; border-left: 2px solid #fff; "><span class="valign-wrapper"><i class="material-icons dp48">arrow_forward</i></span></li>

                          </ul>

                        

                      </div>
                      </a>
                    </div>
                  </div>
                </div>


                <!-- No Results -->
                <div class="ub-font-weight-600" :class="[ no_results ? 'ub-mostrar' : 'ub-ocultar' ]">
                  <div class="font-20 col s12 center-align">
                    No se encontraron resultados
                  </div>
                </div>

                <!-- <div class="row" :class="[ lineal_search_view ? 'ub-mostrar' : 'ub-ocultar' ]">
                  <div class="col s12 m12 animated zoomIn fast" v-for="perfil in display_records">
                    <div class="card small horizontal ub-card-perfil-custom ">
                      <div class="card-image ub-card-image-custom">

                        <a v-if="perfil.picture !== null" href="#"><img class="responsive-img ub-props-image-1" :src="perfil.picture" alt=""></a>
                        <a v-else href="#"><img class="responsive-img ub-props-image-1" src="http://icons.iconarchive.com/icons/paomedia/small-n-flat/512/user-male-icon.png" alt=""></a>

                      </div>
                      <div class="card-stacked">
                        <div class="card-content ub-card-contents">
                          <span class="ub-card-title">Nombre completo: </span>@{{ perfil.name + ' ' + perfil.lastname }}<br>
                          <span class="ub-card-title">Partido político: </span>@{{ perfil.partido }}<br>
                          <i class="fa fa-twitter ub-card-icon"></i>@{{ perfil.twitter }}
                          <i class="fa fa-facebook ub-card-icon ub-push-10px"></i>@{{ perfil.facebook }}<br>
                          <i class="fa fa-paperclip ub-card-icon"></i><span class="ub-card-title">Descargar currículum</span><br>
                          <span v-if="perfil.description !== null && perfil.description !== ''"><span class="ub-card-title">Descripción:</span><div v-html="perfil.description"></div></span><br>
                          <a :href="'/perfil/' + perfil.id">Ver perfil</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->

                <label :class="[ total_records != 0 ? 'ub-mostrar' : 'ub-ocultar' ]" class="right ub-pr-20">Total: @{{ total_pages }} páginas</label><br />
                <ul id="search_pagination" class="pagination right-align">
                  <li v-for="search_page in search_pages" v-bind:class="search_page.list_class"><a @click="show_data(search_page.action)" v-html="search_page.text"></a></li>
                </ul>

            </div>
          </div>

        </div>

      </template>

      </div>

    </form>

  </div>





 {{--  @include('page_add_1') --}}
</div>

  <div class="section perfiles-politicos " >
    <div class="row ">

      <div class="container light slogan">
        <div class="textwidget custom-html-widget">
          <h1 style="color: #fff; margin: 0;">Perfiles más visitados</h1>
          <h2 style="color: #fff;margin: 0 0 40px 0;">Mira los perfiles más visitados del portal</h2>
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





<a id="float-btn-filters" data-target="opciones-filtrado" class="show sidenav-trigger" ><i class="fa fa-filter"></i></a>

@endsection

@section('footer_scripts')

<script src="{{ url('/js/app_main.js') }}"></script>

@endsection
