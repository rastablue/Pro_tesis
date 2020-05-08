@extends('layouts.pdf')

@section('content')
<br><br>
<h5><b>Vehiculo: </b></h5>{{ $vehiculo->placa }}<br><br>
<h5><b> Fecha de emision: </b></h5>{{ Carbon\Carbon::now() }} <br><br>
<hr class="sidebar-divider">
<h4 class="font-weight-bold text-success"><b>Vehiculo</b></h4>

<table class="table">
    <thead>
        <tr class="table-secondary" style="font-size: 9">
            <th scope="col"><div class="text-center font-weight-bold text-info">Placa</div></th>
            <th scope="col"><div class="text-center font-weight-bold text-info">Marca</div></th>
            <th scope="col"><div class="text-center font-weight-bold text-info">Modelo</div></th>
            <th scope="col"><div class="text-center font-weight-bold text-info">Tipo</div></th>
            <th scope="col"><div class="text-center font-weight-bold text-info">Kilometraje</div></th>
        </tr>
    </thead>
    <tbody>
        <tr style="font-size: 8">
            <td><div class="text-center">{{ $vehiculo->placa }}</div></td>
            @if ($vehiculo->marca_id)
                <td><div class="text-center">{{ $vehiculo->marcas->marca }}</div></td>
            @else
                <td><div class="text-center">N/A</div></td>
            @endif
            <td><div class="text-center">{{ $vehiculo->modelo }}</div></td>
            <td><div class="text-center">{{ $vehiculo->tipo_vehiculo }}</div></td>
            <td><div class="text-center">{{ $vehiculo->kilometraje }}</div></td>
        </tr>
    </tbody>
</table>

<hr class="sidebar-divider">

@if(@$vehiculo->mantenimientos->first())
    <h4 class="font-weight-bold text-success"><b> Mantenimientos </b></h4>
    <table class="table">
        <tbody>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">N°</div></th>
                    @foreach (@$vehiculo->mantenimientos as $item)
                        <td>{{ $loop->iteration }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Codigo</div></th>
                    @foreach (@$vehiculo->mantenimientos as $item)
                        <td style="font-size: 8">{{ $item->nro_ficha }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Fecha de Ingreso</div></th>
                    @foreach (@$vehiculo->mantenimientos as $item)
                        <td style="font-size: 8">{{ $item->fecha_ingreso }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Fecha de Egreso</div></th>
                    @foreach (@$vehiculo->mantenimientos as $item)
                        <td style="font-size: 8">{{ $item->fecha_egreso }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Estado</div></th>
                    @foreach (@$vehiculo->mantenimientos as $item)
                        <td style="font-size: 8">{{ $item->estado }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Valor Total</div></th>
                    @foreach (@$vehiculo->mantenimientos as $item)
                        <td style="font-size: 8">{{ $item->valor_total }}</td>
                    @endforeach
            </tr>
            <tr>
                <th width="150px"><div class="font-weight-bold text-info">Diagnostico</div></th>
                    @foreach (@$vehiculo->mantenimientos as $item)
                        <td style="font-size: 8">{{ $item->diagnostico }}</td>
                    @endforeach
            </tr>
        </tbody>
    </table>
@endif
@endsection
