<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
 
  @include('layouts.includes.head') 
  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('layouts.includes.header')
  
  <!-- Left side column. contains the logo and sidebar -->
  @include('layouts.includes.sidebarRight')
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
 
  @include('layouts.includes.footer')

 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

  @include('layouts.includes.page-js')
</body>
</html> 
