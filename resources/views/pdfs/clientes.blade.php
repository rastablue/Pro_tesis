@extends('layouts.pdf')

@section('content')
<br><br>
<h5><b>Cliente: </b></h5>{{ $cliente->name }} {{ $cliente->apellido_pater }} <br><br>
<h5><b> Fecha de emision: </b></h5>{{ Carbon\Carbon::now() }} <br><br>
<hr class="sidebar-divider">
<h4 class="font-weight-bold text-success"><b>Cliente</b></h4>

<table class="table">
    <thead>
        <tr class="table-secondary" style="font-size: 9">
            <th scope="col"><div class="text-center font-weight-bold text-info">Cedula</th>
            <th scope="col"><div class="text-center font-weight-bold text-info">Nombre</th>
            <th scope="col"><div class="text-center font-weight-bold text-info">Telefono</th>
            <th scope="col"><div class="text-center font-weight-bold text-info">Direccion</th>
            <th scope="col"><div class="text-center font-weight-bold text-info">E-Mail</th>
        </tr>
    </thead>
    <tbody>
        <tr style="font-size: 8">
            <td><div class="text-center">{{ $cliente->cedula }}</td>
            <td><div class="text-center">{{ $cliente->name }} {{ $cliente->apellido_pater }}</td>
            <td><div class="text-center">{{ $cliente->tlf }}</td>
            <td><div class="text-center">{{ $cliente->direc }}</td>
            <td><div class="text-center">{{ $cliente->email }}</td>
        </tr>
    </tbody>
</table>

<hr class="sidebar-divider">

@if(@$cliente->vehiculos->first())
    <h4 class="font-weight-bold text-success"><b> vehiculos </b></h4>
    <table class="table">
        <tbody>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">N°</th>
                    @foreach (@$cliente->vehiculos as $item)
                        <td>{{ $loop->iteration }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Placa</th>
                    @foreach (@$cliente->vehiculos as $item)
                        <td style="font-size: 8">{{ $item->placa }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Marca</th>
                    @foreach (@$cliente->vehiculos as $item)
                        @if ($item->marca_id)
                            <td style="font-size: 8">{{ $item->marcas->marca }}</td>
                        @else
                            <td>N/A</td>
                        @endif
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Modelo</th>
                    @foreach (@$cliente->vehiculos as $item)
                        <td style="font-size: 8">{{ $item->modelo }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Kilometraje</th>
                    @foreach (@$cliente->vehiculos as $item)
                        <td style="font-size: 8">{{ $item->kilometraje }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Observacion</th>
                    @foreach (@$cliente->vehiculos as $item)
                        <td style="font-size: 8">{{ $item->observacion }}</td>
                    @endforeach
            </tr>
        </tbody>
    </table>
@endif
@endsection
