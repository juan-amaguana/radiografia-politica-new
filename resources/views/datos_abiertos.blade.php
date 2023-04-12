@extends('template.landing')

@section('nav_extras')
@endsection

@section('head')
<link rel="stylesheet" href="/plugins/prism/prism.css">
@endsection


@section('content')
<div class="row section grey lighten-3">
    <div class="container">
    <div class="col  m10  l9 "><h5 class="flow-text">Datos abiertos de Radiografía Política</h5></div>
    </div>    
</div>

<div class="container">

  <div class="row ">
    <div class="col s12 m12 l12">

      <h6 class="header ub-font-weight-800">Funcionarios por género</h6>
      <p>
        El API de funcionarios por género, se puede consumir en formato Excel, CVS y Json
      </p>
      <pre class="language-scss">
        <br>
        <code class="language-scss"><a href="/excel-genero"><span class="token keyword">https://radiografiapolitica/api/</span>excel-genero</a></code><br />
        <code class="language-scss"><a href="/csv-genero"><span class="token keyword">https://radiografiapolitica/api/</span>csv-genero</a></code><br />
        <code class="language-scss"><a href="/api/json-genero"><span class="token keyword">https://radiografiapolitica/api/</span>json-genero</a></code><br />
      </pre>

      <h6 class="header ub-font-weight-800">Declaración del patrimonio de funcionarios</h6>
      <p>
        El API relacionada a las declaraciones patrimoniales de los funcionarios, se puede consumir en formato Excel, CVS y Json
      </p>
      <pre class="language-scss">
        <br>
        <code class="language-scss"><a href="/excel-patrimonio"><span class="token keyword">https://radiografiapolitica/api/</span>excel-patrimonio</a></code><br />
        <code class="language-scss"><a href="/csv-patrimonio"><span class="token keyword">https://radiografiapolitica/api/</span>csv-patrimonio</a></code><br />
        <code class="language-scss"><a href="/api/json-patrimonio"><span class="token keyword">https://radiografiapolitica/api/</span>json-patrimonio</a></code><br />
      </pre>
      

      <h6 class="header ub-font-weight-800">Declaración del impuesto a la renta de funcionarios</h6>
      <p>
        El API relacionada a las declaraciones de impuesto a la renta de los funcionarios, se puede consumir en formato Excel, CVS y Json
      </p>
      <pre class="language-scss">
        <br>
        <code class="language-scss"><a href="/excel-sri"><span class="token keyword">https://radiografiapolitica/api/</span>excel-sri</a></code><br />
        <code class="language-scss"><a href="/csv-sri"><span class="token keyword">https://radiografiapolitica/api/</span>csv-sri</a></code><br />
        <code class="language-scss"><a href="/api/json-sri"><span class="token keyword">https://radiografiapolitica/api/</span>json-sri</a></code><br />
      </pre>
      <h6 class="header ub-font-weight-800">Formación académica de los funcionarios</h6>
      <p>
        El API relacionada a la fomación academica de los funcionarios, se puede consumir en formato Excel, CVS y Json
      </p>
      <pre class="language-scss">
        <br>
        <code class="language-scss"><a href="/excel-estudio"><span class="token keyword">https://radiografiapolitica/api/</span>excel-estudio</a></code><br />
        <code class="language-scss"><a href="/csv-estudio"><span class="token keyword">https://radiografiapolitica/api/</span>csv-estudio</a></code><br />
        <code class="language-scss"><a href="/api/json-estudio"><span class="token keyword">https://radiografiapolitica/api/</span>json-estudio</a></code><br />
      </pre>

      <div class=" light">
        <div class="col col s12 m12 l12 ">
          <div class="card-panel-footer" style="margin-top: 35px">
            <div class="row">
              <div class="col s12 m12 l12 ">
                <span class="title">Descarga los datos</span>
              </div>
            </div>

            <div class="row">

              <div class="col s12 m12 l6 xl5" style="margin-bottom: 15px">
                <a href="{{ route('personas.excel')}}" class="waves-effect waves-light btn-large"><i class="material-icons right">grid_on</i>Api Personas Excel</a>
              </div>

              <div class="col s12 m12 l6 xl5">
                <a href="{{ route('personas.csv')}}" class="waves-effect waves-light btn-large"><i class="material-icons right">cloud_download</i>Api Personas CSV</a>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div id="sass" class="section scrollspy">


        <div id="sass" class="section scrollspy">
          <h6 class="header ub-font-weight-800">METADATOS</h6><br><br>

          <table>
            <thead>
              <tr>
                <th>Campo</th>
                <th>Descripción</th>
              </tr>
            </thead>
            <tbody id="tabla_metadatos"></tbody>
          </table>

        </div>
      </div>


    </div>
  </div>
</div>
@endsection

@section('footer_scripts')

<script>

  $.ajax({
    url: '/api/json-metadata-datos-abiertos',
    type: "get",
    dataType: "json",
    success: function(data) {
      showmetadata(data);
    }
  });

  function showmetadata(data) {
  //console.log(data);
  $("#tabla_metadatos").append("<tr><td>Autor</td><td>" + data.autor_datos_abiertos + "</td></tr>");
  $("#tabla_metadatos").append("<tr><td>Email de contacto</td><td>" + data.email_contacto_datos_abiertos + "</td></tr>");
  $("#tabla_metadatos").append("<tr><td>Licencia datos abiertos</td><td>" + data.licencia + "</td></tr>");
  $("#tabla_metadatos").append("<tr><td>Palabras clave</td><td>" + data.key_word + "</td></tr>");
}

</script>

@endsection

