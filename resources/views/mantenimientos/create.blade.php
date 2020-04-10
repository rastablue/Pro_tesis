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
                                <a class="nav-link @error('placa') is-invalid @enderror or @error('marca') is-invalid @enderror or @error('modelo') is-invalid @enderror
                                        or @error('color') is-invalid @enderror or @error('kilometraje') is-invalid @enderror or @error('tipo') is-invalid @enderror
                                        or @error('observacion') is-invalid @enderror"
                                id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Vehiculo</i></a>
                                {{-- Muestra errores de ingreso de vehiculo --}}
                                    @if($errors->has('placa') || $errors->has('marca') || $errors->has('modelo') ||
                                        $errors->has('color') || $errors->has('kilometraje') || $errors->has('tipo') ||
                                        $errors->has('observacion'))

                                        <span class="invalid-feedback" role="alert">
                                            <strong>Es posible que hayan errores en el formulario vehiculo</strong>
                                        </span>

                                    @endif

                                <a class="nav-link @error('cedula') is-invalid @enderror or @error('nombre') is-invalid @enderror or @error('apellido_paterno') is-invalid @enderror
                                or @error('apellido_materno') is-invalid @enderror or @error('direccion') is-invalid @enderror or @error('telefono') is-invalid @enderror
                                or @error('email') is-invalid @enderror"
                                id="v-pills-cliente-tab" data-toggle="pill" href="#v-pills-cliente" role="tab" aria-controls="v-pills-cliente" aria-selected="true">Cliente</a>
                                {{-- Muestra errores de ingreso de cliente --}}
                                    @if($errors->has('cedula') || $errors->has('nombre') || $errors->has('apellido_paterno') ||
                                        $errors->has('apellido_materno') || $errors->has('direccion') || $errors->has('telefono') ||
                                        $errors->has('email'))

                                        <span class="invalid-feedback" role="alert">
                                            <strong>Es posible que hayan errores en el formulario cliente</strong>
                                        </span>

                                    @endif

                                <br><br><button type="submit" form="formMantenimiento" id="submitBtn" class="btn btn-success">Agregar</button>
                            </div>


                        </div>

                    {{-- Container de opciones --}}
                        <div class="card-body col-9">

                            <form id="formMantenimiento" method="POST" action="{{ route('mantenimientos.store') }}" enctype="multipart/form-data">
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
                                                        </select>
                                                        @error('marca')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
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

                                    {{-- Cliente --}}
                                        <div class="tab-pane fade" id="v-pills-cliente" role="tabpanel" aria-labelledby="v-pills-cliente-tab">

                                            {{-- Cedula --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Cedula') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="input" name="cedula" value="{{ old('cedula') }}" class="form-control @error('cedula') is-invalid @enderror" autocomplete="cedula" autofocus>

                                                        @error('cedula')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
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
