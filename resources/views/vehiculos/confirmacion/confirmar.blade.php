@extends('layouts.app')

@section('content')

<form id="formAgregarCliente" method="GET" action="{{ route('vehiculos.confirmaCliente') }}">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Formulario Cliente -->
                <div class="card shadow mb-4">

                    <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Confirmacion</h6>
                        </a>

                    <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample">
                            <div class="card-body">
                                <div class="text-center">
                                    <em>La cedula ({{ $request->cedula }}), proporcionada no pertenece a un cliente registrado en el sistema, ¿Desea registrar a este cliente y registrar el vehiculo?<br><br></em>
                                </div>
                                <input type="hidden" name="cedula" value="{{ $request->cedula }}">

                                <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                                <button type="submit" form="formAgregarCliente" id="submitBtn" class="btn btn-primary">Agregar</button>

                            </div>
                        </div>

                </div>

            <!-- Formulario Solicitudes -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Datos del vehiculo</h6>
                        </a>
                    <!-- Card Content - Collapse -->
                        <div class="collapse hide" id="collapseCardExample">
                            <div class="card-body">

                                {{-- Placa --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Placa') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" disabled value="{{ $request->placa }}" onkeyup="mayus(this);" class="form-control @error('placa') is-invalid @enderror" autocomplete="Placa" autofocus>

                                            @error('placa')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="placa" value="{{ $request->placa }}">
                                        <input type="hidden" name="marca" value="{{ $request->marca }}">
                                    </div>

                                {{-- Modelo --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Modelo') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" disabled value="{{ $request->modelo }}" class="form-control @error('modelo') is-invalid @enderror" autocomplete="Fecha fin" autofocus>

                                            @error('modelo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="modelo" value="{{ $request->modelo }}">
                                    </div>

                                {{-- Color --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Color') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" disabled value="{{ $request->color }}" class="form-control @error('color') is-invalid @enderror" autocomplete="Color" autofocus>

                                            @error('color')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="color" value="{{ $request->color }}">
                                    </div>

                                {{-- Kilometraje --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Kilometraje') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" disabled value="{{ $request->kilometraje }}" class="form-control @error('kilometraje') is-invalid @enderror" autocomplete="Kilometraje" autofocus>

                                            @error('kilometraje')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="kilometraje" value="{{ $request->kilometraje }}">
                                    </div>

                                {{-- Tipo --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo Vehiculo') }}</label>
                                        <div class="col-md-6">
                                            <input type="input" disabled value="{{ $request->tipo }}" class="form-control @error('tipo') is-invalid @enderror" autocomplete="tipo" autofocus>

                                            @error('tipo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="tipo" value="{{ $request->tipo }}">
                                    </div>

                                {{-- Observacion --}}
                                    <div class="form-group row">
                                        <label for="detalle" class="col-md-4 col-form-label text-md-right">{{ __('Observacion') }}</label>
                                        <div class="col-md-6">
                                            <textarea type="text" disabled class="form-control @error('observacion_vehiculo') is-invalid @enderror" autocomplete="Observacion_vehiculo" autofocus>{{ $request->observacion_vehiculo }}</textarea>

                                            @error('observacion_vehiculo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="observacion_vehiculo" value="{{ $request->observacion_vehiculo }}">
                                    </div>

                            </div>
                        </div>
                </div>

        </div>
    </div>
</form>
<script>
    function mayus(e) {
        e.value = e.value.toUpperCase();
    }
</script>
@endsection
