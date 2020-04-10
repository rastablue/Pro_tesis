@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Actualizar Datos de: </b><i>{{ $cliente->name }} {{ $cliente->apellido_pater }}</i></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
                        @method('PUT')
                        @csrf

                        {{-- Cedula --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Cedula') }}</label>
                                <div class="col-md-6">
                                    <input type="input" disabled value="{{ $cliente->cedula }}" class="form-control @error('cedula') is-invalid @enderror" placeholder="{{ $cliente->cedula }}" autocomplete="cedula" autofocus>

                                    @error('cedula')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Nombre --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                                <div class="col-md-6">
                                    <input type="input" value="{{ $cliente->name }}" onkeyup="mayus(this);" class="form-control @error('nombre') is-invalid @enderror" placeholder="{{ $cliente->name }}" disabled autocomplete="nombre" autofocus>

                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Apellido Paterno --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>
                                <div class="col-md-6">
                                    <input type="input" value="{{ $cliente->apellido_pater }}" onkeyup="mayus(this);" class="form-control @error('apellido_paterno') is-invalid @enderror" placeholder="{{ $cliente->apellido_pater }}" disabled autocomplete="apellido_paterno" autofocus>

                                    @error('apellido_paterno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Apellido Materno --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>
                                <div class="col-md-6">
                                    <input type="input" value="{{ $cliente->apellido_mater }}" onkeyup="mayus(this);" class="form-control @error('apellido_materno') is-invalid @enderror" placeholder="{{ $cliente->apellido_mater }}" disabled autocomplete="apellido_materno" autofocus>

                                    @error('apellido_materno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Direccion --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>
                                <div class="col-md-6">
                                    <input type="input" name="direccion" value="{{ $cliente->direc }}" class="form-control @error('direccion') is-invalid @enderror" placeholder="{{ $cliente->direc }}" autocomplete="direccion" autofocus>

                                    @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Telefono --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>
                                <div class="col-md-6">
                                    <input type="input" name="telefono" value="{{ $cliente->tlf }}" class="form-control @error('telefono') is-invalid @enderror" placeholder="{{ $cliente->tlf }}" autocomplete="telefono" autofocus>

                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- Email --}}
                            <div class="form-group row">
                                <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                <div class="col-md-6">
                                    <input type="input" name="email" value="{{ $cliente->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ $cliente->email }}" autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        {{-- btn--}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
