@extends('layouts.app')

@section('content')

<!-- Tabla de Mantenimientos -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4><b>Detalles del Mantenimiento:</b><i> {{ $mantenimiento->nro_ficha }}</i></h4></span>
                        <a href="{{ route('mantenimientos.index') }}">
                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                        </a>
                    </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                                <tr class="table-secondary">
                                    <th scope="col"><div class="text-center">Nro. Ficha</div></th>
                                    <th scope="col" width="210px"><div class="text-center">Fecha de Ingreso</div></th>
                                    <th scope="col" width="210px"><div class="text-center">Decha de Egreso</div></th>
                                    <th scope="col" width="210px"><div class="text-center">Estado</div></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><div class="text-center">{{ $mantenimiento->nro_ficha }}</div></th>
                                    <td><div class="text-center">{{ $mantenimiento->fecha_ingreso }}</div></td>
                                    <td><div class="text-center">{{ $mantenimiento->fecha_egreso }}</div></td>
                                    <td><div class="text-center">{{ $mantenimiento->estado }}</div></td>
                                </tr>
                                <thead>
                                    <tr class="table-info">
                                        <th scope="col" colspan="5">Observaciones:</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td colspan="5"> {{ $mantenimiento->observacion }} </td>
                                </tr>
                                <thead>
                                    <tr class="table-info">
                                        <th scope="col" colspan="5">Diagnostico:</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td colspan="5"> {{ $mantenimiento->diagnostico }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Tabla de los Vehiculos -->
    @foreach (App\Mantenimiento::findOrFail($mantenimiento->id)->vehiculos->where('id', $mantenimiento->vehiculo_id)->get() as $vehiculo)
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-users-center">
                            <span><h4><b>Detalles del Vehiculo: </b><i>{{ $vehiculo->placa}}</i></h4></span>
                            @can('vehiculos.show')
                                        <a href="{{ route('vehiculos.show', $vehiculo) }}">
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
                                        <th><div class="text-center"> {{ $vehiculo->placa }} </th>
                                        <td><div class="text-center"> {{ $vehiculo->marca }} </td>
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
    @endforeach

<!-- Tabla de los Trabajos -->
    @foreach (App\Mantenimiento::findOrFail($mantenimiento->id)->trabajos as $trabajo)
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-users-center">
                            <span><h4><b>Detalles del Trabajo: </b><i>{{ $loop->iteration}}</i></h4></span>
                            @can('trabajos.edit')
                                <a href="{{ route('trabajos.edit', $trabajo->id) }}">
                                    <img class="img-responsive img-rounded float-right" src="{{ asset('images/actualizar.png') }}">
                                </a>
                            @endcan
                            @can('trabajos.destroy')
                                {!! Form::open(['route' => ['trabajos.destroy', $trabajo->id],
                                'method' => 'DELETE']) !!}
                                    <input type=image src="{{ asset('images/basura.png') }}">
                                {!! Form::close() !!}
                            @endcan
                        </div>
                        <div class="card-body">
                            <table class="table table">
                                <tbody>
                                    <tr>
                                        <td scope="col" class="bg-info"  width="260px"><div><h5><b>Mano de Obra:</b></h5></div></td>
                                        <td width="600px"><div> {{ $trabajo->manobra }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="bg-info"><div><h5><b>Repuestos:</b></h5></div></td>
                                        <td width="600px"><div> {{ $trabajo->repuestos }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="bg-info"><div><h5><b>Costo de Repuestos:</b></h5></div></td>
                                        <td width="600px"><div> {{ $trabajo->costo_repuestos }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="bg-info"><div><h5><b>Costo de Mano de Obra:</b></h5></div></td>
                                        <td width="600px"><div> {{ $trabajo->costo_manobra }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="bg-info"><div><h5><b>Estado:</b></h5></div></td>
                                        <td width="600px"><div> {{ $trabajo->estado }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="bg-info"><div><h5><b>Tipo de Trabajo:</b></h5></div></td>
                                        <td width="600px"><div> {{ $trabajo->tipo }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="bg-info"><div><h5><b>Empleado Encargado:</b></h5></div></td>
                                        <td width="600px"><div> {{ $trabajo->empleados->users->name }}  {{ $trabajo->empleados->users->apellido_pater }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
