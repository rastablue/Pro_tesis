<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/navBar.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navBar.css') }}" rel="stylesheet">
</head>

<body>

    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
          <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">

                <div class="sidebar-brand">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div>
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li>
                                <div class="sidebar-header">
                                    <div class="user-pic">
                                        <img class="img-responsive img-rounded" src="{{ asset('images/profile.png') }}"
                                        alt="User picture">
                                    </div>
                                    <div class="user-info">
                                        <span class="user-name">
                                            {{ Auth::user()->name }} {{ Auth::user()->apellido_pater }}
                                        </span>
                                        <span class="user-role">{{ @App\User::findOrFail(Auth::user()->id)->roles->first()->name }}</span>
                                        <span class="user-status">
                                        <i class="fa fa-circle"></i>
                                        <span>Online</span>
                                        </span>
                                    </div>
                                </div>

                                <!-- Indices -->
                                    <div class="sidebar-menu">
                                        <ul>
                                            <li class="header-menu">
                                                <span>Indices</span>
                                            </li>

                                            <!-- Menu Usuarios  -->
                                                @can('users.index')
                                                    <li class="sidebar-dropdown">
                                                        <a href="#">
                                                            <img class="img-responsive img-rounded" src="{{ asset('images/usuario.png') }}">
                                                            <span>Usuarios</span>
                                                        </a>
                                                        <div class="sidebar-submenu">
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('users.index') }} ">Consultar Usuarios</a>
                                                                </li>
                                                                @can('users.create')
                                                                    <li>
                                                                        <a href="{{ route('users.create') }}">Agregar Usuario</a>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endcan

                                            <!-- Menu Clientes  -->
                                                @can('clientes.index')
                                                    <li class="sidebar-dropdown">
                                                        <a href="#">
                                                            <img class="img-responsive img-rounded" src="{{ asset('images/cliente.png') }}">
                                                            <span>Clientes</span>
                                                        </a>
                                                        <div class="sidebar-submenu">
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('clientes.index') }}">Consultar Clientes</a>
                                                                </li>
                                                                @can('clientes.create')
                                                                    <li>
                                                                        <a href="{{ route('clientes.create') }}">Agregar Clientes</a>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endcan

                                            <!-- Menu Empleados  -->
                                                @can('empleados.index')
                                                    <li class="sidebar-dropdown">
                                                        <a href="#">
                                                            <img class="img-responsive img-rounded" src="{{ asset('images/empleado.png') }}">
                                                            <span>Empleados</span>
                                                        </a>
                                                        <div class="sidebar-submenu">
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('empleados.index') }}">Consultar Empleados</a>
                                                                </li>
                                                                @can('empleados.create')
                                                                    <li>
                                                                        <a href="{{ route('empleados.create') }}">Agregar Empleados</a>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endcan

                                            <!-- Menu Vehiculos  -->
                                                @can('vehiculos.index')
                                                    <li class="sidebar-dropdown">
                                                        <a href="#">
                                                            <img class="img-responsive img-rounded" src="{{ asset('images/transporte.png') }}">
                                                            <span>Vehiculos</span>
                                                        </a>
                                                        <div class="sidebar-submenu">
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('vehiculos.index') }}">Consultar Vehiculos</a>
                                                                </li>
                                                                @can('vehiculos.create')
                                                                    <li>
                                                                        <a href="{{ route('vehiculos.create') }}">Agregar Vehiculo</a>
                                                                    </li>
                                                                @endcan
                                                                @can('marcas.index')
                                                                    <li>
                                                                        <a href="{{ route('marcas.index') }}">Marcas de Vehiculos</a>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endcan
                                            <!-- Menu Mantenimientos  -->
                                                @can('mantenimientos.index')
                                                    <li class="sidebar-dropdown">
                                                        <a href="#">
                                                            <img class="img-responsive img-rounded" src="{{ asset('images/reparar.png') }}">
                                                            <span>Mantenimientos</span>
                                                        </a>
                                                        <div class="sidebar-submenu">
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('mantenimientos.index') }}">Consultar Mantenimientos</a>
                                                                </li>
                                                                @can('mantenimientos.create')
                                                                    <li>
                                                                        <a href="{{ route('mantenimientos.create') }}">Agregar Mantenimientos</a>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endcan

                                            <!-- Menu Roles  -->
                                                @can('roles.index')
                                                    <li class="sidebar-dropdown">
                                                        <a href="#">
                                                            <img class="img-responsive img-rounded" src="{{ asset('images/permisos.png') }}">
                                                            <span>Permisos</span>
                                                        </a>
                                                        <div class="sidebar-submenu">
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('roles.index') }}">Consultar Permisos</a>
                                                                </li>
                                                                @can('roles.create')
                                                                    <li>
                                                                        <a href="{{ route('roles.create') }}">Agregar Permisos</a>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endcan



                                        </ul>
                                    </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
            <!-- Botones Inferiores del Menu-->
                <!-- Boton Configuracion -->
                    <div class="sidebar-footer">
                        <a href="#">
                            <img class="img-responsive img-rounded" src="{{ asset('images/engranaje.png') }}">
                        </a>

                <!-- Boton Salir -->
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <img class="img-responsive img-rounded" src="{{ asset('images/powerOff.png') }}"  title="Salir">
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </div>
        </nav>


        <!-- Contenidos de la Pagina -->
            <main class="page-content">
                <div class="container-fluid">
                    @if (session('info'))
                        <div class="container">
                            <div class="row">
                                <div class="col-md-13 col-md-offset-13">
                                    <div class="alert alert-success">
                                        {{ session('info') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </main>
    </div>

</body>
</html>
