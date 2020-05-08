@extends('layouts.pdf')

@section('content')
<br><br>
<h5><b> Reporte de mantenimientos </b></h5>
<h5><b> Fecha de emision: </b></h5>{{ Carbon\Carbon::now() }} <br><br>
<hr class="sidebar-divider">
<h4 class="font-weight-bold text-success"><b> Mantenimientos</b></h4>

<table class="table">
    <thead>
        <tr class="table-secondary" style="font-size: 8">
            <th scope="col" width="40px"><div class="text-center font-weight-bold text-info">Codigo</th>
            <th scope="col" width="90px"><div class="text-center font-weight-bold text-info">Fecha de Ingreso</th>
            <th scope="col" width="90px"><div class="text-center font-weight-bold text-info">Fecha de Egreso</th>
            <th scope="col" width="70px"><div class="text-center font-weight-bold text-info">Monto Total</th>
            <th scope="col" width="50px"><div class="text-center font-weight-bold text-info">Estado</th>
            <th scope="col" width="100px"><div class="text-center font-weight-bold text-info">Diagnostico</th>
            <th scope="col" width="40px"><div class="text-center font-weight-bold text-info">Trabajos</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mantenimiento as $mantenimientos)
            <tr style="font-size: 7">
                <td><div class="text-center">{{ $mantenimientos->nro_ficha }}</td>
                <td><div class="text-center">{{ $mantenimientos->fecha_ingreso }}</td>
                <td><div class="text-center">{{ $mantenimientos->fecha_egreso }}</td>
                <td><div class="text-center">{{ $mantenimientos->valor_total }}</td>
                <td><div class="text-center">{{ $mantenimientos->estado }}</td>
                <td><div class="text-center">{{ $mantenimientos->diagnostico }}</td>
                <td><div class="text-center">{{ @$mantenimientos->trabajos->count() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
