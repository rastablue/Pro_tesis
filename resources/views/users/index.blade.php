@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Lista de Usuarios</b></h4></span>
                    <!-- Cuadro Buscar  -->
                        @can('users.show')
                            <div class="sidebar-search">
                                <div>
                                    <div class="input-group">
                                        <form action="{{ route('users.search') }}">
                                            <div class="form-group">
                                                <input id="search" name="search" type="text" class="form-control search-menu" placeholder="Search..." onkeypress="pulsar(event)">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endcan
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr class="table-secondary">
                                <th></th>
                                <th scope="col"><div class="text-center">Cedula</div></th>
                                <th scope="col"><div class="text-center">Nombre</div></th>
                                <th scope="col" width="190px"><div class="text-center">Apellidos</div></th>
                                <th scope="col" width="190px"><div class="text-center">Direccion</div></th>
                                <th scope="col"><div class="text-center">Telefono</div></th>
                                <th scope="col"><div class="text-center">E-mail</div></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                            <tr>
                                <th scope="row"><i>{{ $loop->iteration }}</i></th>
                                <th scope="row"><div class="text-center">{{ $item->cedula }}</div></th>
                                <td><div class="text-center">{{ $item->name }}</div></td>
                                <td><div class="text-center">{{ $item->apellido_pater }}    {{ $item->apellido_mater }}</div></td>
                                <td><div class="text-center">{{ $item->direc }}</div></td>
                                <td><div class="text-center">{{ $item->tlf }}</div></td>
                                <td><div class="text-center">{{ $item->email }}</div></td>
                                <td>

                                    @can('users.show')
                                        <a href="{{ route('users.show', $item) }}">
                                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/ver.png') }}" title="Ver Detalles">
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('users.edit')
                                        <a href="{{ route('users.edit', $item) }}">
                                            <img class="img-responsive img-rounded float-right" src="{{ asset('images/actualizar.png') }}" title="Actualizar">
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('users.destroy')
                                        {!! Form::open(['route' => ['users.destroy', $item->id],
                                        'method' => 'DELETE']) !!}
                                            <input type=image src="{{ asset('images/basura.png') }}" title="Eliminar">
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $user->links() }}
                {{-- fin card body --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
