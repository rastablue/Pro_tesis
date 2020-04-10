@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4><b>Actualizar Mantenimiento: </b><i> {{ $mantenimiento->nro_ficha }} </i></h4></span>
                        <a href="javascript:history.back()">
                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                        </a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('mantenimientos.update', $mantenimiento->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            {{-- Ficha --}}
                                <div class="form-group row">
                                    <label for="ficha" class="col-md-4 col-form-label text-md-right">{{ __('Numero de Ficha') }}</label>

                                    <div class="col-md-6">
                                        <input disabled type="text" placeholder="{{ $mantenimiento->nro_ficha }}" class="form-control @error('codigo') is-invalid @enderror" value="{{ $mantenimiento->nro_ficha }}" autocomplete="codigo" autofocus>

                                        @error('codigo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Placa del Vehiculo --}}
                                <div class="form-group row">

                                    <label for="placa" class="col-md-4 col-form-label text-md-right">{{ __('Placa Del Vehiculo') }}</label>

                                    <div class="col-md-6">
                                        <input disabled type="text" placeholder="{{ $mantenimiento->vehiculos->placa }}" class="form-control @error('placa') is-invalid @enderror" value="{{ $mantenimiento->vehiculos->placa }}" autocomplete="placa" autofocus>

                                        @error('placa')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Fecha de ingreso --}}
                                <div class="form-group row">

                                    <label for="placa" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de Ingreso') }}</label>

                                    <div class="col-md-6">
                                        <input disabled type="text" placeholder="{{ $mantenimiento->fecha_ingreso }}" class="form-control @error('placa') is-invalid @enderror" value="{{ $mantenimiento->fecha_ingreso }}" autofocus>
                                    </div>
                                </div>

                            {{-- Fecha de egreso--}}
                                <div class="form-group row">

                                    <label for="placa" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de egreso') }}</label>

                                    <div class="col-md-6">
                                        <input disabled type="text" placeholder="{{ $mantenimiento->fecha_egreso }}" class="form-control @error('placa') is-invalid @enderror" value="{{ $mantenimiento->fecha_egreso }}" autofocus>
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

                                        @error('estado')
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
                                        <textarea id="observacion" placeholder="{{ $mantenimiento->observacion }}" type="text" class="form-control @error('observacion') is-invalid @enderror" name="observacion" value="{{ old('observacion') }}" autocomplete="observacion" autofocus>{{ $mantenimiento->observacion }}</textarea>

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
                                        <textarea id="diagnostico" placeholder="{{ $mantenimiento->diagnostico }}" type="text" class="form-control @error('diagnostico') is-invalid @enderror" name="diagnostico" value="{{ old('diagnostico') }}" autocomplete="diagnostico" autofocus>{{ $mantenimiento->diagnostico }}</textarea>

                                        @error('diagnostico')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Foto de la Ficha --}}
                                <div class="form-group text-center">
                                    <label for="file-upload" class="custom-file-upload">
                                        <i class="fa fa-cloud-upload"></i> Agregar imagen de la ficha
                                    </label>
                                    <span id="file-selected"></span>
                                    <input id="file-upload" accept="image/jpeg,image/png" type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" value="{{ old('foto') }}" autofocus>

                                    @error('foto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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

<script>
    function mayus(e) {
        e.value = e.value.toUpperCase();
    }
    $('#file-upload').bind('change', function() { var fileName = ''; fileName = $(this).val(); $('#file-selected').html(fileName); })
</script>

@endsection
