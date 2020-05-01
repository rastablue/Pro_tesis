@extends('layouts.app')

@section('content')

<!-- Tabla del usuario -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card" style="height:750px;">

                    {{-- Menu de opciones --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="home" aria-selected="true">{{ $user->name }} {{ $user->apellido_pater }}</a>
                            </li>
                        </ul>

                    {{-- Containers de opciones --}}
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                {{-- Pestaña del Usuario --}}
                                    <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="home-tab">
                                        @if ($user->path)
                                            <div class="avatar text-center" style="background-image: url({{ $user->url_path }})"></div>
                                        @else
                                            <div class="avatar text-center"><div>
                                                <i class="fas fa-user-tie fa-10x"></i>
                                            </div></div>
                                        @endif

                                        <form class="user" method="POST" action="{{ route('pass.update', $user->id) }}" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf

                                            {{-- Cedula --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Cedula</label>
                                                    <div class="col-md-6">
                                                        <input id="codigo" type="text" pattern="{9}" class="form-control" disabled value="{{ $user->cedula }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                    </div>
                                                </div>

                                            {{-- Nombre--}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                                    <div class="col-md-6">
                                                        <input id="codigo" type="text" pattern="{9}" class="form-control" disabled value="{{ $user->name }} {{ $user->apellido_pater }} {{ $user->apellido_mater }}" required autocomplete="Codigo" autofocus>
                                                    </div>
                                                </div>

                                            {{-- Telefono --}}
                                                <div class="form-group row">
                                                    <label for="tlf" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" value="{{ $user->tlf }}" name="telefono" autofocus>

                                                        @error('telefono')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Email --}}
                                                <div class="form-group row">
                                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email" disabled class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" autofocus>

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Contraseña Actual --}}
                                                <div class="form-group row">
                                                    <label for="email" class="col-md-4 col-form-label text-md-right">Contraseña Actual</label>

                                                    <div class="col-md-6">
                                                        <input id="password" type="password" class="form-control" name="oldPassword" autocomplete="email">
                                                    </div>
                                                </div>

                                            {{-- Contraseña Nueva --}}
                                                <div class="form-group row">
                                                    <label for="email" class="col-md-4 col-form-label text-md-right">Nueva Contraseña</label>

                                                    <div class="col-md-6">
                                                        <input id="password" type="password" class="form-control @error('confirmar_contraseña') is-invalid @enderror" name="nueva_contraseña" autocomplete="nueva_contraseña">

                                                        @error('confirmar_contraseña')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Confirmar Contraseña --}}
                                                <div class="form-group row">
                                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="password" type="password" class="form-control @error('confirmar_contraseña') is-invalid @enderror" name="confirmar_contraseña" autocomplete="confirmar_contraseña">

                                                        @error('confirmar_contraseña')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Foto de Perfil --}}
                                                <div class="form-group row mb-2">
                                                    <div class="col-md-6" style="margin-left: 400px;">
                                                        <label for="file-upload" class="custom-file-upload">
                                                            <i class="fa fa-cloud-upload"></i> Cambiar foto de perfil
                                                        </label>
                                                        <span id="file-selected"></span>
                                                        <input id="file-upload" accept="image/jpeg,image/png" type="file" name="foto">
                                                    </div>
                                                </div>

                                            {{-- btn--}}
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-6">
                                                        <button type="submit" class="btn btn-primary btn-user btn-sm text-center">
                                                            Actualizar
                                                        </button>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>

                                </div>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $('#file-upload').bind('change', function() { var fileName = ''; fileName = $(this).val(); $('#file-selected').html(fileName); })
</script>
@stop
