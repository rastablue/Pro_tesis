@extends('layouts.app')

@section('content')

<!-- Tabla de los Vehiculos -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-users-center">
                        <span><h4><b>Detalles del Vehiculo: </b><i>{{ $vehiculo->placa}}</i></h4></span>
                        <a href="javascript:history.back()">
                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                        </a>
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

<!-- Tabla del Cliente -->
    @foreach ($user as $item)

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span><h4><b>Detalles del Cliente:</b></h4></span>
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
                                        <th scope="row"><div class="text-center">{{ $item->cedula }}</div></th>
                                        <td><div class="text-center">{{ $item->name }}</div></td>
                                        <td><div class="text-center">{{ $item->apellido_pater }}    {{ $item->apellido_mater }}</div></td>
                                        <td><div class="text-center">{{ $item->direc }}</div></td>
                                        <td><div class="text-center">{{ $item->tlf }}</div></td>
                                        <td><div class="text-center">{{ $item->email }}</div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

<!-- Tabla de Mantenimientos -->
    @foreach (App\Vehiculo::findOrFail($vehiculo->id)->mantenimientos->all() as $item)

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span><h4><b>Detalles del Mantenimiento:</b><i> {{ $loop->iteration }}</i></h4></span>
                        </div>
                        <div class="card-body">

                            <table class="table">
                                <thead>
                                    <tr class="table-secondary">
                                        <th scope="col"><div class="text-center">Nro. Ficha</div></th>
                                        <th scope="col"><div class="text-center">Fecha de Ingreso</div></th>
                                        <th scope="col"><div class="text-center">Decha de Egreso</div></th>
                                        <th scope="col" width="210px"><div class="text-center">Estado</div></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row"><div class="text-center">{{ $item->nro_ficha }}</div></th>
                                        <td><div class="text-center">{{ $item->fecha_ingreso }}</div></td>
                                        <td><div class="text-center">{{ $item->fecha_egreso }}</div></td>
                                        <td><div class="text-center">{{ $item->estado }}</div></td>
                                    </tr>
                                    <thead>
                                        <tr class="table-info">
                                            <th scope="col" colspan="5">Observaciones:</th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td colspan="5"> {{ $item->observacion }} </td>
                                    </tr>
                                    <thead>
                                        <tr class="table-info">
                                            <th scope="col" colspan="5">Diagnostico:</th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td colspan="5"> {{ $item->diagnostico }} </td>
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
