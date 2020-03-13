@extends('layouts.app')

@section('content')

<!-- Tabla del usuario -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center bg-info">
                        <span><h4><b>Detalles del Usuario:</b><i> {{ $user->name }}    {{ $user->apellido_pater }}</i></h4></span>
                        @can('users.edit')
                            <a href="{{ route('users.edit', Hashids::encode($user->id)) }}">
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
                                    <th scope="col" width="100px"><div class="text-center">Role</div></th>
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
                                    @if (@$user->roles()->name)
                                        <td><div class="text-center">{{ @$user->roles()->first()->name }}</div></td>
                                    @else
                                    <td><div class="text-center">Sin Role</div></td>
                                    @endif

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
