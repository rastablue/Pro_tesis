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

                                <a class="nav-link active" id="v-pills-cliente-tab" data-toggle="pill" href="#v-pills-cliente" role="tab" aria-controls="v-pills-cliente" aria-selected="true">Vehiculo</a>
                                
                                <a class="nav-link @error('codigo') is-invalid @enderror or @error('fecha_ingreso') is-invalid @enderror or @error('observacion') is-invalid @enderror or 
                                @error('diagnostico') is-invalid @enderror or @error('foto') is-invalid @enderror"
                                id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Mantenimiento</a>
                                {{-- Muestra errores de ingreso de cliente --}}
                                    @if($errors->has('codigo') || $errors->has('fecha_ingreso') || $errors->has('observacion') ||
                                        $errors->has('diagnostico') || $errors->has('foto'))

                                        <span class="invalid-feedback" role="alert">
                                            <strong>Es posible que hayan errores en el formulario Mantenimiento</strong>
                                        </span>

                                    @endif

                                <a class="nav-link @error('cedula') is-invalid @enderror or @error('nombre') is-invalid @enderror or @error('apellido_paterno') is-invalid @enderror
                                or @error('apellido_materno') is-invalid @enderror or @error('direccion') is-invalid @enderror or @error('telefono') is-invalid @enderror
                                or @error('email') is-invalid @enderror"
                                id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Cliente</a>
                                {{-- Muestra errores de ingreso de cliente --}}
                                    @if($errors->has('cedula') || $errors->has('nombre') || $errors->has('apellido_paterno') ||
                                        $errors->has('apellido_materno') || $errors->has('direccion') || $errors->has('telefono') ||
                                        $errors->has('email'))

                                        <span class="invalid-feedback" role="alert">
                                            <strong>Es posible que hayan errores en el formulario cliente</strong>
                                        </span>

                                    @endif
                                
                            </div>


                        </div>

                    {{-- Container de opciones --}}
                        <div class="card-body col-9">

                            <form id="formConfirmacionCliente" method="GET" action="{{ route('mantenimientos.confirmaVehiculo') }}">
                                @csrf

                                <div class="tab-content" id="v-pills-tabContent">
                                    {{-- Vehiculo --}}
                                        <div class="tab-pane fade show active" id="v-pills-cliente" role="tabpanel" aria-labelledby="v-pills-cliente-tab">

                                            <div class="text-center">
                                                <em>La Placa proporcionada ({{ $request->placa }}), no pertenece a ningun vehiculo previamente registrado, ¿Desea registrar el vehiculo y crear la Solicitud?<br><br></em>
                                            </div>
                                            <input type="hidden" name="placa" value="{{ $request->placa }}">
                                            <div class="mt-5">
                                                <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                                                <button type="submit" form="formConfirmacionCliente" id="submitBtn" class="btn btn-primary">Agregar</button>
                                            </div>
                                        </div>

                                    {{-- Mantenimientos --}}
                                        <div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                                            {{-- Codigo --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Codigo Mantenimiento') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $request->codigo }}" class="form-control @error('codigo') is-invalid @enderror" autocomplete="Codigo" autofocus>

                                                        @error('codigo')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="codigo" value="{{ $request->codigo }}">
                                                </div>

                                            {{-- Observacion --}}
                                                <div class="form-group row">
                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">{{ __('Observacion') }}</label>
                                                    <div class="col-md-6">
                                                        <textarea type="text" disabled class="form-control @error('observacion_mantenimiento') is-invalid @enderror" autocomplete="observacion_mantenimiento" autofocus>{{ $request->observacion_mantenimiento }}</textarea>

                                                        @error('observacion_mantenimiento')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="observacion_mantenimiento" value="{{ $request->observacion_mantenimiento }}">
                                                </div>

                                            {{-- Diagnostico --}}
                                                <div class="form-group row">
                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">{{ __('Diagnostico') }}</label>
                                                    <div class="col-md-6">
                                                        <textarea type="text" disabled class="form-control @error('diagnostico') is-invalid @enderror" autocomplete="diagnostico" autofocus>{{ $request->diagnostico }}</textarea>

                                                        @error('diagnostico')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="diagnostico" value="{{ $request->diagnostico }}">
                                                </div>

                                        </div>

                                    {{-- Cliente --}}
                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                                            {{-- Cedula --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Cedula') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $cliente->cedula }}" class="form-control @error('cedula') is-invalid @enderror" autocomplete="cedula" autofocus>

                                                        @error('cedula')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="cedula" value="{{ $cliente->cedula }}">
                                                </div>

                                            {{-- Nombre --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $cliente->name }}" onkeyup="mayus(this);" class="form-control @error('nombre') is-invalid @enderror" autocomplete="nombre" autofocus>

                                                        @error('nombre')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="nombre" value="{{ $cliente->name }}">
                                                </div>

                                            {{-- Apellido Paterno --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $cliente->apellido_pater }}" onkeyup="mayus(this);" class="form-control @error('apellido_paterno') is-invalid @enderror" autocomplete="apellido_paterno" autofocus>

                                                        @error('apellido_paterno')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="apellido_paterno" value="{{ $cliente->apellido_pater }}">
                                                </div>

                                            {{-- Apellido Materno --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $cliente->apellido_mater }}" onkeyup="mayus(this);" class="form-control @error('apellido_materno') is-invalid @enderror" autocomplete="apellido_materno" autofocus>

                                                        @error('apellido_materno')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="apellido_materno" value="{{ $cliente->apellido_mater }}">
                                                </div>

                                            {{-- Direccion --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $cliente->direc }}" class="form-control @error('direccion') is-invalid @enderror" autocomplete="direccion" autofocus>

                                                        @error('direccion')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="direccion" value="{{ $cliente->direc }}">
                                                </div>

                                            {{-- Telefono --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $cliente->tlf }}" class="form-control @error('telefono') is-invalid @enderror" autocomplete="telefono" autofocus>

                                                        @error('telefono')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="telefono" value="{{ $cliente->tlf }}">
                                                </div>

                                            {{-- Email --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $cliente->email }}" class="form-control @error('email') is-invalid @enderror" autocomplete="email" autofocus>

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="email" value="{{ $cliente->email }}">
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
