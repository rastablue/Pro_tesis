@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Lista de Marcas</b></h4></span>
                    <!-- Cuadro Buscar  -->
                    @can('marcas.create')
                        <div class="sidebar-search">
                            <div>
                                <div class="input-group">
                                <a class="btn btn-primary btn-sm" href=" {{ route('marcas.create') }} ">Agregar</a>
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
                                <th scope="col" width="500px"><div class="text-center">Marca</div></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marcas as $item)
                            <tr>
                                <th scope="row"><i>{{ $loop->iteration }}</i></th>
                                <td><div class="text-center">{{ $item->marca }}</div></td>
                                <td>
                                    @can('marcas.edit')
                                        <a href="{{ route('marcas.edit', Hashids::encode($item->id)) }}">
                                            <img class="img-responsive img-rounded float-right" src="{{ asset('images/actualizar.png') }}" title="Actualizar">
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('marcas.destroy')
                                        {!! Form::open(['route' => ['marcas.destroy', $item->id],
                                        'method' => 'DELETE']) !!}
                                            <input type=image src="{{ asset('images/basura.png') }}" title="Eliminar">
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $marcas->links() }}
                {{-- fin card body --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
