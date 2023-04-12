<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Radiografía Política</title>
  <meta name="description" content="Radiografia Politica">
  <meta name="author" content="FCD">

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-T3W54JK');</script>
  <!-- End Google Tag Manager -->
  
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-173011656-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-173011656-1');
</script>


  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--<link rel="stylesheet" href="/font-awesome.min.css">
  <!-- <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/> -->

  {{-- Custom App Styles --}}
  <link href="{{ mix('/css/app_home.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">

  
  <link rel="shortcut icon" href="/img/favicon/favicon.ico">


  <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v7.0&appId=596662761053524&autoLogAppEvents=1" nonce="oCnNoDkk"></script>

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
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T3W54JK"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  @include('template.menu')

  @yield('content')

  <a id="scroll" class="show"><i class="fa fa-arrow-up"></i></a>



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
