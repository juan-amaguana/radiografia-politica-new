<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" >
        <div class="pull-left image">
          <img src="/img/user.png" class="img-circle" alt="User Image">

        </div>
        <div class="pull-left info" >
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menú Navegación</li>
        <!--
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Tipo delitos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('tipo_delitos.index') }}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{ route('tipo_delitos.create') }}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Tipo juicio</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('tipoJucios.index')}}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{route('tipoJucios.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>
        -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder-open"></i>
            <span>Categorías posiciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('categorias.index') }}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{ route('categorias.create') }}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-institution"></i>
            <span>Posiciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('posiciones.index')}}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{route('posiciones.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Partidos Poílitcos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('partidosPoliticos.index')}}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{route('partidosPoliticos.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Personas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('personas.index')}}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{route('personas.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-male"></i>
            <span>Perfiles</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('perfiles.index')}}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{route('perfiles.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-home"></i>
            <span>Patrimonios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('patrimonios.index')}}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{route('patrimonios.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>SRI</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('sri.index')}}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{route('sri.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>
         <!--
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Judiciales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('judiciales.index')}}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{route('judiciales.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Penales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('penales.index')}}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{route('penales.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>
      -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-graduation-cap"></i>
            <span>Estudios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('estudios.index')}}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{route('estudios.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa  fa-hospital-o"></i>
            <span>Compañías</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('companias.index')}}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{route('companias.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-text"></i>
            <span>Actividades</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('actividades.index')}}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{route('actividades.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file"></i>
            <span>Concurso</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('candidaturas.index')}}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{route('candidaturas.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Participantes concursos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('postulantesCandidaturas.index')}}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{route('postulantesCandidaturas.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-th-list"></i>
            <span>Administracion</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('administraciones.index')}}"><i class="fa fa-circle-o"></i>Ver</a></li>
            <li><a href="{{route('administraciones.create')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
          </ul>
        </li>
        <li><a href="/admin/contactos-radiografia-politica"><i class="fa fa-book"></i> <span>Contactos</span></a></li>
        <li><a href="/admin/sumate-iniciativa"><i class="fa fa-book"></i> <span>Súmate a la iniciativa</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
