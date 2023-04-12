@extends('template.landing')

@section('nav_extras')
<br>
@endsection

@section('content')

<div id="fcd-rp-search-perfil" class="container white container-search-box-perfil">

  <div class="section ub-p-no">
    <div class="row">

      <div class="ub-mb-15 col s11 ub-ocultar-web center-align">
        <a @click="mostrar_datos_principales ? mostrar_datos_principales = false : mostrar_datos_principales = true" class="btn trigger blue" href="#">Datos de Perfil</a>
        <a @click="mostrar_datos_principales ? mostrar_datos_principales = false : mostrar_datos_principales = true" class="btn trigger blue" href="#">Línea de tiempo</a>
      </div>

      <div class="fcd-datos-perfil-card col s11 m4 ub-perfil-background" :class="[ mostrar_datos_principales ? 'ub-mostrar-datos-perfil' : 'ub-ocultar-datos-perfil' ]">

        <div class="row">

          <div class="col s12 m12">
              <div class="center-align">
                <br><br>
                <img class="responsive-img ub-ocultar-mobile circle center-align" src="{{ $perfil->picture }}" alt="" width="65%">
                <img class="responsive-img ub-ocultar-web circle center-align" src="{{ $perfil->picture }}" alt="" width="35%">
                <br><br>
                <img class="responsive-img circle center-align ub-opacity-4" src="{{ url("images/fcd_y_radiografia.png") }}" alt="" width="90%">
              </div>

              <div section="perfil-bienes" class="ub-padding-15">
                <div class="row">
                  <div class="col s5 m9 right-align">
                    <img class="responsive-img ub-ocultar-mobile circle center-align" src="{{ url("images/home.png") }}" alt="" width="70%">
                    <img class="responsive-img ub-ocultar-web circle center-align" src="{{ url("images/home.png") }}" alt="" width="50%">
                  </div>
                  <div class="col s6 m9 right-align">
                    <li for="" class="ub-remove-li-points ub-perfil-titulo-section ub-font-weight-100 font-16">Declaración de Bienes</li>
                    <li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-text-bold font-20"></li>
                  </div>
                  <div class="col m6 right-align">
                    <li for="" class="ub-remove-li-points ub-perfil-campo-section ub-font-weight-100 font-16">Activos:</li>
                    <li for="" class="ub-remove-li-points ub-perfil-campo-section ub-font-weight-100 font-16">Pasivos:</li>
                    <li for="" class="ub-remove-li-points ub-perfil-campo-section ub-font-weight-100 font-16">Patrimonio:</li>
                  </div>
                  <div class="col m6 left-align">
                    <li for="" class="ub-remove-li-points ub-perfil-data-section ub-text-bold font-16">${{ $patrimonio->activos }}</li>
                    <li for="" class="ub-remove-li-points ub-perfil-data-section ub-text-bold font-16">${{ $patrimonio->pasivos }}</li>
                    <li for="" class="ub-remove-li-points ub-perfil-data-section ub-text-bold font-16">${{ $patrimonio->patrimonio }}</li>
                  </div>
                </div>

                <hr class="white" />
              </div>

              <div section="perfil-antecedentes">
                <div class="row ub-perfil-justice-section">
                  <div class="col s10 m12 center-align ub-perfil-legal-background-image center-align ub-ocultar-mobile">
                    <br><br>
                    <li for="" class="ub-remove-li-points ub-perfil-titulo-section ub-font-weight-100 font-20">Antecedentes<br>Penales:</li>
                    <li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-text-bold font-40">NO</li>
                  </div>
                  <div class="col s10 center-align ub-perfil-legal center-align ub-ocultar-web">
                    <li for="" class="ub-remove-li-points ub-perfil-titulo-section ub-font-weight-100 font-15">Antecedentes Penales:</li>
                    <li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-text-bold font-30">NO</li>
                  </div>
                </div>
                <hr class="white" />
              </div>

              <div section="perfil-bienes" class="ub-padding-15">
                <div class="row">
                  <div class="col s4 m3 center-align">
                    <img class="responsive-img circle center-align ub-ocultar-mobile" src="{{ url("images/money.png") }}" alt="" width="80%">
                    <img class="responsive-img circle center-align ub-ocultar-web" src="{{ url("images/money.png") }}" alt="" width="50%">
                  </div>
                  <div class="col s5 m9">
                    <li for="" class="ub-remove-li-points ub-perfil-titulo-section ub-font-weight-100 font-16">Impuesto a la renta :{{ $sri_renta->anio_sri }}</li>
                    <li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-text-bold font-25">$ {{ number_format($sri_renta->valor_impuesto_sri,2,",",".") }}</li>
                  </div>
                </div>
                <div class="row">
                  <div class="col s4 m3 center-align">
                    <img class="responsive-img circle center-align ub-ocultar-web" src="{{ url("images/capital_increase.png") }}" alt="" width="50%">
                    <img class="responsive-img circle center-align ub-ocultar-mobile" src="{{ url("images/capital_increase.png") }}" alt="" width="80%">
                  </div>
                  <div class="col m9">
                    <li for="" class="ub-remove-li-points ub-perfil-titulo-section ub-font-weight-100 font-16">Impuesto a la Salida de<br>Divisas : {{ $sri_divisas->anio_sri }}</li>
                    <li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-text-bold font-25">$
                      {{ number_format($sri_divisas->valor_impuesto_sri,2,",",".") }} </li>
                  </div>
                </div>

                <a class="waves-effect waves-light btn modal-trigger" href="#modal1">IR</a>
                <a class="waves-effect waves-light btn modal-trigger" href="#modal2">ISD</a>
                <!-- Modal Renta -->
                <div id="modal1" class="modal modal-fixed-footer">
                  <div class="modal-content">
                    <h5 class="fcd-custom-color">Impuesto a la renta</h5>
                    <div class="col m2"></div>
                    <div class="col m5">
                      <table class="highlight fcd-custom-color">
                        <thead>
                          <tr>
                              <th>Año</th>
                              <th>Valor Impuesto</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($sri_renta_detalle as $sri_renta_detalles)
                          <tr>
                              <td>{{ $sri_renta_detalles->anio_sri }}</td>
                              <td>{{ $sri_renta_detalles->valor_impuesto_sri }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
                    <div class="col m2"></div>
                  </div>
                  <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
                  </div>
                </div>
                <!-- Modal divisas -->
                <div id="modal2" class="modal modal-fixed-footer">
                  <div class="modal-content">
                    <h5 class="fcd-custom-color">Impuesto salida divisas</h5>
                    <div class="col m2"></div>
                    <div class="col m5">
                      <table class="highlight fcd-custom-color">
                        <thead>
                          <tr>
                              <th>Año</th>
                              <th>Valor Impuesto</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($sri_divisas_detalle as $sri_divisas_detalles)
                          <tr>
                              <td>{{ $sri_divisas_detalles->anio_sri }}</td>
                              <td>{{ $sri_divisas_detalles->valor_impuesto_sri }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
                    <div class="col m2"></div>
                  </div>
                  <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
                  </div>
                </div>
                <hr class="white" />
              </div>

              <div section="perfil-bienes" class="ub-padding-15">
                <div class="row">
                  <div class="col s4 m3 center-align">
                    <img class="responsive-img circle center-align" src="{{ url("images/education.png") }}" alt="" width="80%">
                  </div>
                  <div class="col s5 m9">
                    <li for="" class="ub-remove-li-points ub-perfil-titulo-section ub-text-bold font-25">{{ $estudios->profesion_estudio }}</li>
                    <li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-font-weight-100 font-16"><strong>{{ $estudios->pregrado_estudio }} </strong>Títulos Universitario</li>
                    <li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-font-weight-100 font-16"><strong>{{ $estudios->posgrado_estudio }} </strong>Títulos de cuarto nivel</li>
                    <li for="" class="ub-remove-li-points ub-perfil-subtitulo-section ub-font-weight-100 font-16"><strong>{{ $estudios->phd_estudio }} </strong>PhD</li>
                  </div>
                </div>
                <div class="row">
                  <div class="col s4 m3 center-align">
                    <img class="responsive-img circle center-align" src="{{ url("images/industry.png") }}" alt="" width="80%">
                  </div>
                  <div class="col s5 m9">
                    <li for="" class="ub-remove-li-points ub-perfil-titulo-section ub-font-weight-100 font-20">Relaciones con empresas:</li>
                    <div class="row">
                      <div class="col m6 left-align">
                        <li for="" class="ub-remove-li-points ub-perfil-campo-section ub-font-weight-100 font-16">Presidente en:</li>
                        <li for="" class="ub-remove-li-points ub-perfil-campo-section ub-font-weight-100 font-16">Gerente en:</li>
                        <li for="" class="ub-remove-li-points ub-perfil-campo-section ub-font-weight-100 font-16">Accionista en:</li>
                      </div>
                      <div class="col m3 left-align">
                        <li for="" class="ub-remove-li-points ub-perfil-data-section ub-text-bold font-16">
                          @foreach ($compania_presidente as $compania_presidentes)
                            {{ $compania_presidentes->posicion_compania }}
                          @endforeach
                        </li>
                        <li for="" class="ub-remove-li-points ub-perfil-data-section ub-text-bold font-16">
                          @foreach ($compania_gerente as $compania_gerente)
                            {{ $compania_gerente->nombre_compania }}
                          @endforeach</li>
                        <li for="" class="ub-remove-li-points ub-perfil-data-section ub-text-bold font-16">
                          @foreach ($compania_accionista as $compania_accionista)
                            {{ $compania_accionista->nombre_compania }}
                          @endforeach
                        </li>
                      </div>
                    </div>
                  </div>
                  <a class="waves-effect waves-light btn modal-trigger" style="margin-left: 15px" href="#modal3">DETALLE</a>
                  <!-- Modal Renta -->
                  <div id="modal3" class="modal modal-fixed-footer">
                    <div class="modal-content">
                      <h5 class="fcd-custom-color">Detalle relaciones</h5>
                      <div class="col m9">
                        <table class="highlight fcd-custom-color">
                          <thead>
                            <tr>
                                <th>Nombre Empresa</th>
                                <th>Cargo</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($personasCompania as $personasCompanias)
                            <tr>
                                <td>{{ $personasCompanias->nombre_compania }}</td>
                                <td>

                                  @switch($personasCompanias->posicion_compania)
                                      @case(1)
                                          Presidente
                                          @break

                                      @case(2)
                                          Gerente
                                          @break

                                      @case(3)
                                          Accionista
                                          @break
                                  @endswitch


                                </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>

                      </div>
                    </div>
                    <div class="modal-footer">
                      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
                    </div>
                  </div>
                </div>
              </div>

          </div>
        </div>

      </div>

      <div class="fcd-linea-tiempo-perfil-card col s12 m8" :class="[ mostrar_datos_principales ? 'ub-ocultar-datos-perfil' : 'ub-mostrar-datos-perfil' ]">
        <div class="row ub-mb-1 ub-mt-50 ub-mr-20">
          <div class="col s12 grey lighten-3 fcd-custom-color ub-pt-10 ub-pb-10"><span class="font-35 ub-text-bold ub-ocultar-mobile " style="padding-left: 30px;
">{{ $perfil->nombres_persona.' '.$perfil->apellidos_persona }}</span>
          <span class="font-20 ub-text-bold ub-ocultar-web" style="padding-left: 30px;
">{{ $perfil->nombres_persona.' '.$perfil->apellidos_persona }}</span>
          </div>

        </div>
        <div class="row ub-pt-10 ub-pb-15 ub-pl-25 ub-mr-20">
          <div class="section ub-pl-20 ub-mb-15">
            <span class="grey-text text-darken-3 ub-text-bold font-20">Cargo público actual:</span>
             {{ strip_tags(preg_replace('/&nbsp;/', ' ',$personasCargoActual->descripcion_corta )) }}
              <br />
            <span class="grey-text text-darken-3 font-20 ub-p-no"></span>
          </div>
          <div class="divider"></div>
          <div class="section ub-pl-20">
            <h5 class="center-align ub-text-bold fcd-custom-color">CARGOS EN EL SECTOR PÚBLICO</h5>
            <div class="timeline-container timeline-container-color-yellow">
              @foreach ($actividad as $actividades)

               @if ($actividades->id%2  == 0)
               <div class="timeline-block timeline-block-right">
               @else
               <div class="timeline-block timeline-block-left">
               @endif
                  <div class="timeline-marker timeline-color-yellow"></div>
                  <div class="timeline-content">
                    <h3>{{ $actividades->anio_inicio }}</h3>
                    <span>{{ strip_tags(preg_replace('/&nbsp;/', ' ',$actividades->descripcion_corta )) }}</span>
                    <p>{!! $actividades->descripcion !!}</p>
                  </div>
               </div>

               @endforeach
            </div>

          </div>
          <div class="divider"></div>
          <div class="section ub-pl-20">
            <h5 class="center-align ub-text-bold fcd-custom-color">CARGOS EN EL SECTOR PRIVADO</h5>

            <div class="timeline-container timeline-container-color-blue">
              @foreach ($actividad_privada as $actividad_privadas)

              @if ($actividades->id%2  == 0)
               <div class="timeline-block timeline-block-right">
              @else
               <div class="timeline-block timeline-block-left">
              @endif
                  <div class="timeline-marker timeline-color-blue"></div>
                  <div class="timeline-content">
                     <h3>{{ $actividad_privadas->anio_inicio }}</h3>
                     <span>{{ strip_tags(preg_replace('/&nbsp;/', ' ',$actividades->descripcion_corta )) }}</span>
                     <p>{!! $actividad_privadas->descripcion!!}</p>
                  </div>
               </div>
              @endforeach

            </div>

          </div>
          <div class="divider"></div>
          <div class="section ub-pl-20">
            <h5 class="center-align ub-text-bold fcd-custom-color">ACTIVIDAD POLÍTICA</h5>

            <div class="timeline-container timeline-container-color-red">
              @foreach ($actividad_politica as $actividad_politicas)

                @if($actividad_politicas =='')
                 <span>No se encuentra datos</span>


                  @if ($actividades->id%2  == 0)
                   <div class="timeline-block timeline-block-right">
                  @else
                   <div class="timeline-block timeline-block-left">
                  @endif

                      <div class="timeline-marker timeline-color-red"></div>
                      <div class="timeline-content">
                         <h3>{{ $actividad_politicas->anio_inicio }}</h3>
                         <span>{{ $actividad_politicas->descripcion_corta }}</span>
                         <p>{{ strip_tags ($actividad_politicas->descripcion)}}</p>
                      </div>
                   </div>
                @else

                @endif
              @endforeach

            </div>


          </div>
        </div>
      </div>

    </div>
  </div>

</div>
@endsection

@section('footer_scripts')

<script src="{{ url('/js/app_perfil.js') }}"></script>

@endsection
