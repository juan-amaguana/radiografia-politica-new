<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Radiografía Política</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="/font-awesome.min.css">
  <!-- <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/> -->

  {{-- Custom App Styles --}}
  <link href="{{ mix('/css/app_home.css') }}" rel="stylesheet">
  <meta name="description" content="Radiografía Política es una iniciativa de Fundación Ciudadanía y Desarrollo que recopila información pública de funcionarios/as y candidatos/as con cargos públicos..">
  <meta name="author" content="FCD">
  <link rel="shortcut icon" href="/img/favicon/favicon.ico">

  @yield('meta_compartir')
  {{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  @yield('template_linked_css')

  <style type="text/css">
    @yield('template_fastload_css')
  </style>

  @yield('head')

</head>

<body>

  @include('template.menu')

  @yield('content')

  <a id="scroll" class="show"><i class="fa fa-angle-up"></i></a>



  @include('template.footer')

  {{-- Scripts --}}
  <script src="{{ mix('/js/app_home.js') }}"></script>

  <!-- load D3js -->
  <script src="http://d3plus.org/js/d3.js"></script>
  <!-- load D3plus after D3js -->
  <script src="http://d3plus.org/js/d3plus.js"></script>

  <script src="/js/button_top.js"></script>

  @yield('footer_scripts')

</body>

</html>
