
<style>

/* .dropdown-nested {
    overflow: visible !important;
    left: 100% !important;
    top: 0 !important;
} */

</style>

<div class="navbar-fixed" >
    <nav class="nav-extended fcd-nav-sticky fcd-nav-sticky-color" role="navigation">
        <div class="nav-wrapper container"> 

            <a id="logo-container" href="/" class="brand-logo">
              <img class="fcd-radiografia-logo change-no-scroll-properties-width left" src="{{ asset('images/radiografia-logo.png') }}" alt="">
            </a>

            <ul class="right hide-on-med-and-down fcd-main-menu change-no-scroll-properties-padding-top">
                <li  class="center-align main-option-menu"><a href='/' >Inicio</a></li>
                <li  class="center-align main-option-menu"><a  href='/quienes-somos'>Quiénes somos</a></li>
                <li  class="center-align main-option-menu"><a class='dropdown-trigger' href='#' data-target='estadisticas-radiografia' data-beloworigin="true">Estadísticas<i class="material-icons right main-option-menu-i-principal">arrow_drop_down</i></a></li>
                <li  class="center-align main-option-menu"><a  href='{{ url("/contactanos") }}' >Contáctanos</a></li>
                <li  class="center-align main-option-menu"><a  href='{{ url("/datos-abiertos") }}' >Datos Abiertos</a></li>

            </ul>

        <!-- Dropdown Structure -->
        <ul id='estadisticas-radiografia' class='dropdown-content dropdown-content1'>
            
            <li><a class="dropdown-trigger-nested dropdown-arrow-izquierda" href="#" data-target="drop-submenu-3">Declaración Patrimonial<i class="material-icons left main-option-menu-i-izquierda">play_arrow</i></a></li>

            <li><a class="dropdown-trigger-nested1 dropdown-arrow-izquierda" href="#" data-target="drop-submenu-4">Impuesto a la renta<i class="material-icons left main-option-menu-i-izquierda">play_arrow</i></a></li> 
            <li><a class="dropdown-trigger-nested1 dropdown-arrow-izquierda" href="#" data-target="drop-submenu-5">Formación académica<i class="material-icons left main-option-menu-i-izquierda">play_arrow</i></a></li>

            <li><a class="dropdown-trigger-nested1 dropdown-arrow-izquierda" href="#" data-target="drop-submenu-6">Género<i class="material-icons left main-option-menu-i-izquierda">play_arrow</i></a></li>
            
              
              
              
        </ul>

        

        <ul id="drop-submenu-6" class="dropdown-content dropdown-content1 dropdown-izquierda">
            <li><a href="/grafica-genero">Funcionarios por género</a></li>  
        </ul>
        <ul id="drop-submenu-3" class="dropdown-content dropdown-content1 dropdown-izquierda">
            <li><a href="/grafica-patrimonio-funcion-estado">Los 5 patrimonios más altos</a></li>
            <li><a href="/grafica-patrimonio-rango">Funcionarios por monto patrimonial</a></li>
        </ul>

        <ul id="drop-submenu-4" class="dropdown-content dropdown-content1 dropdown-izquierda">
            <li><a href="/grafica-impuesto-renta-funcion-estado">Los 5 con mayor impuesto a la renta</a></li>
            <li><a href="/grafica-impuesto-renta-rango">Funcionarios por monto de impuesto a la renta</a></li>
        </ul>

        <ul id="drop-submenu-5" class="dropdown-content dropdown-content1 dropdown-izquierda">
            <li><a href="/grafica-formacion-academica">Funcionarios por nivel de estudios</a></li>
              <li><a href="/grafica-formacion-academica-area">Funcionarios por área de estudios</a></li>
              <li><a href="/grafica-profesionales">Funcionarios por profesión</a></li>
              
        </ul>

        
       

        <!-- Second Level SubMenu -->



        <!-- End Second Level SubMenu -->

        <!-- html comment

        <ul id='acceso-judicial' class='dropdown-content dropdown-content1'>
            <li><a href="#">Accesibilidad edificios</a></li>
            <li><a href="#">Servidores concejo judicatura</a></li>
            <li><a href="#">Consultorios a nivel nacional</a></li>
            <li><a href="#">Numeros accesibilidad</a></li>
        </ul>

        -->

        <a href="#" data-target="menu-responsive" class="sidenav-trigger" style="color: white"><i class="material-icons">menu</i></a>
    </div>
    </nav>

</div>

<ul id="menu-responsive" class="sidenav">


      <li>
        <div class="user-view">
        <div class="background" style="background-color: #ededed;">

        </div>
        <a href="#user"><img src="{{ asset('images/radiografia_politica_color.png') }}"></a>
        </div>
      </li>
      <li><a class="waves-effect" href="/"><i class="material-icons">home</i>Inicio</a></li>
      <li><div class="divider"></div></li>
      
      <li><a class="waves-effect" href="/quienes-somos"><i class="material-icons">supervisor_account</i>Quienes somos</a></li>
      <li><div class="divider"></div></li>
      <li>
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header">Estadísticas<i class="material-icons">show_chart</i></a>
            <div class="collapsible-body">
              <ul>
                <li><a class="waves-effect" href="/grafica-genero">Funcionarios por género</a></li>
                <li><a class="waves-effect" href="/grafica-patrimonio-funcion-estado">Los 5 patrimonios más altos</a></li>
                <li><a class="waves-effect" href="/grafica-patrimonio-rango">Funcionarios por monto patrimonial</a></li>
                <li><a class="waves-effect" href="/grafica-impuesto-renta-funcion-estado">Los 5 con mayor impuesto a la renta</a></li>
                <li><a class="waves-effect" href="/grafica-impuesto-renta-rango">Impuesto a la renta rango</a></li>
                <li><a class="waves-effect" href="/grafica-formacion-academica">Funcionarios por nivel de estudios</a></li>
                <li><a class="waves-effect" href="/grafica-formacion-academica-area">Funcionarios por área de estudios</a></li>
                <li><a class="waves-effect" href="/grafica-profesionales">Funcionarios por profesión</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </li>
      <li><div class="divider"></div></li>
      <li><a class="waves-effect" href="/contactanos"><i class="material-icons">supervisor_account</i>Contáctanos</a></li>
      <li><div class="divider"></div></li>
      <li><a class="waves-effect" href="/datos-abiertos"><i class="material-icons">assignment</i>Datos Abiertos</a></li>
</ul>

<div style="height: 80px">
  
</div>

@yield('nav_extras')

