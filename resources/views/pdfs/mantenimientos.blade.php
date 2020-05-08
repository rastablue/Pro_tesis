@extends('layouts.pdf')

@section('content')
<br><br>
@if ($mantenimiento->vehiculo_id)
    <h5><b> Mantenimiento del vehiculo: </b></h5>{{ $mantenimiento->vehiculos->placa }} <br>
@else
    <h5><b> Mantenimiento del vehiculo: </b></h5>N/A <br>
@endif
<h5><b> Fecha de emision: </b></h5>{{ Carbon\Carbon::now() }} <br><br><br><br><br>
<hr class="sidebar-divider">
<h4 class="font-weight-bold text-success"><b> Mantenimiento</b></h4>
<table class="table">
    <thead>
        <tr class="table-secondary">
            <th scope="col" width="80px"><div class="text-center font-weight-bold text-info">Codigo</th>
            <th scope="col" width="130px"><div class="text-center font-weight-bold text-info">Fecha de Ingreso</th>
            <th scope="col" width="120px"><div class="text-center font-weight-bold text-info">Fecha de Egreso</th>
            <th scope="col" width="120px"><div class="text-center font-weight-bold text-info">Monto Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><div class="text-center">{{ $mantenimiento->nro_ficha }}</td>
            <td><div class="text-center">{{ $mantenimiento->fecha_ingreso }}</td>
            <td><div class="text-center">{{ $mantenimiento->fecha_egreso }}</td>
            <td><div class="text-center">{{ $mantenimiento->valor_total }}</td>
        </tr>
        <tr>
            <br><br>
            <th scope="col"><div class="text-center font-weight-bold text-info"><br>Observaciones:</th>
            <td scope="col" colspan="3"> <br>{{ $mantenimiento->observacion }} <br><br></td>
        </tr>
        <tr>
            <th scope="col"><div class="text-center font-weight-bold text-info">Diagnostico:</th>
            <td scope="col" colspan="3"> {{ $mantenimiento->diagnostico }} <br><br></td>
        </tr>
    </tbody>
</table>

<hr class="sidebar-divider">

<h4 class="font-weight-bold text-success"><b> Vehiculo</b></h4>

@if ($mantenimiento->vehiculo_id)
    <table class="table">
        <thead>
            <tr class="table-secondary" style="font-size: 9">
                <th scope="col" width="80px"><div class="text-center font-weight-bold text-info">Placa</th>
                <th scope="col" width="80px"><div class="text-center font-weight-bold text-info">Marca</th>
                <th scope="col" width="100px"><div class="text-center font-weight-bold text-info">Modelo</th>
                <th scope="col" width="100px"><div class="text-center font-weight-bold text-info">Tipo</th>
                <th scope="col" width="100px"><div class="text-center font-weight-bold text-info">Kilometraje</th>
            </tr>
        </thead>
        <tbody>
            <tr style="font-size: 9">
                <td><div class="text-center">{{ $mantenimiento->vehiculos->placa }}</td>
                    @if ($mantenimiento->vehiculos->marca_id)
                        <td><div class="text-center">{{ $mantenimiento->vehiculos->marcas->marca }}</td>
                    @else
                        <td><div class="text-center">N/A</td>
                    @endif
                <td><div class="text-center">{{ $mantenimiento->vehiculos->modelo }}</td>
                <td><div class="text-center">{{ $mantenimiento->vehiculos->tipo_vehiculo }}</td>
                <td><div class="text-center">{{ $mantenimiento->vehiculos->kilometraje }}</td>
            </tr>
            <tr>
                <br><br>
                <th scope="col"><div class="text-center font-weight-bold text-info"><br>Observaciones:</th>
                <td scope="col" colspan="4"><br>{{ $mantenimiento->vehiculos->observacion }}</td>
            </tr>
        </tbody>
    </table>
@else
    VEHICULO NO DISPONIBLE
@endif


<hr class="sidebar-divider">
<br><br><br><br><br><br><br><br>
@if(@$mantenimiento->trabajos->first())
    <h4 class="font-weight-bold text-success"><b> Trabajos </b></h4>
    <table class="table">
        <tbody>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">N°</th>
                    @foreach (@$mantenimiento->trabajos as $item)
                        <td>{{ $loop->iteration }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Codigo</th>
                    @foreach (@$mantenimiento->trabajos as $item)
                        <td style="font-size: 8">{{ $item->fake_id }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">V. Mano de Obra</th>
                    @foreach (@$mantenimiento->trabajos as $item)
                        <td style="font-size: 8">{{ $item->costo_manobra }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">V. Repuestos</th>
                    @foreach (@$mantenimiento->trabajos as $item)
                        <td style="font-size: 8">{{ $item->costo_repuestos }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Tipo</th>
                    @foreach (@$mantenimiento->trabajos as $item)
                        <td style="font-size: 8">{{ $item->tipo }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Mano de Obra</th>
                    @foreach (@$mantenimiento->trabajos as $item)
                        <td style="font-size: 8">{{ $item->manobra }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Repuestos</th>
                    @foreach (@$mantenimiento->trabajos as $item)
                        <td style="font-size: 8">{{ $item->repuestos }}</td>
                    @endforeach
            </tr>
        </tbody>
    </table>
@endif
@endsection
