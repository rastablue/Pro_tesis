@extends('layouts.app')

@section('content')

<!-- Tabla del Cliente -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center bg-info">
                        <span><h4><b>Detalles del Cliente:</b><i> {{ $cliente->name }}    {{ $cliente->apellido_pater }}</i></h4></span>
                        @can('clientes.edit')
                            <a href="{{ route('clientes.edit', Hashids::encode($cliente->id)) }}">
                                <img class="img-responsive img-rounded float-left" src="{{ asset('images/actualizar.png') }}" title="Actualizar">
                            </a>
                        @endcan
                        <a href="javascript:history.back()">
                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                        </a>
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
                                    <th scope="row"><div class="text-center">{{ $cliente->cedula }}</div></th>
                                    <td><div class="text-center">{{ $cliente->name }}</div></td>
                                    <td><div class="text-center">{{ $cliente->apellido_pater }}    {{ $cliente->apellido_mater }}</div></td>
                                    <td><div class="text-center">{{ $cliente->direc }}</div></td>
                                    <td><div class="text-center">{{ $cliente->tlf }}</div></td>
                                    <td><div class="text-center">{{ $cliente->email }}</div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Tabla de los Vehiculos -->
    @if (@App\Cliente::findOrFail($cliente->id)->vehiculos)
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center bg-warning">
                        <span><h4><b>Lista de Vehiculos</b></h4></span>
                    </div>

                    <div id="global" class="card-body">
                        <table class="table">
                            <thead>
                                <tr class="table-secondary">
                                    <th></th>
                                    <th scope="col" width="150px"><div class="text-center">Placa</div></th>
                                    <th scope="col"><div class="text-center">Marca</div></th>
                                    <th scope="col" width="300px"><div class="text-center">Modelo</div></th>
                                    <th scope="col"><div class="text-center">Color</div></th>
                                    <th width="50px"></th>
                                    <th width="50px"></th>
                                    <th width="50px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Cliente::findOrFail($cliente->id)->vehiculos->all() as $item)
                                    <tr>
                                        <th scope="row"><i>{{ $loop->iteration }}</i></th>
                                        <th scope="row"><div class="text-center">{{ $item->placa }}</div></th>
                                        <td><div class="text-center">{{ $item->marcas->marca }}</div></td>
                                        <td><div class="text-center">{{ $item->modelo }}</div></td>
                                        <td><div class="text-center">{{ $item->color }}</div></td>
                                        <td>
                                            @can('vehiculos.show')
                                                <a href="{{ route('vehiculos.show', Hashids::encode($item->id)) }}">
                                                    <img class="img-responsive img-rounded float-left" src="{{ asset('images/ver.png') }}" title="Ver Detalles">
                                                </a>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('vehiculos.edit')
                                                <a href="{{ route('vehiculos.edit', Hashids::encode($item->id)) }}">
                                                    <img class="img-responsive img-rounded float-right" src="{{ asset('images/actualizar.png') }}" title="Actualizar">
                                                </a>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('vehiculos.destroy')
                                                {!! Form::open(['route' => ['vehiculos.destroy', $item->id],
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
    @endif

@endsection
