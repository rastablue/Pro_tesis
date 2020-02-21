@extends('layouts.app')

@section('content')

<!-- Tabla del Cliente -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center bg-info">
                        <span><h4><b>Detalles del Usuario:</b><i> {{ $user->name }}    {{ $user->apellido_pater }}</i></h4></span>
                        @can('users.edit')
                            <a href="{{ route('users.edit', $user) }}">
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
                                    <th scope="row"><div class="text-center">{{ $user->cedula }}</div></th>
                                    <td><div class="text-center">{{ $user->name }}</div></td>
                                    <td><div class="text-center">{{ $user->apellido_pater }}    {{ $user->apellido_mater }}</div></td>
                                    <td><div class="text-center">{{ $user->direc }}</div></td>
                                    <td><div class="text-center">{{ $user->tlf }}</div></td>
                                    <td><div class="text-center">{{ $user->email }}</div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Tabla de los Vehiculos -->
    @if (@App\User::findOrFail($user->id)->clientes->vehiculos)
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
                                    @foreach (App\User::findOrFail($user->id)->clientes->vehiculos as $item)
                                    <div></div>
                                        <tr>
                                            <th scope="row"><i>{{ $loop->iteration }}</i></th>
                                            <th scope="row"><div class="text-center">{{ $item->placa }}</div></th>
                                            <td><div class="text-center">{{ $item->marcas->marca }}</div></td>
                                            <td><div class="text-center">{{ $item->modelo }}</div></td>
                                            <td><div class="text-center">{{ $item->color }}</div></td>
                                            <td>
                                                @can('vehiculos.show')
                                                    <a href="{{ route('vehiculos.show', $item) }}">
                                                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/ver.png') }}" title="Ver Detalles">
                                                    </a>
                                                @endcan
                                            </td>
                                            <td>
                                                @can('vehiculos.edit')
                                                    <a href="{{ route('vehiculos.edit', $item) }}">
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
