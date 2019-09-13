<div class="top-bar">
  @if (Route::has('login'))
  <div class="top-right links">
    @auth
    <div style="">Bienvenido, {{Auth::user()->name}}
            <small><a style="color:#fff;" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
             (Salir)
         </a></small></div>
    @else
        <a href="{{ route('login') }}">Login</a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
        @endif
    @endauth
  </div>
  @endif
</div>
