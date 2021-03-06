@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Lista de Mantenimientos</b></h4></span>
                    <a href="{{ route('mantenimientos.index') }}">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr class="table-secondary">
                                <th></th>
                                <th scope="col" width="100px"><div class="text-center">Nro. Ficha</div></th>
                                <th scope="col" width="200px"><div class="text-center">Fecha de Ingreso</div></th>
                                <th scope="col" width="200px"><div class="text-center">Fecha de Egreso</div></th>
                                <th scope="col" width="100px"><div class="text-center">Estado</div></th>
                                <th scope="col" width="150px"><div class="text-center">Valor Total</div></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mantenimiento->get() as $item)
                            <tr>
                                <th scope="row"><i>{{ $loop->iteration }}</i></th>
                                <th scope="row"><div class="text-center">{{ $item->nro_ficha }}</div></th>
                                <td><div class="text-center">{{ $item->fecha_ingreso }}</div></td>
                                <td><div class="text-center">{{ $item->fecha_egreso }}</div></td>
                                <td><div class="text-center">{{ $item->estado }}</div></td>
                                <td><div class="text-center">{{ $item->valor_total }}</div></td>
                                <td>
                                    @can('mantenimientos.show')
                                        <a href="{{ route('mantenimientos.show', $item) }}">
                                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/ver.png') }}" title="Ver Detalle">
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
