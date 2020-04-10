@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4><b>Actualizar Vehiculo: </b></h4><i>{{ $vehiculo->placa }}</i></span>
                        <a href="javascript:history.back()">
                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                        </a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('vehiculos.update', $vehiculo->id) }}">
                            @method('PUT')
                            @csrf

                            {{-- Placa --}}
                                <div class="form-group row">
                                    <label for="placa" class="col-md-4 col-form-label text-md-right">{{ __('Numero de Placa') }}</label>

                                    <div class="col-md-6">
                                        <input id="placa" placeholder="{{ $vehiculo->placa }}" type="text" class="form-control @error('placa') is-invalid @enderror" disabled name="placa" value="{{ $vehiculo->placa }}" required autocomplete="placa" autofocus>

                                        @error('placa')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Marca --}}
                                <div class="form-group row">
                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Marca</label>
                                    <div class="col-md-6">
                                        @if ($vehiculo->marca_id)
                                            <input type="input" disabled value="{{ $vehiculo->marcas->marca }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                        @else
                                            <input type="input" disabled value="N/A" class="form-control" required autocomplete="Fecha fin" autofocus>
                                        @endif
                                    </div>
                                </div>

                            {{-- Modelo --}}
                                <div class="form-group row">
                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Modelo</label>
                                    <div class="col-md-6">
                                        <input type="input" disabled value="{{ $vehiculo->modelo }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                    </div>
                                </div>

                            {{-- Color --}}
                                <div class="form-group row">

                                    <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('Color') }}</label>

                                    <div class="col-md-6">
                                        <input placeholder="{{ $vehiculo->color }}" type="text" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ $vehiculo->color }}" autocomplete="color" autofocus>

                                        @error('color')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Tipo --}}
                                <div class="form-group row">

                                    <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>

                                    <div class="col-md-6">
                                        <input placeholder="{{ $vehiculo->tipo_vehiculo }}" type="text" class="form-control @error('tipo') is-invalid @enderror" name="tipo" value="{{ $vehiculo->tipo_vehiculo }}" autocomplete="tipo" autofocus>

                                        @error('tipo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Kilometraje --}}
                                <div class="form-group row">
                                    <label for="kilometraje" class="col-md-4 col-form-label text-md-right">{{ __('Kilometraje') }}</label>

                                    <div class="col-md-6">
                                        <input id="kilometraje" type="text" placeholder="{{ $vehiculo->kilometraje }}" class="form-control @error('kilometraje') is-invalid @enderror" name="kilometraje" value="{{ $vehiculo->kilometraje }}" autocomplete="kilometraje" autofocus>

                                        @error('kilometraje')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Observacion --}}
                                <div class="form-group row">
                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">{{ __('Observacion') }}</label>
                                    <div class="col-md-6">
                                        <textarea type="text" name="observacion_vehiculo" class="form-control @error('observacion_vehiculo') is-invalid @enderror" autocomplete="Observacion_vehiculo" autofocus>{{ $vehiculo->observacion }}</textarea>

                                        @error('observacion_vehiculo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Cedula del cliente --}}
                                <div class="form-group row">
                                    <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('Cedula del Cliente') }}</label>

                                    <div class="col-md-6">
                                        @if ($vehiculo->cliente_id)
                                            <input placeholder="{{ $vehiculo->clientes->cedula }}" type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{ $vehiculo->clientes->cedula }}" required autocomplete="cedula" autofocus>
                                        @else
                                            <input placeholder="N/A" type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="N/A" required autocomplete="cedula" autofocus>
                                        @endif

                                        @error('cedula')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- btn --}}
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-5">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Actualizar') }}
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
