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

                                <a class="nav-link active" id="v-pills-cliente-tab" data-toggle="pill" href="#v-pills-cliente" role="tab" aria-controls="v-pills-cliente" aria-selected="true">Cliente</a>
                                
                                <a class="nav-link @error('codigo') is-invalid @enderror or @error('fecha_ingreso') is-invalid @enderror or @error('observacion') is-invalid @enderror or 
                                @error('diagnostico') is-invalid @enderror or @error('foto') is-invalid @enderror"
                                id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Mantenimiento</a>
                                {{-- Muestra errores de ingreso de cliente --}}
                                    @if($errors->has('codigo') || $errors->has('fecha_ingreso') || $errors->has('observacion') ||
                                        $errors->has('diagnostico') || $errors->has('foto'))

                                        <span class="invalid-feedback" role="alert">
                                            <strong>Es posible que hallan errores en el formulario Mantenimiento</strong>
                                        </span>

                                    @endif

                                <a class="nav-link @error('placa') is-invalid @enderror or @error('marca') is-invalid @enderror or @error('modelo') is-invalid @enderror
                                or @error('color') is-invalid @enderror or @error('kilometraje') is-invalid @enderror or @error('tipo') is-invalid @enderror
                                or @error('observacion') is-invalid @enderror"
                                id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Vehiculo</i></a>
                                {{-- Muestra errores de ingreso de vehiculo --}}
                                    @if($errors->has('placa') || $errors->has('marca') || $errors->has('modelo') ||
                                        $errors->has('color') || $errors->has('kilometraje') || $errors->has('tipo') ||
                                        $errors->has('observacion'))

                                        <span class="invalid-feedback" role="alert">
                                            <strong>Es posible que hallan errores en el formulario vehiculo</strong>
                                        </span>

                                    @endif
                                
                                <div class="mt-5">
                                    <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                                    <button type="submit" form="formAgregarCliente" id="submitBtn" class="btn btn-primary">Agregar</button>
                                </div>
                            </div>


                        </div>

                    {{-- Container de opciones --}}
                        <div class="card-body col-9">

                            <form id="formAgregarCliente" method="POST" action="{{ route('mantenimientos.clientestore') }}">
                                @csrf

                                <div class="tab-content" id="v-pills-tabContent">
                                    {{-- Cliente --}}
                                        <div class="tab-pane fade show active" id="v-pills-cliente" role="tabpanel" aria-labelledby="v-pills-cliente-tab">

                                            {{-- Cedula --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Cedula') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $request->cedula }}" class="form-control @error('cedula') is-invalid @enderror" autocomplete="cedula" autofocus>

                                                        @error('cedula')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="cedula" value="{{ $request->cedula }}">
                                                </div>

                                            {{-- Nombre --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" name="nombre" value="{{ old('nombre') }}" onkeyup="mayus(this);" class="form-control @error('nombre') is-invalid @enderror" autocomplete="nombre" autofocus>

                                                        @error('nombre')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Apellido Paterno --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" name="apellido_paterno" value="{{ old('apellido_paterno') }}" onkeyup="mayus(this);" class="form-control @error('apellido_paterno') is-invalid @enderror" autocomplete="apellido_paterno" autofocus>

                                                        @error('apellido_paterno')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Apellido Materno --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" name="apellido_materno" value="{{ old('apellido_materno') }}" onkeyup="mayus(this);" class="form-control @error('apellido_materno') is-invalid @enderror" autocomplete="apellido_materno" autofocus>

                                                        @error('apellido_materno')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Direccion --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" name="direccion" value="{{ old('direccion') }}" class="form-control @error('direccion') is-invalid @enderror" autocomplete="direccion" autofocus>

                                                        @error('direccion')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Telefono --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" name="telefono" value="{{ old('telefono') }}" class="form-control @error('telefono') is-invalid @enderror" autocomplete="telefono" autofocus>

                                                        @error('telefono')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Email --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" autocomplete="email" autofocus>

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
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

                                            {{-- Fecha Ingreso --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Ingreso') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="date" disabled value="{{ $request->fecha_ingreso }}" class="form-control @error('fecha_ingreso') is-invalid @enderror" autocomplete="Fecha inicio" autofocus>

                                                        @error('fecha_ingreso')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="fecha_ingreso" value="{{ $request->fecha_ingreso }}">
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

                                    {{-- Vehiculo --}}
                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                                            {{-- Placa --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Placa') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $vehiculo->placa }}" onkeyup="mayus(this);" class="form-control @error('placa') is-invalid @enderror" autocomplete="Placa" autofocus>

                                                        @error('placa')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="placa" value="{{ $vehiculo->placa }}">
                                                </div>

                                            {{-- Marca --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Marca') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $vehiculo->marcas->marca }}" onkeyup="mayus(this);" class="form-control @error('marca') is-invalid @enderror" autocomplete="Marca" autofocus>

                                                        @error('marca')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="marca" value="{{ $vehiculo->marcas->id }}">
                                                </div>

                                            {{-- Modelo --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Modelo') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $vehiculo->modelo }}" class="form-control @error('modelo') is-invalid @enderror" autocomplete="Fecha fin" autofocus>

                                                        @error('modelo')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="modelo" value="{{ $vehiculo->modelo }}">
                                                </div>

                                            {{-- Color --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Color') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $vehiculo->color }}" class="form-control @error('color') is-invalid @enderror" autocomplete="Color" autofocus>

                                                        @error('color')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="color" value="{{ $vehiculo->color }}">
                                                </div>

                                            {{-- Kilometraje --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Kilometraje') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $vehiculo->kilometraje }}" class="form-control @error('kilometraje') is-invalid @enderror" autocomplete="Kilometraje" autofocus>

                                                        @error('kilometraje')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="kilometraje" value="{{ $vehiculo->kilometraje }}">
                                                </div>

                                            {{-- Tipo --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo Vehiculo') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $vehiculo->tipo_vehiculo }}" class="form-control @error('tipo') is-invalid @enderror" autocomplete="tipo" autofocus>

                                                        @error('tipo')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="tipo" value="{{ $vehiculo->tipo_vehiculo }}">
                                                </div>

                                            {{-- Observacion --}}
                                                <div class="form-group row">
                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">{{ __('Observacion') }}</label>
                                                    <div class="col-md-6">
                                                        <textarea type="text" disabled class="form-control @error('observacion_vehiculo') is-invalid @enderror" autocomplete="Observacion_vehiculo" autofocus>{{ $vehiculo->observacion }}</textarea>

                                                        @error('observacion_vehiculo')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="observacion_vehiculo" value="{{ $vehiculo->observacion }}">
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
