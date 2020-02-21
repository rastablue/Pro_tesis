@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Lista de Trabajos</b></h4></span>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr class="table-secondary">
                                <th></th>
                                <th scope="col" width="100px"><div class="text-center">Nro. Ficha</div></th>
                                <th scope="col" width="300px"><div class="text-center">Mano de Obra</div></th>
                                <th scope="col" width="100px"><div class="text-center">Tipo</div></th>
                                <th scope="col" width="300px"><div class="text-center">Encargado</div></th>
                                <th width="50px"></th>
                                <th width="50px"></th>
                                <th width="50px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trabajos as $item)
                            <tr>
                                <th scope="row"  width="50px"><i>{{ $loop->iteration }}</i></th>
                                <th scope="row"><div class="text-center">{{ $item->mantenimientos->nro_ficha }}</div></th>
                                <td><div class="text-center">{{ $item->manobra }}</div></td>
                                <td><div class="text-center">{{ $item->tipo }}</div></td>
                                <td><div class="text-center">{{ $item->empleados->users->name }}  {{ $item->empleados->users->apellido_pater }}</div></td>
                                <td>
                                    @can('mantenimientos.show')
                                        <a href="{{ route('mantenimientos.show', $item->mantenimientos->id) }}">
                                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/ver.png') }}" title="Ver Detalles">
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('trabajos.edit')
                                        <a href="{{ route('trabajos.edit', $item) }}">
                                            <img class="img-responsive img-rounded float-right" src="{{ asset('images/actualizar.png') }}" title="Actualizar">
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('trabajos.destroy')
                                        {!! Form::open(['route' => ['trabajos.destroy', $item],
                                        'method' => 'DELETE']) !!}
                                            <input type=image src="{{ asset('images/basura.png') }}" title="Eliminar">
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $trabajos->links() }}
                {{-- fin card body --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
