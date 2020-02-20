@extends('layouts.app')

@section('content')

<!-- Tabla de los Vehiculos -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-users-center bg-warning">
                        <span><h4><b>Detalles del Vehiculo: </b><i>{{ $vehiculo->placa}}</i></h4></span>
                        @can('vehiculos.edit')
                            <a href="{{ route('vehiculos.edit', $vehiculo) }}">
                                <img class="img-responsive img-rounded float-right" src="{{ asset('images/actualiza.png') }}" title="Actualizar">
                            </a>
                        @endcan
                        <a href="javascript:history.back()">
                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table">
                            <thead>
                            <tr class="table-secondary">
                                <th scope="col"><div class="text-center">Placa</div></th>
                                <th scope="col"><div class="text-center">Marca</div></th>
                                <th scope="col"><div class="text-center">Modelo</div></th>
                                <th scope="col"><div class="text-center">Color</div></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><div class="text-center"> {{ $vehiculo->placa }} </th>
                                    <td><div class="text-center"> {{ $vehiculo->marcas->marca }} </td>
                                    <td><div class="text-center"> {{ $vehiculo->modelo }} </td>
                                    <td><div class="text-center"> {{ $vehiculo->color }} </td>
                                </tr>
                                    <thead>
                                        <tr class="table-info">
                                            <th scope="col" colspan="5">Observaciones:</th>
                                        </tr>
                                    </thead>
                                <tr>
                                    <td colspan="5"> {{ $vehiculo->observacion }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Tabla del Cliente -->
    @foreach ($user as $item)

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center bg-info">
                            <span><h4><b>Detalles del Cliente:</b><i> {{ $item->name }}    {{ $item->apellido_pater }} </i></h4></span>
                            @can('users.show')
                                <a href="{{ route('users.show', $item) }}">
                                    <img class="img-responsive img-rounded float-left" src="{{ asset('images/ver.png') }}" title="Ver Detalles">
                                </a>
                            @endcan
                        </div>
                        <div class="card-body">

                            <table class="table">
                                <thead>
                                    <tr class="table-secondary">
                                        <th scope="col"><div class="text-center">Cedula</div></th>
                                        <th scope="col"><div class="text-center">Nombre</div></th>
                                        <th scope="col"><div class="text-center">Apellidos</div></th>
                                        <th scope="col" width="210px"><div class="text-center">Direccion</div></th>
                                        <th scope="col"><div class="text-center">Telefono</div></th>
                                        <th scope="col"><div class="text-center">E-mail</div></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row"><div class="text-center">{{ $item->cedula }}</div></th>
                                        <td><div class="text-center">{{ $item->name }}</div></td>
                                        <td><div class="text-center">{{ $item->apellido_pater }}    {{ $item->apellido_mater }}</div></td>
                                        <td><div class="text-center">{{ $item->direc }}</div></td>
                                        <td><div class="text-center">{{ $item->tlf }}</div></td>
                                        <td><div class="text-center">{{ $item->email }}</div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

<!-- Tabla de Mantenimientos -->

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-13">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center bg-secondary">
                        <span><h4><b>Lista de Mantenimientos</b></h4></span>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr class="table-secondary">
                                    <th></th>
                                    <th scope="col"><div class="text-center">Nro. Ficha</div></th>
                                    <th scope="col" width="210px"><div class="text-center">Fecha de Ingreso</div></th>
                                    <th scope="col" width="210px"><div class="text-center">Fecha de Egreso</div></th>
                                    <th scope="col" width="210px"><div class="text-center">Estado</div></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Vehiculo::findOrFail($vehiculo->id)->mantenimientos->all() as $item)
                                <tr>
                                    <th scope="row"><i>{{ $loop->iteration }}</i></th>
                                    <th scope="row"><div class="text-center">{{ $item->nro_ficha }}</div></th>
                                    <td><div class="text-center">{{ $item->fecha_ingreso }}</div></td>
                                    <td><div class="text-center">{{ $item->fecha_egreso }}</div></td>
                                    <td><div class="text-center">{{ $item->estado }}</div></td>
                                    <td>
                                        @can('mantenimientos.show')
                                            <a href="{{ route('mantenimientos.show', $item) }}">
                                                <img class="img-responsive img-rounded float-left" src="{{ asset('images/ver.png') }}"  title="Ver Detalles">
                                            </a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('trabajos.create')
                                            <a href="{{ route('trabajos.show', $item) }}">
                                                <img class="img-responsive img-rounded float-right" src="{{ asset('images/trabajos.png') }}" title="Agregar Trabajo">
                                            </a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('mantenimientos.edit')
                                            <a href="{{ route('mantenimientos.edit', $item) }}">
                                                <img class="img-responsive img-rounded float-right" src="{{ asset('images/actualizar.png') }}" title="Actualizar">
                                            </a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('mantenimientos.destroy')
                                            {!! Form::open(['route' => ['mantenimientos.destroy', $item->id],
                                            'method' => 'DELETE']) !!}
                                                <input type=image src="{{ asset('images/basura.png') }}" title="Eliminar">
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    {{-- fin card body --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
