@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="row mt-3 mb-3 ml-2 mr-2">
                    {{-- Menu de opciones --}}
                        <div class="col-3">

                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Mantenimiento</a>
                                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Vehiculo</i></a>

                                <br><br><button type="submit" form="formMantenimiento" id="submitBtn" class="btn btn-success mt-4">Agregar</button>
                            </div>

                        </div>

                    {{-- Container de opciones --}}
                        <div class="card-body col-9">

                            <form id="formMantenimiento" method="POST" action="{{ route('mantenimientos.storefromvehiculos') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="tab-content" id="v-pills-tabContent">
                                    {{-- Mantenimientos --}}
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                                            {{-- Codigo --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Codigo Mantenimiento') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" name="codigo" value="{{ old('codigo') }}" class="form-control @error('codigo') is-invalid @enderror" autocomplete="Codigo" autofocus>

                                                        @error('codigo')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Fecha Ingreso --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Ingreso') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}" class="form-control @error('fecha_ingreso') is-invalid @enderror" autocomplete="Fecha inicio" autofocus>

                                                        @error('fecha_ingreso')
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
                                                        <textarea type="text" name="observacion_mantenimiento" class="form-control @error('observacion_mantenimiento') is-invalid @enderror" autocomplete="observacion_mantenimiento" autofocus>{{ old('observacion_mantenimiento') }}</textarea>

                                                        @error('observacion_mantenimiento')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Diagnostico --}}
                                                <div class="form-group row">
                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">{{ __('Diagnostico') }}</label>
                                                    <div class="col-md-6">
                                                        <textarea type="text" name="diagnostico" class="form-control @error('diagnostico') is-invalid @enderror" autocomplete="diagnostico" autofocus>{{ old('diagnostico') }}</textarea>

                                                        @error('diagnostico')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Foto de la Ficha --}}
                                                <div class="form-group" style="margin-left: 350px;">
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

                                        </div>

                                    {{-- Vehiculo --}}
                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                                            {{-- Placa --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Placa</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $vehiculo->placa }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
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

                                            {{-- Kilometraje --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Kilometraje</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $vehiculo->kilometraje }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                    </div>
                                                </div>

                                            {{-- Tipo --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Tipo</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $vehiculo->tipo_vehiculo }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                    </div>
                                                </div>

                                            {{-- Observacion --}}
                                                <div class="form-group row">
                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                                    <div class="col-md-6">
                                                        <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $vehiculo->observacion }} </textarea>
                                                    </div>
                                                </div>

                                            {{-- id Vehiculo --}}
                                                <input type="hidden" value="{{ $vehiculo->id }}" name="id_vehiculo">

                                        </div>
                                </div>
                            </form>
                        </div>
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
@stop
