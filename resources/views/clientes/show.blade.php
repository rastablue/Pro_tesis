@extends('layouts.app')

@section('content')

<!-- Tabla -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card" style="height:650px;">

                    {{-- Menu de opciones --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="home" aria-selected="true">{{ $cliente->name }} {{ $cliente->apellido_pater }}</a>
                            </li>
                            @if (@App\Cliente::findOrFail($cliente->id)->vehiculos->first())
                                <li class="nav-item">
                                    <a class="nav-link" id="vehiculos-tab" data-toggle="tab" href="#vehiculos" role="tab" aria-controls="contact" aria-selected="false">Vehiculos</a>
                                </li>
                            @endif
                        </ul>

                    {{-- Container de opciones --}}
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                {{-- Pestaña Cliente --}}
                                    <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="home-tab">

                                        {{--<div class="avatar text-center" style="background-image: url({{ asset('images/profile2.png') }})"></div>--}}

                                        <div class="avatar text-center mt-10 rounded-circle">
                                            <i class="fas fa-user fa-10x"></i>
                                        </div>

                                        {{-- Cedula --}}
                                            <div class="form-group row">
                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Cedula</label>
                                                <div class="col-md-6">
                                                    <input id="codigo" type="text" pattern="[0-9]{10}" class="form-control" disabled value="{{ $cliente->cedula }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                </div>
                                            </div>

                                        {{-- Nombre--}}
                                            <div class="form-group row">
                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                                <div class="col-md-6">
                                                    <input id="codigo" type="text" pattern="[A-Za-z]{1,25}" class="form-control" disabled value="{{ $cliente->name }} {{ $cliente->apellido_pater }} {{ $cliente->apellido_mater }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                </div>
                                            </div>

                                        {{-- Direccion --}}
                                            <div class="form-group row">
                                                <label for="direc" class="col-md-4 col-form-label text-md-right">Direccion</label>

                                                <div class="col-md-6">
                                                    <input id="direc" type="text" class="form-control" disabled value="{{ $cliente->direc }}" name="direc" required autofocus>
                                                </div>
                                            </div>

                                        {{-- Telefono --}}
                                            <div class="form-group row">
                                                <label for="tlf" class="col-md-4 col-form-label text-md-right">Telefono</label>

                                                <div class="col-md-6">
                                                    <input id="tlf" type="text" pattern="[0-9]{7,10}" class="form-control" disabled value="{{ $cliente->tlf }}" name="tlf" required autofocus>
                                                </div>
                                            </div>

                                        {{-- Email --}}
                                            <div class="form-group row">
                                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control" disabled value="{{ $cliente->email }}" name="email" required autofocus>
                                                </div>
                                            </div>

                                        {{-- btn--}}
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-6">
                                                    @can('clientes.show')
                                                        <a href="{{ route('clientes.pdf', Hashids::encode($cliente->id)) }}" class="btn btn-sm btn-primary text-white" target="_blank">
                                                            <i class="far fa-file-pdf"></i>
                                                            PDF
                                                        </a>
                                                    @endcan
                                                    @can('clientes.edit')
                                                        <a href="{{ route('clientes.edit', Hashids::encode($cliente->id)) }}" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-fw fa-pen"></i>
                                                            Editar
                                                        </a>
                                                    @endcan
                                                </div>
                                            </div>

                                    </div>

                                {{-- Pestaña Vehiculos --}}
                                    <div class="tab-pane fade" id="vehiculos" role="tabpanel" aria-labelledby="contact-tab">
                                        @can('vehiculos.create')
                                            <div class="text-right mb-2">
                                                <a href="{{ route('vehiculos.createfromcliente', Hashids::encode($cliente->id)) }}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-plus"></i>
                                                    Agregar Vehiculo
                                                </a>
                                            </div>
                                        @endcan
                                        <div id="cardScroll">
                                            @foreach (@App\Cliente::findOrFail($cliente->id)->vehiculos->all() as $item)
                                                <div class="card mb-1">
                                                    <!-- Card Header - Accordion -->
                                                        <a href="#collapseCard{{ $loop->iteration }}" class="d-block card-header py-2 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                            <button class="btn " data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapseOne">
                                                                {{ $item->placa }}
                                                            </button>
                                                        </a>
                                                    <!-- Card Content - Collapse -->
                                                        <div class="collapse hide" id="collapseCard{{ $loop->iteration }}">
                                                            <div class="card-body">

                                                                {{-- Placa --}}
                                                                    <div class="form-group row">
                                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Placa</label>
                                                                        <div class="col-md-6">
                                                                            <input type="input" disabled value="{{ $item->placa }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                        </div>
                                                                    </div>

                                                                {{-- Marca --}}
                                                                    <div class="form-group row">
                                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Marca</label>
                                                                        <div class="col-md-6">
                                                                            @if ($item->marca_id)
                                                                                <input type="input" disabled value="{{ $item->marcas->marca }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                            @else
                                                                                <input type="input" disabled value="N/A" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                {{-- Modelo --}}
                                                                    <div class="form-group row">
                                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Modelo</label>
                                                                        <div class="col-md-6">
                                                                            <input type="input" disabled value="{{ $item->modelo }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                        </div>
                                                                    </div>

                                                                {{-- Kilometraje --}}
                                                                    <div class="form-group row">
                                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Kilometraje</label>
                                                                        <div class="col-md-6">
                                                                            <input type="input" disabled value="{{ $item->kilometraje }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                        </div>
                                                                    </div>

                                                                {{-- Tipo --}}
                                                                    <div class="form-group row">
                                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Tipo</label>
                                                                        <div class="col-md-6">
                                                                            <input type="input" disabled value="{{ $item->tipo_vehiculo }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                        </div>
                                                                    </div>

                                                                {{-- Observacion --}}
                                                                    <div class="form-group row">
                                                                        <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                                                        <div class="col-md-6">
                                                                            <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $item->observacion }} </textarea>
                                                                        </div>
                                                                    </div>

                                                                    @can('mantenimientos.show')
                                                                        <div  class="text-center"><a href="{{ route('vehiculos.show', Hashids::encode($item->id)) }}">Este vehiculo posee {{ $item->mantenimientos->count() }} mantenimiento(s), y {{ $item->mantenimientos->where('estado', 'En espera')->count() }} de ellos aun estan pendientes</a></div>
                                                                    @endcan

                                                                {{-- btn--}}
                                                                    <div class="form-group row mb-0">
                                                                        <div class="align-items-center col-md-6 offset-md-6">
                                                                            @can('vehiculos.edit')
                                                                                <a href="{{ route('vehiculos.edit', Hashids::encode($item->id)) }}" class="btn btn-sm btn-warning">
                                                                                    <i class="fas fa-fw fa-pen"></i>
                                                                                    Editar
                                                                                </a>
                                                                            @endcan
                                                                        </div>
                                                                    </div>

                                                            </div>
                                                        </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection
