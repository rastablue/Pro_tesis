@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Actualizar Estado</b></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('empleados.update', $empleado->first()->id) }}">
                        @method('PUT')
                        @csrf

                        {{-- Estado Empleado --}}
                            <div class="form-group row">
                                <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado del Empleado') }}</label>

                                <div class="col-md-6">

                                    <select id="estado" class="form-control" name="estado">
                                        <option disabled="true" selected>Seleccione un Estado</option>
                                        <option value="Activo">  Activo  </option>
                                        <option value="Inactivo">  Inactivo  </option>
                                    </select>

                                </div>
                            </div>

                        {{-- btn --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

