@extends('layouts.pdf')

@section('content')
<br><br>
<h5><b> Reporte de trabajos </b></h5>
<h5><b> Fecha de emision: </b></h5>{{ Carbon\Carbon::now() }} <br><br>
<hr class="sidebar-divider">
<h4 class="font-weight-bold text-success"><b>Trabajos</b></h4>

<table class="table">
    <thead>
        <tr class="table-secondary" style="font-size: 9">
            <th scope="col" width="70px"><div class="text-center font-weight-bold text-info">Codigo</th>
            <th scope="col" width="80px"><div class="text-center font-weight-bold text-info">Mantenimiento</th>
                <th scope="col" width="70px"><div class="text-center font-weight-bold text-info">Placa</th>
            <th scope="col" width="130px"><div class="text-center font-weight-bold text-info">Mano De Obra</th>
            <th scope="col" width="130px"><div class="text-center font-weight-bold text-info">Repuestos</th>
            <th scope="col" width="60px"><div class="text-center font-weight-bold text-info">Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($trabajo as $trabajos)
            <tr style="font-size: 8">
                <td><div class="text-center">{{ $trabajos->fake_id }}</td>
                <td><div class="text-center">{{ $trabajos->mantenimientos->nro_ficha }}</td>
                @if ($trabajos->mantenimientos->vehiculo_id)
                    <td><div class="text-center">{{ $trabajos->mantenimientos->vehiculos->placa }}</td>
                @else
                    <td><div class="text-center">N/A</td>
                @endif
                <td><div class="text-center">{{ $trabajos->manobra }}</td>
                <td><div class="text-center">{{ $trabajos->repuestos }}</td>
                <td><div class="text-center">{{ $trabajos->estado }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
