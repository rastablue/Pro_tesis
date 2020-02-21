@extends('layouts.app')

@section('content')

<!-- Tabla de los Trabajos -->
    @foreach ($trabajos as $trabajo)
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header d-flex justify-content-between align-users-center bg-success">
                            <span><h4><b>Detalles del Trabajo: </b><i>{{ $loop->iteration}}</i></h4></span>
                            @can('trabajos.edit')
                                <a href="javascript:history.back()">
                                    <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                                </a>
                            @endcan
                            @can('trabajos.destroy')
                                {!! Form::open(['route' => ['trabajos.destroy', $trabajo->id],
                                'method' => 'DELETE']) !!}
                                    <input type=image src="{{ asset('images/basura.png') }}" title="Eliminar">
                                {!! Form::close() !!}
                            @endcan
                        </div>
                        <div class="card-body">
                            <table class="table table">
                                <tbody>
                                    <tr>
                                        <td scope="col" width="260px"><div><h5><b>Mano de Obra:</b></h5></div></td>
                                        <td width="600px"><div> {{ $trabajo->manobra }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="table-secondary"><div><h5><b>Repuestos:</b></h5></div></td>
                                        <td width="600px" class="table-secondary"><div> {{ $trabajo->repuestos }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="col"><div><h5><b>Costo de Repuestos:</b></h5></div></td>
                                        <td width="600px"><div> {{ $trabajo->costo_repuestos }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="table-secondary"><div><h5><b>Costo de Mano de Obra:</b></h5></div></td>
                                        <td width="600px" class="table-secondary"><div> {{ $trabajo->costo_manobra }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="col"><div><h5><b>Estado:</b></h5></div></td>
                                        <td width="600px"><div> {{ $trabajo->estado }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="table-secondary"><div><h5><b>Tipo de Trabajo:</b></h5></div></td>
                                        <td width="600px" class="table-secondary"><div> {{ $trabajo->tipo }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="col"><div><h5><b>Empleado Encargado:</b></h5></div></td>
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
