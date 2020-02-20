@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4><b>Nuevo Mantenimiento</b></h4></span>
                        <a href="javascript:history.back()">
                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                        </a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('mantenimientos.store') }}" enctype="multipart/form-data">
                            @csrf
                            {{-- Ficha --}}
                                <div class="form-group row">
                                    <label for="ficha" class="col-md-4 col-form-label text-md-right">{{ __('Numero de Ficha') }}</label>

                                    <div class="col-md-6">
                                        <input id="ficha" type="text" pattern="[0-9]{7}" class="form-control @error('ficha') is-invalid @enderror" name="ficha" value="{{ old('ficha') }}" required autocomplete="ficha" autofocus>

                                        @error('ficha')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Placa del Vehiculo --}}
                                <div class="form-group row">

                                    <label for="placa" class="col-md-4 col-form-label text-md-right">{{ __('Placa') }}</label>

                                    <div class="col-md-6">
                                        <input id="placa" type="text" class="form-control @error('placa') is-invalid @enderror" name="placa" value="{{ old('placa') }}" required autocomplete="placa" autofocus>

                                        @error('placa')
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
                                        <input id="kilometraje" type="text" pattern="[0-9]{2,10}" class="form-control @error('kilometraje') is-invalid @enderror" name="kilometraje" value="{{ old('kilometraje') }}" required autocomplete="kilometraje" autofocus>

                                        @error('kilometraje')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Observacion --}}
                                <div class="form-group row">
                                    <label for="observacion" class="col-md-4 col-form-label text-md-right">{{ __('Observacion') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="observacion" type="text" class="form-control @error('observacion') is-invalid @enderror" name="observacion" value="{{ old('observacion') }}" required autocomplete="observacion" autofocus></textarea>

                                        @error('observacion')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Diagnostico --}}
                                <div class="form-group row">
                                    <label for="diagnostico" class="col-md-4 col-form-label text-md-right">{{ __('Diagnostico') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="diagnostico" type="text" class="form-control @error('diagnostico') is-invalid @enderror" name="diagnostico" value="{{ old('diagnostico') }}" required autocomplete="diagnostico" autofocus></textarea>

                                        @error('diagnostico')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Imagen de la Ficha
                                <div class="form-group row">
                                    <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Cargar Imagen de la Ficha') }}</label>

                                    <div class="col-md-6">
                                        <input id="file" type="file" name="ficha">
                                    </div>
                                </div> --}}

                            {{-- btn --}}
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-5">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Registrar') }}
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
