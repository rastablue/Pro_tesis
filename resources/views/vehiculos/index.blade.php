@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Lista de Vehiculos</b></h4></span>
                    <!-- Cuadro Buscar  -->
                    @can('vehiculos.show')
                        <div class="sidebar-search">
                            <div>
                                <div class="input-group">
                                    <form action="{{ route('vehiculos.search') }}">
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
                                <th scope="col" width="150px"><div class="text-center">Placa</div></th>
                                <th scope="col"><div class="text-center">Marca</div></th>
                                <th scope="col" width="300px"><div class="text-center">Modelo</div></th>
                                <th scope="col"><div class="text-center">Color</div></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehiculo as $item)
                            <tr>
                                <th scope="row"><i>{{ $loop->iteration }}</i></th>
                                <th scope="row"><div class="text-center">{{ $item->placa }}</div></th>
                                <td><div class="text-center">{{ $item->marcas->marca }}</div></td>
                                <td><div class="text-center">{{ $item->modelo }}</div></td>
                                <td><div class="text-center">{{ $item->color }}</div></td>
                                <td>
                                    @can('vehiculos.show')
                                        <a href="{{ route('vehiculos.show', $item) }}">
                                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/ver.png') }}">
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('vehiculos.edit')
                                        <a href="{{ route('vehiculos.edit', $item) }}">
                                            <img class="img-responsive img-rounded float-right" src="{{ asset('images/actualizar.png') }}">
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('vehiculos.destroy')
                                        {!! Form::open(['route' => ['vehiculos.destroy', $item->id],
                                        'method' => 'DELETE']) !!}
                                            <input type=image src="{{ asset('images/basura.png') }}">
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $vehiculo->links() }}
                {{-- fin card body --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
