<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Auto-Tronica</title>

        <link rel="shortcut icon" href="{{ asset('images/ico/favicon.ico') }}">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/navBar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/scroll.css') }}" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">ACCEDER</a>

                        @if (Route::has('register'))
                            <a href="{{ url('/') }}">CONSULTAR</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">

                <div class="row justify-content-center">
        
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card o-hidden border-0 shadow-lg">
                                    <h5 class="card-header bg-secondary text-light">
                                        Consultar Mantenimientos
                                    </h5>
                                    <div class="card-body">
                                        <form action="{{ route('consultas') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <i class="fas fa-search fa-7x ml-2 mr-4"></i>
                                                <div class="col">
                                                    <input type="text" name="buscar" class="form-control" placeholder="Buscar...">

                                                    <button type="submit" class="btn btn-primary btn-user btn-block mt-3">
                                                        Buscar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    @if(session('danger'))
                                        <div class="msg mt-1" style="z-index: 99 !important">
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
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        
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
    </body>
</html>
