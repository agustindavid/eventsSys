<nav id="sidebar-nav">
    <ul class="nav sidebar-list">

     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
         @csrf
     </form>
        <li><a href="{{url('/')}}/users" id="openMenu"><i class="fas fa-chevron-right"></i><span><small>Cerrar Menú</small></span></a></li>
        @can('usuarios')
          <li><a href="{{url('/')}}/users"><i class="fas fa-users"></i><span>Usuarios</span></a></li>
        @endcan
        @can('clientes')
          <li><a href="{{url('/')}}/clients"><i class="fas fa-chalkboard-teacher"></i><span><span>Clientes</span></a></li>
        @endcan
        @can('locaciones')
          <li><a href="{{url('/')}}/venues"><i class="fas fa-hotel"></i><span>Locaciones</span></a></li>
        @endcan
        @can('categorias')
          <li><a href="{{url('/')}}/categories"><i class="fas fa-list-ul"></i><span>Categorias</span></a></li>
        @endcan
        @can('servicios')
          <li><a href="{{url('/')}}/services"><i class="fas fa-concierge-bell"></i><span>Servicios</span></a></li>
        @endcan
        @can('paquetes')
          <li><a href="{{url('/')}}/packages"><i class="fas fa-cubes"></i><span>Paquetes</span></a></li>
        @endcan
        @can('cotizaciones')
          <li><a href="{{url('/')}}/quotes"><i class="fas fa-file-invoice"></i><span>Cotizaciones</span></a></li>
        @endcan
        @can('eventos')
          <li><a href="{{url('/')}}/events"><i class="fas fa-birthday-cake"></i><span>Eventos</span></a></li>
        @endcan
        @can('calendario')
          <li><a href="{{url('/')}}/calendar"><i class="fas fa-calendar"></i><span>Calendario</span></a></li>
        @endcan
        @can('pagos')
          <li><a href="{{url('/')}}/payments"><i class="fas fa-calendar"></i><span>Pagos</span></a></li>
        @endcan
        @can('gastos')
          <li><a href="{{url('/')}}/calendar"><i class="fas fa-calendar"></i><span>Gastos</span></a></li>
        @endcan
            <li><a href="{{url('/')}}/settings"><i class="fas fa-cog"></i><span>Configuración</span></a></li>
    </ul>
</nav>
