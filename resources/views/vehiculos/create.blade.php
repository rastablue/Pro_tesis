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
                                <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Nuevo Vehiculo</i></a>
                                <br><br><button type="submit" form="formMantenimiento" id="submitBtn" class="btn btn-success mt-4">Agregar</button>
                            </div>

                        </div>

                    {{-- Container de opciones --}}
                        <div class="card-body col-9">

                            <form id="formMantenimiento" method="POST" action="{{ route('vehiculos.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="tab-content" id="v-pills-tabContent">
                                    {{-- Vehiculo --}}
                                        <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                            {{-- Cedula --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Cedula del Cliente') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" name="cedula" value="{{ old('cedula') }}" class="form-control @error('cedula') is-invalid @enderror" autocomplete="cedula" autofocus>

                                                        @error('cedula')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            {{-- Placa --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Placa') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" name="placa" value="{{ old('placa') }}" onkeyup="mayus(this);" class="form-control @error('placa') is-invalid @enderror" autocomplete="Placa" autofocus>

                                                        @error('placa')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Marca --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Marca') }}</label>
                                                    <div class="col-md-6">
                                                        <select id="marca" class="form-control @error('marca') is-invalid @enderror" name="marca">
                                                            <option selected disabled>Seleccione una Marca</option>
                                                            @foreach(App\Marca::all() as $marcas)
                                                                <option value="{{ $marcas->id }}">  {{ $marcas->marca }}  </option>
                                                            @endforeach

                                                            @error('marca')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </select>
                                                    </div>
                                                </div>

                                            {{-- Modelo --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Modelo') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" name="modelo" value="{{ old('modelo') }}" class="form-control @error('modelo') is-invalid @enderror" autocomplete="Fecha fin" autofocus>

                                                        @error('modelo')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Color --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Color') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" name="color" value="{{ old('color') }}" class="form-control @error('color') is-invalid @enderror" autocomplete="Color" autofocus>

                                                        @error('color')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Kilometraje --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Kilometraje') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" name="kilometraje" value="{{ old('kilometraje') }}" class="form-control @error('kilometraje') is-invalid @enderror" autocomplete="Kilometraje" autofocus>

                                                        @error('kilometraje')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Tipo --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo Vehiculo') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" name="tipo" value="{{ old('tipo') }}" class="form-control @error('tipo') is-invalid @enderror" autocomplete="tipo" autofocus>

                                                        @error('tipo')
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
                                                        <textarea type="text" name="observacion_vehiculo" class="form-control @error('observacion_vehiculo') is-invalid @enderror" autocomplete="Observacion_vehiculo" autofocus>{{ old('observacion_vehiculo') }}</textarea>

                                                        @error('observacion_vehiculo')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

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
