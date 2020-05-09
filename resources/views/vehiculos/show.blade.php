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
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Vehiculo: <i>{{ $vehiculo->placa }}</i></a>
                                @if ($vehiculo->cliente_id)
                                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Cliente: <i>{{ $vehiculo->clientes->name }}    {{ $vehiculo->clientes->apellido_pater }}</i></a>
                                @else
                                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Cliente: <i><em>N/A</em></i></a>
                                @endif
                                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Mantenimientos</a>
                            </div>

                        </div>

                    {{-- container de opciones --}}
                        <div class="card-body col-9">

                            <div class="tab-content" id="v-pills-tabContent">
                                {{-- Vehiculo --}}
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

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

                                            {{-- btn--}}
                                                <div class="form-group row mb-0">
                                                    <div class="align-items-center col-md-6 offset-md-6">
                                                        @can('vehiculos.sow')
                                                            <a href="{{ route('vehiculos.pdf', Hashids::encode($vehiculo->id)) }}" class="btn btn-sm btn-primary text-white" target="_blank">
                                                                <i class="far fa-file-pdf"></i>
                                                                PDF
                                                            </a>
                                                        @endcan
                                                        @can('vehiculos.edit')
                                                            <a href="{{ route('vehiculos.edit', Hashids::encode($vehiculo->id)) }}" class="btn btn-sm btn-warning">
                                                                <i class="fas fa-fw fa-pen"></i>
                                                                Editar
                                                            </a>
                                                        @endcan
                                                    </div>
                                                </div>

                                        </div>

                                {{-- Cliente --}}
                                    @if ($vehiculo->cliente_id)
                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                                            {{-- Cedula --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Cedula</label>
                                                    <div class="col-md-6">
                                                        <input id="codigo" type="text" pattern="[0-9]{10}" class="form-control" disabled value="{{ $vehiculo->clientes->cedula }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                    </div>
                                                </div>

                                            {{-- Nombre--}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                                    <div class="col-md-6">
                                                        <input id="codigo" type="text" pattern="[A-Za-z]{1,25}" class="form-control" disabled value="{{ $vehiculo->clientes->name }} {{ $vehiculo->clientes->apellido_pater }} {{ $vehiculo->clientes->apellido_mater }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                    </div>
                                                </div>

                                            {{-- Direccion --}}
                                                <div class="form-group row">
                                                    <label for="direc" class="col-md-4 col-form-label text-md-right">Direccion</label>

                                                    <div class="col-md-6">
                                                        <input id="direc" type="text" class="form-control" disabled value="{{ $vehiculo->clientes->direc }}" name="direc" required autofocus>
                                                    </div>
                                                </div>

                                            {{-- Telefono --}}
                                                <div class="form-group row">
                                                    <label for="tlf" class="col-md-4 col-form-label text-md-right">Telefono</label>

                                                    <div class="col-md-6">
                                                        <input id="tlf" type="text" pattern="[0-9]{7,10}" class="form-control" disabled value="{{ $vehiculo->clientes->tlf }}" name="tlf" required autofocus>
                                                    </div>
                                                </div>

                                            {{-- Email --}}
                                                <div class="form-group row">
                                                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email" class="form-control" disabled value="{{ $vehiculo->clientes->email }}" name="email" required autofocus>
                                                    </div>
                                                </div>

                                            {{-- Link al clientes.show --}}
                                                @can('mantenimientos.show')
                                                    <div  style="margin-left: 320px"><a href="{{ route('clientes.show', Hashids::encode($vehiculo->clientes->id)) }}">Este cliente posee {{ $vehiculo->clientes->vehiculos->count() }} vehiculo(s)</a></div>
                                                @endcan

                                            {{-- btn--}}
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-6">
                                                        @can('clientes.edit')
                                                            <a href="{{ route('clientes.edit', Hashids::encode($vehiculo->clientes->id)) }}" class="btn btn-sm btn-warning">
                                                                <i class="fas fa-fw fa-pen"></i>
                                                                Editar
                                                            </a>
                                                        @endcan
                                                    </div>
                                                </div>

                                        </div>
                                    @else
                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12 col-md-offset-13">
                                                        <div class="alert alert-danger">
                                                            <h6>Es posible que este cliente haya sido eliminado!</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endif

                                {{-- Mantenimientos --}}
                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        @can('mantenimientos.create')
                                            <div class="text-right mb-2">
                                                <a href="{{ route('mantenimientos.createfromvehiculos', Hashids::encode($vehiculo->id)) }}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-plus"></i>
                                                    Agregar Mantenimiento
                                                </a>
                                            </div>
                                        @endcan
                                        <div class="cardScroll">
                                            @foreach (App\Vehiculo::findOrFail($vehiculo->id)->mantenimientos->all() as $item)
                                                <div class="card mb-1">
                                                    <!-- Card Header - Accordion -->
                                                        <a href="#collapseCard{{ $loop->iteration }}" class="d-block card-header py-2 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                            <button class="btn " data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapseOne">
                                                                {{ $item->nro_ficha }}
                                                            </button>
                                                        </a>
                                                    <!-- Card Content - Collapse -->
                                                        <div class="collapse hide" id="collapseCard{{ $loop->iteration }}">
                                                            <div class="card-body">
                                                                {{-- Codigo --}}
                                                                    <div class="form-group row">
                                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Mantenimiento</label>
                                                                        <div class="col-md-6">
                                                                            <input type="input" disabled value="{{ $item->nro_ficha }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                        </div>
                                                                    </div>

                                                                {{-- Fecha Ingreso --}}
                                                                    <div class="form-group row">
                                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha Ingreso</label>
                                                                        <div class="col-md-6">
                                                                            <input type="input" disabled value="{{ $item->fecha_ingreso }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                        </div>
                                                                    </div>

                                                                {{-- Fecha Egreso --}}
                                                                    <div class="form-group row">
                                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha Egreso</label>
                                                                        <div class="col-md-6">
                                                                            <input type="input" disabled value="{{ $item->fecha_egreso }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                        </div>
                                                                    </div>

                                                                {{-- Observacion --}}
                                                                    <div class="form-group row">
                                                                        <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                                                        <div class="col-md-6">
                                                                            <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $item->observacion }} </textarea>
                                                                        </div>
                                                                    </div>

                                                                {{-- Diagnostico --}}
                                                                    <div class="form-group row">
                                                                        <label for="detalle" class="col-md-4 col-form-label text-md-right">Diagnostico</label>
                                                                        <div class="col-md-6">
                                                                            <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $item->diagnostico }} </textarea>
                                                                        </div>
                                                                    </div>


                                                                {{-- Valor Total --}}
                                                                    <div class="form-group row">
                                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Valor Total</label>
                                                                        <div class="col-md-6">
                                                                            <input type="input" disabled value="{{ $item->valor_total }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                        </div>
                                                                    </div>

                                                                {{-- Estado --}}
                                                                    <div class="form-group row">
                                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Estado</label>
                                                                        <div class="col-md-6">
                                                                            <input type="input" disabled value="{{ $item->estado }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                        </div>
                                                                    </div>

                                                                <div  class="text-center"><a href="{{ route('mantenimientos.show', Hashids::encode($item->id)) }}">Este mantenimiento posee {{ $item->trabajos->count() }} trabajo(s), y {{ $item->trabajos->where('estado', 'En espera')->count() }} de ellos aun estan en espera</a></div>

                                                                {{-- btn --}}
                                                                        <div class="form-group row mb-0">
                                                                            @if ($item->estado != 'Finalizado')
                                                                                <div class="align-maquinarias-center col-md-6 offset-md-6">
                                                                                    @can('mantenimientos.edit')
                                                                                        <a href="{{ route('mantenimientos.edit', Hashids::encode($item->id)) }}" class="btn btn-sm btn-warning">
                                                                                            <i class="fas fa-fw fa-pen"></i>
                                                                                            Editar
                                                                                        </a>
                                                                                    @endcan
                                                                                </div>
                                                                            @endif
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
</div>

@endsection
