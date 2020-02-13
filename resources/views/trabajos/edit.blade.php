@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4><b>Editar Trabajo</b></h4></span>
                        <a href="{{ route('mantenimientos.show', $mantenimiento->id) }}">
                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                        </a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('trabajos.update', $trabajo->id) }}">
                            @method('PUT')
                            @csrf

                            {{-- Cedula Empleado --}}
                                <div class="form-group row">

                                    <label for="cedula" class="col-md-4 col-form-label text-md-right">{{ __('Cedula del Encargado') }}</label>

                                    <div class="col-md-6">
                                    <input id="cedula" type="text" placeholder="{{ $trabajo->empleados->users->cedula }}" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{ $trabajo->empleados->users->cedula }}" required autocomplete="cedula" autofocus>

                                        @error('cedula')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            {{-- Mano de Obra --}}
                                <div class="form-group row">
                                    <label for="manobra" class="col-md-4 col-form-label text-md-right">{{ __('Mano de Obra') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="manobra" type="text" placeholder="{{ $trabajo->manobra }}" class="form-control @error('manobra') is-invalid @enderror" name="manobra" value="{{ old('manobra') }}" required autocomplete="manobra" autofocus>{{ $trabajo->manobra }}</textarea>

                                        @error('manobra')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Repuestos --}}
                                <div class="form-group row">
                                    <label for="repuestos" class="col-md-4 col-form-label text-md-right">{{ __('Repuestos') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="repuestos" type="text" placeholder="{{ $trabajo->repuestos }}" class="form-control @error('repuestos') is-invalid @enderror" name="repuestos" value="{{ old('repuestos') }}" required autocomplete="repuestos" autofocus>{{ $trabajo->repuestos }}</textarea>

                                        @error('repuestos')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Costo del repuesto --}}
                                <div class="form-group row">

                                    <label for="costo_repuestos" class="col-md-4 col-form-label text-md-right">{{ __('Costo Repuestos') }}</label>

                                    <div class="col-md-6">
                                        <input id="costo_repuestos" placeholder="{{ $trabajo->costo_repuestos }}" type="number" step="0.01" class="form-control @error('costo_repuestos') is-invalid @enderror" name="costo_repuestos" value="{{ $trabajo->costo_repuestos }}" required autocomplete="costo_repuestos" autofocus>

                                        @error('costo_repuestos')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Costo Mano de obra --}}
                                <div class="form-group row">

                                    <label for="costo_manobra" class="col-md-4 col-form-label text-md-right">{{ __('Costo Mano de Obra') }}</label>

                                    <div class="col-md-6">
                                        <input id="costo_manobra" placeholder="{{ $trabajo->costo_manobra }}" type="number" step="0.01" class="form-control @error('costo_manobra') is-invalid @enderror" name="costo_manobra" value="{{ $trabajo->costo_manobra }}" required autocomplete="costo_manobra" autofocus>

                                        @error('costo_manobra')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Estado --}}
                                <div class="form-group row">
                                    <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado del Trabajo') }}</label>

                                    <div class="col-md-6">

                                        <select id="estado" class="form-control" name="estado">
                                            <option selected='true'>{{ $trabajo->estado }}</option>
                                            @foreach(App\Trabajo::getEnumValues('trabajos', 'estado') as $estados)
                                                <option value="{{ $estados }}">  {{ $estados}}  </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                            {{-- Tipo --}}
                                <div class="form-group row">
                                    <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Trabajo') }}</label>

                                    <div class="col-md-6">

                                        <select id="tipo" class="form-control" name="tipo">
                                            <option selected='true'>{{ $trabajo->tipo }}</option>
                                            @foreach(App\Trabajo::getEnumValues('trabajos', 'tipo') as $tipos)
                                                <option value="{{ $tipos }}">  {{ $tipos}}  </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                            {{-- ID Del Mantenimiento --}}
                                <input id="id_mante" type="hidden" name="id_mante" value="{{ $mantenimiento->id }}">

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
