<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('images/ico/favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="{{ asset('js/navBar.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navBar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/scroll.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <style>
        body {
            padding-top: 40px;
        }
    </style>
    <link href="{{ asset('css/fotos.css') }}" rel="stylesheet">
</head>

<body>

    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
          <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">

                <div class="sidebar-brand">
                    <a class="navbar-brand" href="{{ url('home') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <div id="close-sidebar">
                        <i class="fas fa-arrow-circle-left"></i>
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
                                        @if (Auth::user()->path)
                                            <a href=" {{ route('profile.edit', Hashids::encode(Auth::user()->id)) }} ">
                                                <img class="img-responsive img-rounded" src="{{ Auth::user()->url_path }}" alt="User picture">
                                            </a>
                                        @else
                                            <a href=" {{ route('profile.edit', Hashids::encode(Auth::user()->id)) }} ">
                                                <img class="img-responsive img-rounded" src="{{ asset('images/profile2.png') }}" alt="User picture">
                                            </a>
                                        @endif

                                    </div>
                                    <div class="user-info">
                                        <span class="user-name">
                                            {{ Auth::user()->name }} <br> {{ Auth::user()->apellido_pater }}
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
                                                    <li class="sidebar">
                                                        <a href="{{ route('users.index') }}">
                                                            <i class="fas fa-address-card"></i>
                                                            <span>Empleados</span>
                                                        </a>
                                                    </li>
                                                @endcan

                                            <!-- Menu Clientes  -->
                                                @can('clientes.index')
                                                    <li class="sidebar">
                                                        <a href="{{ route('clientes.index') }}">
                                                            <i class="fas fa-address-book"></i>
                                                            <span>Clientes</span>
                                                        </a>
                                                    </li>
                                                @endcan

                                            <!-- Menu Vehiculos  -->
                                                @can('vehiculos.index')
                                                    <li class="sidebar-dropdown">
                                                        <a href="#">
                                                            <i class="fas fa-car-side"></i>
                                                            <span>Vehiculos</span>
                                                        </a>
                                                        <div class="sidebar-submenu">
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('vehiculos.index') }}">Consultar Vehiculos</a>
                                                                </li>
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
                                                            <i class="fas fa-tools"></i>
                                                            <span>Mantenimientos</span>
                                                        </a>
                                                        <div class="sidebar-submenu">
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('mantenimientos.index') }}">Consultar Mantenimientos</a>
                                                                </li>
                                                                @can('trabajos.index')
                                                                    <li>
                                                                        <a href="{{ route('trabajos.index') }}">Consultar Trabajos</a>
                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endcan

                                            <!-- Menu Roles  -->
                                                @can('roles.index')
                                                    <li class="sidebar">
                                                        <a href="{{ route('roles.index') }}">
                                                            <i class="fas fa-key"></i>
                                                            <span>Permisos</span>
                                                        </a>
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
                        <a href=" {{ route('profile.edit', Hashids::encode(Auth::user()->id)) }}">
                            <i class="fas fa-cogs"></i>
                        </a>

                <!-- Boton Salir -->
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </div>
        </nav>


        <!-- Contenidos de la Pagina -->

            <main class="page-content">
                <!-- Mensaje de session !info -->
                    <div class="container-fluid">
                        @if(session('info'))
                            <div class="msg" style="z-index: 99 !important">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 col-md-offset-13">
                                            <div class="alert alert-success">
                                                {{ session('info') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(session('danger'))
                            <div class="msg" style="z-index: 99 !important">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 col-md-offset-13">
                                            <div class="alert alert-danger">
                                                {{ session('danger') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @yield('content')
                    </div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
                <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
                <script src="{{ asset('js/datatables.min.js') }}"></script>
                <script type="text/javascript">
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    //Borra gradual mente el mensaje de session !info
                        $(document).ready(function() {
                            setTimeout(function() {
                                $(".msg").slideUp(2000);
                                },3000);
                        });
                </script>
                <!-- App scripts -->
                @stack('scripts')
            </main>
    </div>

</body>
</html>
