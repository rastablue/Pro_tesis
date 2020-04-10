@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="row mt-3 mb-3 ml-2 mr-2">
                    {{-- Menu de opciones --}}
                        <div class="col-3">

                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Mantenimiento: <i>{{ $mantenimiento->nro_ficha }}</i></a>
                                @if ($mantenimiento->vehiculo_id)
                                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Vehiculo: <i>{{ $mantenimiento->vehiculos->placa }}</i></a>
                                @else
                                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Vehiculo: <i>N/A</i></a>
                                @endif
                                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Trabajos</a>
                            </div>

                        </div>

                    {{-- Container de opciones --}}
                        <div class="card-body col-9">

                            <div class="tab-content" id="v-pills-tabContent">
                                {{-- Mantenimientos --}}
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                                            {{-- Codigo --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Mantenimiento</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $mantenimiento->nro_ficha }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                    </div>
                                                </div>

                                            {{-- Fecha Ingreso --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha Ingreso</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $mantenimiento->fecha_ingreso }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                    </div>
                                                </div>

                                            {{-- Fecha Egreso --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha Egreso</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $mantenimiento->fecha_egreso }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                    </div>
                                                </div>

                                            {{-- Observacion --}}
                                                <div class="form-group row">
                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                                    <div class="col-md-6">
                                                        <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $mantenimiento->observacion }} </textarea>
                                                    </div>
                                                </div>

                                            {{-- Diagnostico --}}
                                                <div class="form-group row">
                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">Diagnostico</label>
                                                    <div class="col-md-6">
                                                        <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $mantenimiento->diagnostico }} </textarea>
                                                    </div>
                                                </div>


                                            {{-- Valor Total --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Valor Total</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $mantenimiento->valor_total }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                    </div>
                                                </div>

                                            {{-- Valor Total --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Estado</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $mantenimiento->estado }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                    </div>
                                                </div>

                                            {{-- btn --}}
                                                <div class="form-group row mb-0">
                                                    @if ($mantenimiento->estado != 'Finalizado')
                                                        <div class="align-maquinarias-center col-md-6 offset-md-5">
                                                            @can('mantenimientos.show')
                                                                <button type="button" id="btnVerArchivo" class="btn btn-success btn-sm">
                                                                    <i class="fas fa-fw fa-image"></i>
                                                                    Archivo
                                                                </button>
                                                            @endcan
                                                            @can('mantenimientos.edit')
                                                                <button type="button" id="btnFinalizaMantenimientoModal" class="btn btn-secondary btn-sm">
                                                                    Finalizar
                                                                </button>
                                                                <a href=" {{ route('mantenimientos.pdf', Hashids::encode($mantenimiento->id)) }} " class="btn btn-sm btn-info">
                                                                    <i class="fas fa-fw fa-file-alt"></i>
                                                                    PDF
                                                                </a>
                                                                <a href="{{ route('mantenimientos.edit', Hashids::encode($mantenimiento->id)) }}" class="btn btn-sm btn-warning">
                                                                    <i class="fas fa-fw fa-pen"></i>
                                                                    Editar
                                                                </a>
                                                            @endcan
                                                        </div>
                                                    @else
                                                        <div class="align-maquinarias-center col-md-6 offset-md-6">
                                                            @can('mantenimientos.show')
                                                                <button type="button" id="btnVerArchivo" class="btn btn-success btn-sm">
                                                                    <i class="fas fa-fw fa-image"></i>
                                                                    Archivo
                                                                </button>
                                                            @endcan
                                                            <a href=" {{ route('mantenimientos.pdf', Hashids::encode($mantenimiento->id)) }} " class="btn btn-sm btn-info">
                                                                <i class="fas fa-fw fa-file-alt"></i>
                                                                PDF
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>

                                    </div>

                                {{-- Vehiculo --}}
                                    @if ($mantenimiento->vehiculo_id)
                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

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
                                                    <div  class="text-center"><a href="{{ route('vehiculos.show', Hashids::encode($mantenimiento->vehiculos->id)) }}">Este vehiculo posee {{ $mantenimiento->vehiculos->mantenimientos->count() }} mantenimiento(s)</a></div>
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
                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        <div class="cardScroll">
                                            @if ($mantenimiento->estado != 'Finalizado')
                                                @can('trabajos.create')
                                                    <div class="text-right mb-2">
                                                        <a href="{{ route('trabajos.show', Hashids::encode($mantenimiento->id)) }}" class="btn btn-sm btn-success">
                                                            <i class="fas fa-address-book"></i>
                                                            Agregar Trabajo
                                                        </a>
                                                    </div>
                                                @endcan
                                            @endif
                                            @foreach (App\Mantenimiento::findOrFail($mantenimiento->id)->trabajos as $item)

                                                <div class="card mb-1">

                                                    <!-- Card Header - Accordion -->
                                                        <a href="#collapseCard{{ $loop->iteration }}" class="d-block card-header py-2 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                            <button class="btn " data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapseOne">
                                                                {{ $item->fake_id }}
                                                            </button>
                                                        </a>

                                                    <!-- Card Content - Collapse -->
                                                        <div class="collapse hide" id="collapseCard{{ $loop->iteration }}">
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

                                                                {{-- btn--}}
                                                                    <div class="form-group row mb-0">
                                                                        @if ($item->estado != 'Finalizado')
                                                                            <div class="col-md-6 offset-md-5">
                                                                                @can('trabajos.edit')
                                                                                    <a href="{{ route('trabajos.edit', Hashids::encode($item->id)) }}" class="btn btn-sm btn-warning">
                                                                                        <i class="fas fa-fw fa-pen"></i>
                                                                                        Editar
                                                                                    </a>
                                                                                @endcan
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                            </div>
                                                        </div>
                                                </div>

                                            @endforeach
                                        </div>
                                    </div>

                            </div>

                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Finalizar Mantenimiento Modal -->
    <div class="modal fade" id="finalizaMantenimientoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5><b>Finalizar Mantenimiento</b></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h6 align="center">
                            Finalizar este mantenimiento tambien finalizara todos los trabajos vinculados y ya no se podran editar sus datos.
                            <br><br><b>¿Desea finalizar el mantenimiento?</b></h6>
                    </div>
                    <form id="formFinalizar" method="POST" action="{{ route('mantenimientos.finalizarfrom', $mantenimiento->id) }}">
                        @method('PUT')
                        @csrf
                    </form>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" form="formFinalizar" class="btn btn-warning">Finalizar</button>
                    </div>
            </div>
        </div>
    </div>

<!-- Modal Ver Archivo -->
    <div class="modal fade" id="verArchivoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                @if ($mantenimiento->path)
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Archivo de Ficha</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <img class="img-responsive img-rounded" src="{{ $mantenimiento->url_path }}">
                @else
                    <div class="card-body">
                        <h5>No se ha encontrado el archivo!</h5>
                        @can('mantenimientos.edit')
                            <h5><a href="{{ route('mantenimientos.edit', Hashids::encode($mantenimiento->id)) }}">cargar...</a></h5>
                        @endcan
                    </div>
                @endif

            </div>
        </div>
    </div>

@stop

@push('scripts')
<script>
    $(function() {
        $(document).ready(function(){
            // modal crear
                $("#btnVerArchivo").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#verArchivoModal").modal("show");
                });

            // modal finalizar mantenimiento
                $("#btnFinalizaMantenimientoModal").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#finalizaMantenimientoModal").modal("show");
                });

            // modal finalizar trabajo
                $("#btnFinalizaTrabajoModal").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#finalizaTrabajoModal").modal("show");
                });

        });

    });

</script>
@endpush
