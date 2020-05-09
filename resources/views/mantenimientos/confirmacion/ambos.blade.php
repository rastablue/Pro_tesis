@extends('layouts.app')

@section('content')

<form id="formAgregarCliente" method="GET" action="{{ route('mantenimientos.confirmaAmbos') }}">
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
                                    <em>La cedula ({{ $request->cedula }}), y la placa ({{ $request->placa }}) proporcionadas, no estan registrados en el sistema aun, ¿Desea registrar estos datos y crear la Solicitud?<br><br></em>
                                </div>

                                <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                                <button type="submit" form="formAgregarCliente" id="submitBtn" class="btn btn-primary">Agregar</button>

                            </div>
                        </div>

                </div>

            <!-- Formulario Solicitudes -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Datos de la Solicitud</h6>
                        </a>
                    <!-- Card Content - Collapse -->
                        <div class="collapse hide" id="collapseCardExample">
                            <div class="card-body">
                                {{-- codigo --}}
                                    <div class="form-group row">
                                        <label for="codigo" class="col-md-3 col-form-label text-md-right">Codigo</label>
                                        <div class="col-md-6">
                                            <input type="text" disabled class="form-control @error('codigo') is-invalid @enderror" value="{{ $request->codigo }}" autofocus>
                                        
                                            @error('codigo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="codigo" value="{{ $request->codigo }}">
                                        <input type="hidden" name="cedula" value="{{ $request->cedula }}">
                                        <input type="hidden" name="placa" value="{{ $request->placa }}">
                                    </div>

                                {{-- Observacion --}}
                                    <div class="form-group row">
                                        <label for="observacion" class="col-md-3 col-form-label text-md-right">Observacion</label>
                                        <div class="col-md-6">
                                            <textarea type="text" disabled class="form-control" autofocus>{{ $request->observacion_mantenimiento }}</textarea>

                                            <input type="hidden" name="observacion_mantenimiento" value="{{ $request->observacion_mantenimiento }}">
                                        </div>
                                    </div>

                                {{-- Diagnostico --}}
                                    <div class="form-group row">
                                        <label for="diagnostico" class="col-md-3 col-form-label text-md-right">Diagnostico</label>
                                        <div class="col-md-6">
                                            <textarea type="text" disabled class="form-control" autofocus>{{ $request->diagnostico }}</textarea>

                                            <input type="hidden" name="diagnostico" value="{{ $request->diagnostico }}">

                                        </div>
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
