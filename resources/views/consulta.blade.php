@extends('layouts.appTran')

@section('content')
    <div class="container">
        
        <div>

            <div class="container">
    
                <!-- Outer Row -->
                <div class="row justify-content-center">
            
                    <div class="col-xl-10 col-lg-12 col-md-9">
            
                        <div class="card">
                            <div class="row mt-3 mb-3 ml-2 mr-2">
                                {{-- Menu de opciones --}}
                                    <div class="col-3">
            
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Mantenimiento</a>
                                            <a class="nav-link" id="v-pills-vehiculo-tab" data-toggle="pill" href="#v-pills-vehiculo" role="tab" aria-controls="v-pills-vehiculo" aria-selected="false">Vehiculo</i></a>
                                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Cliente</i></a>
                                            <a class="nav-link" id="v-pills-cliente-tab" data-toggle="pill" href="#v-pills-cliente" role="tab" aria-controls="v-pills-cliente" aria-selected="true">Trabajos</a>
                                            <a href="javascript:history.back()" class="btn btn-dark mt-5">Realizar otra consulta...</a>
                                        </div>
            
            
                                    </div>
            
                                {{-- Container de opciones --}}
                                    <div class="card-body col-9">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            {{-- mantenimientos --}}
                                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        
                                                    {{-- Codigo --}}
                                                        <div class="form-group row">
                                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo</label>
                                                            <div class="col-md-6">
                                                                <input id="codigo" type="text" class="form-control" disabled value=" {{ $mantenimiento->nro_ficha }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                            </div>
                                                        </div>
    
                                                    {{-- Fecha ingreso --}}
                                                        <div class="form-group row">
                                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Ingreso</label>
                                                            <div class="col-md-6">
                                                                <input id="codigo" type="text" class="form-control" disabled value=" {{ $mantenimiento->fecha_ingreso }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                            </div>
                                                        </div>
    
                                                    {{-- Fecha Egreso --}}
                                                        <div class="form-group row">
                                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Egreso</label>
                                                            <div class="col-md-6">
                                                                <input id="codigo" type="text" class="form-control" disabled value=" {{ $mantenimiento->fecha_egreso }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                            </div>
                                                        </div>

                                                    {{-- Total a pagar --}}
                                                        <div class="form-group row">
                                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Valor Total</label>
                                                            <div class="col-md-6">
                                                                <input id="codigo" type="text" class="form-control" disabled value=" {{ $mantenimiento->valor_total }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                            </div>
                                                        </div>
    
                                                    {{-- Diagnostico --}}
                                                        <div class="form-group row">
                                                            <label for="detalle" class="col-md-4 col-form-label text-md-right">Diagnostico</label>
                                                            <div class="col-md-6">
                                                                <textarea id="detalle" type="text" class="form-control" disabled placeholder=" {{ $mantenimiento->diagnostico }}" name="detalle" required autocomplete="detalle" autofocus></textarea>
                                                            </div>
                                                        </div>
    
                                                    {{-- Observacion --}}
                                                        <div class="form-group row">
                                                            <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                                            <div class="col-md-6">
                                                                <textarea id="obsservacion" type="text" class="form-control" disabled placeholder=" {{ $mantenimiento->observacion }}" name="observacion"></textarea>
                                                            </div>
                                                        </div>
    
                                                    {{-- Estado --}}
                                                        <div class="form-group row">
                                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Estado mantenimiento</label>
                                                            <div class="col-md-6">
                                                                @if (@$mantenimiento->estado == 'Finalizado')
                                                                    <input id="codigo" type="text" class="form-control bg-success text-light" disabled value="{{ $mantenimiento->estado }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                                @endif
                                                                @if (@$mantenimiento->estado == 'Inactivo')
                                                                    <input id="codigo" type="text" class="form-control bg-warning" disabled value="{{ $mantenimiento->estado }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                                @endif
                                                                @if (@$mantenimiento->estado == 'En espera')
                                                                    <input id="codigo" type="text" class="form-control bg-info text-light" disabled value="{{ $mantenimiento->estado }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                                @endif
                                                                @if (@$mantenimiento->estado == 'Activo')
                                                                    <input id="codigo" type="text" class="form-control bg-primary text-light" disabled value="{{ $mantenimiento->estado }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                                @endif
                                                            </div>
                                                        </div>
        
                                                </div>
        
                                            {{-- Cliente --}}
                                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
        
                                                    {{-- Cedula --}}
                                                        <div class="form-group row">
                                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Cedula del solicitante</label>
                                                            <div class="col-md-6">
                                                                <input id="codigo" type="text" class="form-control" disabled value="{{ $mantenimiento->vehiculos->clientes->cedula }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                            </div>
                                                        </div>
    
                                                    {{-- Nombre--}}
                                                        <div class="form-group row">
                                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Nombre del solicitante</label>
                                                            <div class="col-md-6">
                                                                <input id="codigo" type="text" class="form-control" disabled value="{{ $mantenimiento->vehiculos->clientes->name }} {{ $mantenimiento->vehiculos->clientes->apellido_pater }} {{ $mantenimiento->vehiculos->clientes->apellido_mater }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                            </div>
                                                        </div>
    
                                                    {{-- Direccion --}}
                                                        <div class="form-group row">
                                                            <label for="direc" class="col-md-4 col-form-label text-md-right">Direccion</label>
    
                                                            <div class="col-md-6">
                                                                <input id="direc" type="text" class="form-control" disabled value="{{ $mantenimiento->vehiculos->clientes->direc }}" name="direc" required autofocus>
                                                            </div>
                                                        </div>
    
                                                    {{-- Telefono --}}
                                                        <div class="form-group row">
                                                            <label for="tlf" class="col-md-4 col-form-label text-md-right">Telefono</label>
    
                                                            <div class="col-md-6">
                                                                <input id="tlf" type="text" class="form-control" disabled value="{{ $mantenimiento->vehiculos->clientes->tlf }}" name="tlf" required autofocus>
                                                            </div>
                                                        </div>
    
                                                    {{-- Email --}}
                                                        <div class="form-group row">
                                                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
    
                                                            <div class="col-md-6">
                                                                <input id="email" type="email" class="form-control" disabled value="{{ $mantenimiento->vehiculos->clientes->email }}" name="email" required autofocus>
                                                            </div>
                                                        </div>
        
                                                </div>
                                            
                                            {{-- Vehiculo --}}
                                                @if ($mantenimiento->vehiculo_id)
                                                    <div class="tab-pane fade" id="v-pills-vehiculo" role="tabpanel" aria-labelledby="v-pills-vehiculo-tab">

                                                        {{-- Placa --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Placa</label>
                                                                <div class="col-md-6">
                                                                    <input type="input" disabled value="{{ $mantenimiento->vehiculos->placa }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                </div>
                                                            </div>

                                                        {{-- Marca --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Marca</label>
                                                                <div class="col-md-6">
                                                                    @if ($mantenimiento->vehiculos->marca_id)
                                                                        <input type="input" disabled value="{{ $mantenimiento->vehiculos->marcas->marca }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                    @else
                                                                        <input type="input" disabled value="N/A" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        {{-- Modelo --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Modelo</label>
                                                                <div class="col-md-6">
                                                                    <input type="input" disabled value="{{ $mantenimiento->vehiculos->modelo }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                </div>
                                                            </div>

                                                        {{-- Color --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Color</label>
                                                                <div class="col-md-6">
                                                                    <input type="input" disabled value="{{ $mantenimiento->vehiculos->color }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                </div>
                                                            </div>

                                                        {{-- Kilometraje --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Kilometraje</label>
                                                                <div class="col-md-6">
                                                                    <input type="input" disabled value="{{ $mantenimiento->vehiculos->kilometraje }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                </div>
                                                            </div>

                                                        {{-- Tipo --}}
                                                            <div class="form-group row">
                                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Tipo</label>
                                                                <div class="col-md-6">
                                                                    <input type="input" disabled value="{{ $mantenimiento->vehiculos->tipo_vehiculo }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                </div>
                                                            </div>

                                                        {{-- Observacion --}}
                                                            <div class="form-group row">
                                                                <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                                                <div class="col-md-6">
                                                                    <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $mantenimiento->vehiculos->observacion }} </textarea>
                                                                </div>
                                                            </div>

                                                        {{-- Link a vehiculos.show --}}
                                                            @can('vehiculos.show')
                                                                <div  style="margin-left: 300px"><a href="{{ route('vehiculos.show', Hashids::encode($mantenimiento->vehiculos->id)) }}">Este vehiculo posee {{ $mantenimiento->vehiculos->mantenimientos->count() }} mantenimiento(s)</a></div>
                                                            @endcan

                                                        {{-- btn--}}
                                                            <div class="form-group row mb-0">
                                                                <div class="align-items-center col-md-6 offset-md-6">
                                                                    @can('vehiculos.edit')
                                                                        <a href="{{ route('vehiculos.edit', Hashids::encode($mantenimiento->vehiculos->id)) }}" class="btn btn-sm btn-warning">
                                                                            <i class="fas fa-fw fa-pen"></i>
                                                                            Editar
                                                                        </a>
                                                                    @endcan
                                                                </div>
                                                            </div>

                                                    </div>
                                                @else
                                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-12 col-md-offset-13">
                                                                    <div class="alert alert-danger">
                                                                        <h6>Es posible que este vehiculo haya sido eliminado!</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                @endif
        
                                            {{-- Trabajos --}}
                                                <div class="tab-pane fade" id="v-pills-cliente" role="tabpanel" aria-labelledby="v-pills-cliente-tab">
                                                    <div id="accordion">
                                                    @if(@$mantenimiento->trabajos->first())
                                                        @foreach (@App\mantenimiento::findOrFail($mantenimiento->id)->trabajos as $item)
    
                                                            <div class="col-lg-12">
                                                                <div class="card shadow mb-4">
                                                                        
                                                                    <div class="card">
                                                                        <div class="card-header" id="headingOne">
                                                                            <h5 class="font-weight-bold text-primary">
                                                                                <button class="btn btn-link btn-sm" data-toggle="collapse" data-target="#collapseOne{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapseOne">
                                                                                    Datos del Trabajo:
                                                                                    <h6 class="mb-0 font-weight-bold text-dark">
                                                                                        <i>{{ $item->fake_id}}</i>
                                                                                    </h6>
                                                                                </button>
                                                                            </h5>
                                                                        </div>
                                                                    
                                                                        <div id="collapseOne{{ $loop->iteration }}" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
                                                                            <div class="card-body">
                                                                                {{-- Codigo Trabajo --}}
                                                                                    <div class="form-group row">
                                                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Trabajo</label>
                                                                                        <div class="col-md-6">
                                                                                            <input type="input" disabled value="{{ $item->fake_id }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                                        </div>
                                                                                    </div>

                                                                                {{-- Mano de Obra --}}
                                                                                    <div class="form-group row">
                                                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Mano De Obra</label>
                                                                                        <div class="col-md-6">
                                                                                            <textarea type="text" disabled class="form-control" required autocomplete="direccion" autofocus> {{ $item->manobra }} </textarea>
                                                                                        </div>
                                                                                    </div>

                                                                                {{-- Repuestos --}}
                                                                                    <div class="form-group row">
                                                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Repuestos</label>
                                                                                        <div class="col-md-6">
                                                                                            <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $item->repuestos }} </textarea>
                                                                                        </div>
                                                                                    </div>

                                                                                {{-- Costo Mano De Obra --}}
                                                                                    <div class="form-group row">
                                                                                        <label for="detalle" class="col-md-4 col-form-label text-md-right">Costo De Mano De Obra</label>
                                                                                        <div class="col-md-6">
                                                                                            <input type="input" disabled value="{{ $item->costo_manobra }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                                        </div>
                                                                                    </div>

                                                                                {{-- Costo Repuestos --}}
                                                                                    <div class="form-group row">
                                                                                        <label for="detalle" class="col-md-4 col-form-label text-md-right">Costo De Repuestos</label>
                                                                                        <div class="col-md-6">
                                                                                            <input type="input" disabled value="{{ $item->costo_repuestos }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                                        </div>
                                                                                    </div>

                                                                                {{-- Estado --}}
                                                                                    <div class="form-group row">
                                                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Estado</label>
                                                                                        <div class="col-md-6">
                                                                                            <input type="input" disabled value="{{ $item->estado }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                                        </div>
                                                                                    </div>

                                                                                {{-- Tipo --}}
                                                                                    <div class="form-group row">
                                                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Tipo De Mantenimiento</label>
                                                                                        <div class="col-md-6">
                                                                                            <input type="input" disabled value="{{ $item->tipo }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                                        </div>
                                                                                    </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                            
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="col-lg-12">
                                                            <div class="card shadow mb-4">
                                                                    
                                                                <div class="card">
                                                                    <div class="card-header" id="headingOne">
                                                                        <h5 class="font-weight-bold text-primary">
                                                                            <button class="btn btn-link btn-sm" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                                Datos del Trabajo:
                                                                                <h6 class="mb-0 font-weight-bold text-dark">
                                                                                    <i></i>
                                                                                </h6>
                                                                            </button>
                                                                        </h5>
                                                                    </div>
                                                                
                                                                    <div id="collapseOn" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                                        <div class="card-body">
                                                                            <em>No hay ningun trabajo disponible</em>
                                                                        
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
        
                                                </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
            
                    </div>
            
                </div>
            
            </div>
        </div>
    </div>

@endsection
