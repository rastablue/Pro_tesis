@extends('layouts.app')

@section('content')

<!-- Tabla del Cliente -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4><b>Detalles del Usuario:</b><i> {{ $user->name }}    {{ $user->apellido_pater }}</i></h4></span>
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
        @foreach (App\User::findOrFail($user->id)->clientes->vehiculos as $item)
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-users-center">
                                <span><h4><b>Detalles del Vehiculo: </b><i>{{ $loop->iteration}}</i></h4></span>
                                @can('vehiculos.show')
                                    <a href="{{ route('vehiculos.show', $item) }}">
                                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/ver.png') }}">
                                    </a>
                                @endcan
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
                                            <th><div class="text-center"> {{ $item->placa }} </th>
                                            <td><div class="text-center"> {{ $item->marca }} </td>
                                            <td><div class="text-center"> {{ $item->modelo }} </td>
                                            <td><div class="text-center"> {{ $item->color }} </td>

                                        </tr>
                                            <thead>
                                                <tr class="table-info">
                                                    <th scope="col" colspan="5">Observaciones:</th>
                                                </tr>
                                            </thead>
                                        <tr>
                                            <td colspan="5"> {{ $item->observacion }} </td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif


@endsection
