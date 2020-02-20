@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4><b>Actualizar Mantenimiento: </b><i> {{ $mantenimiento->nro_ficha }} </i></h4></span>
                        <a href="javascript:history.back()" class="btn btn-primary btn-sm">Volver</a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('mantenimientos.update', $mantenimiento->id) }}">
                            @method('PUT')
                            @csrf
                            {{-- Ficha --}}
                                <div class="form-group row">
                                    <label for="ficha" class="col-md-4 col-form-label text-md-right">{{ __('Numero de Ficha') }}</label>

                                    <div class="col-md-6">
                                        <input id="ficha" type="text" placeholder="{{ $mantenimiento->nro_ficha }}" pattern="[0-9]{7}" class="form-control @error('ficha') is-invalid @enderror" name="ficha" value="{{ $mantenimiento->nro_ficha }}" required autocomplete="ficha" autofocus>

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
                                        <input id="placa" type="text" placeholder="{{ $mantenimiento->vehiculos->placa }}" class="form-control @error('placa') is-invalid @enderror" name="placa" value="{{ $mantenimiento->vehiculos->placa }}" required autocomplete="placa" autofocus>

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
                                        <input id="kilometraje" type="text" placeholder="{{ $mantenimiento->kilometraje }}" pattern="[0-9]{0, 6}" class="form-control @error('kilometraje') is-invalid @enderror" name="kilometraje" value="{{ $mantenimiento->kilometraje }}" required autocomplete="kilometraje" autofocus>

                                        @error('kilometraje')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Estado --}}
                                <div class="form-group row">
                                    <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado del Mantenimiento') }}</label>

                                    <div class="col-md-6">

                                        <select id="estado" class="form-control" name="estado">
                                            <option selected='true'>{{ $mantenimiento->estado }}</option>
                                            @foreach(App\Vehiculo::getEnumValues('mantenimientos', 'estado') as $estados)
                                                <option value="{{ $estados }}">  {{ $estados}}  </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                            {{-- Observacion --}}
                                <div class="form-group row">
                                    <label for="observacion" class="col-md-4 col-form-label text-md-right">{{ __('Observacion') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="observacion" placeholder="{{ $mantenimiento->observacion }}" type="text" class="form-control @error('observacion') is-invalid @enderror" name="observacion" value="{{ old('observacion') }}" required autocomplete="observacion" autofocus>{{ $mantenimiento->observacion }}</textarea>

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
                                        <textarea id="diagnostico" placeholder="{{ $mantenimiento->diagnostico }}" type="text" class="form-control @error('diagnostico') is-invalid @enderror" name="diagnostico" value="{{ old('diagnostico') }}" required autocomplete="diagnostico" autofocus>{{ $mantenimiento->diagnostico }}</textarea>

                                        @error('diagnostico')
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
