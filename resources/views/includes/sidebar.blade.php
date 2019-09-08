<nav id="sidebar-nav">
    <ul class="nav sidebar-list">
        {{Auth::user()->name}}
        @can('usuarios')
          <li><a href="{{url('/')}}/users"><i class="fas fa-users"></i>Usuarios</a></li>
        @endcan
        @can('clientes')
          <li><a href="{{url('/')}}/clients"><i class="fas fa-chalkboard-teacher"></i>Clientes</a></li>
        @endcan
        @can('locaciones')
          <li><a href="{{url('/')}}/venues"><i class="fas fa-hotel"></i>Locaciones</a></li>
        @endcan
        @can('categorias')
          <li><a href="{{url('/')}}/categories"><i class="fas fa-list-ul"></i>Categorias</a></li>
        @endcan
        @can('servicios')
          <li><a href="{{url('/')}}/services"><i class="fas fa-concierge-bell"></i>Servicios</a></li>
        @endcan
        @can('paquetes')
          <li><a href="{{url('/')}}/packages"><i class="fas fa-cubes"></i>Paquetes</a></li>
        @endcan
        @can('cotizaciones')
          <li><a href="{{url('/')}}/quotes"><i class="fas fa-file-invoice"></i>Cotizaciones</a></li>
        @endcan
        @can('eventos')
          <li><a href="{{url('/')}}/events"><i class="fas fa-birthday-cake"></i>Eventos</a></li>
        @endcan
        @can('calendario')
          <li><a href="{{url('/')}}/calendar"><i class="fas fa-calendar"></i>Calendario</a></li>
        @endcan
        @can('pagos')
          <li><a href="{{url('/')}}/payments"><i class="fas fa-calendar"></i>Pagos</a></li>
        @endcan
        @can('gastos')
          <li><a href="{{url('/')}}/calendar"><i class="fas fa-calendar"></i>Gastos</a></li>
        @endcan
    </ul>
</nav>
