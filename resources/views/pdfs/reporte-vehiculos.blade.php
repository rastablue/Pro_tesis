@extends('layouts.pdf')

@section('content')
<br><br>
<h5><b> Reporte de vehiculos </b></h5>
<h5><b> Fecha de emision: </b></h5>{{ Carbon\Carbon::now() }} <br><br>
<hr class="sidebar-divider">
<h4 class="font-weight-bold text-success"><b> Vehiculos</b></h4>

<table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col" width="60px"><div class="text-center font-weight-bold text-info">Placa</th>
            <th scope="col" width="70px"><div class="text-center font-weight-bold text-info">Tipo</th>
            <th scope="col" width="90px"><div class="text-center font-weight-bold text-info">Marca / Modelo</th>
            <th scope="col" width="140px"><div class="text-center font-weight-bold text-info">Cliente</th>
            <th scope="col" width="140px"><div class="text-center font-weight-bold text-info">Observacion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vehiculo as $vehiculos)
            <tr>
                <td><div class="text-center">{{ $vehiculos->placa }}</td>
                <td><div class="text-center">{{ $vehiculos->tipo_vehiculo }}</td>
                    @if ($vehiculos->marca_id)
                        <td><div class="text-center">{{ $vehiculos->marcas->marca }} / {{ $vehiculos->modelo }}</td>
                    @else
                        <td><div class="text-center">N/A / {{ $vehiculos->modelo }}</td>
                    @endif
                    @if ($vehiculos->cliente_id)
                        <td><div class="text-center">{{ $vehiculos->clientes->name }} {{ $vehiculos->clientes->apellido_pater }}</td>
                    @else
                        <td><div class="text-center">N/A</td>
                    @endif
                <td><div class="text-center">{{ $vehiculos->observacion }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
