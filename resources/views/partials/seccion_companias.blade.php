<div class="row">
  <div class="col s4 m3 center-align">
    <img class="responsive-img circle center-align" src="{{ url("images/industry.png") }}" alt="" width="80%">
  </div>
  <div class="col s12 m9">
    <li for="" class="ub-remove-li-points ub-perfil-titulo-section ub-font-weight-100 font-20">Relaciones con empresas:</li>
    <li for="" class="ub-remove-li-points ub-perfil-campo-section ub-font-weight-100 font-16"><a class="modal-trigger text-yellow-fcd" href="#modal3">+ Ver más detalle</a></li>
    <div class="row">
      <div class="col m6 left-align">
        <li for="" class="ub-remove-li-points ub-perfil-campo-section ub-font-weight-100 font-16">Presidente en:</li>
        <li for="" class="ub-remove-li-points ub-perfil-campo-section ub-font-weight-100 font-16">Gerente en:</li>
        <li for="" class="ub-remove-li-points ub-perfil-campo-section ub-font-weight-100 font-16">Accionista en:</li>
        
      </div>
      <?php
        $compania_presidente = 0;
        $compania_gerente = 0;
        $compania_accionista = 0;
        foreach ($personasCompania as $compania) {
          switch ($compania->posicion_compania) {
            case 1:
              $compania_presidente++;
              break;

            case 2:
              $compania_gerente++;
              break;

            case 3:
              $compania_accionista++;
              break;
            
            default:
              # code...
              break;
          }
        }
      ?>
      <div class="col m3 left-align">
        <li for="" class="ub-remove-li-points ub-perfil-data-section ub-text-bold font-16">
          {{ $compania_presidente}}
        </li>
        <li for="" class="ub-remove-li-points ub-perfil-data-section ub-text-bold font-16">
          {{ $compania_gerente}}</li>
        <li for="" class="ub-remove-li-points ub-perfil-data-section ub-text-bold font-16">
          {{ $compania_accionista}}
        </li>

      </div>
    </div>
  </div>

  <?php
  $nombre_politico_companias = $perfil->nombres_persona.' '.$perfil->apellidos_persona;
  $descripcion_companias = '# companias presidente: '.$compania_presidente."\n".'# companias gerente: '.$compania_gerente."\n".'# companias accionista: '.$compania_accionista;



  $text_companias = 'Sabías que '.$perfil->twitter_persona.'es accionista en '.$compania_accionista.' compañías? Mira más en #Radiografíapolítica '.'http://157.245.128.41:8080/perfil/'.$perfil->id;
  $text_companias = urlencode($text_companias);
  $url_tweet_companias = 'https://twitter.com/intent/tweet?text='.$text_companias;
  ?>



  <div class="row">
      <div class="col s12 m12 l8 botones-archivos-perfil" >
        <div class="fcd-button-footer-perfil fcd-btn-archivo">
          <a href="{{$perfil->url_compania}}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">arrow_forward</i>Fuente</a>
          <a  href="{{$perfil->nombre_archivo_compania}}" target="_blank" class="waves-effect waves-light btn"><i class="material-icons right">cloud_download</i>Archivo</a>
        </div>
      </div>
      <div  class="botones-redes-sociales-perfil valign-wrapper col s12 m12 l4">
        <div class="custom-html-widget" style="margin-top: 15px">
          
          <a href="{{$url_tweet_companias}}" target="_blank" style="padding-left: 10px"><img src="/images/front/btn_twitter_gray_light.png" width="25%"  class="responsive-img "></a>
          <a href="#" target="_blank" class="text-button-compartir" ><span> <strong>COMPARTIR</strong></span> </a> 
        </div>
      </div>
    </div>
    <div  style="display: none;" class="botones-redes-sociales-perfil-2 valign-wrapper col s12 m12">
      <div class="  custom-html-widget">
        <a href="{{$url_tweet_companias}}" target="_blank" style="padding-left: 10px"><img src="/images/front/btn_twitter_gray_light.png" width="10%"  class="responsive-img "></a> 
        <a href="#" target="_blank" class="text-button-compartir" ><span> <strong>COMPARTIR</strong></span> </a>
      </div>
    </div>

</div>


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
              <th>Estado</th>
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

              <td>
                @switch($personasCompanias->estado)

                @case(null)
                Sin información
                @break
            
                @case(0)
                Inactivo
                @break

                @case(1)
                Activo
                @break

                @default
                Sin información
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