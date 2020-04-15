@extends('layouts.app')

@section('content')

<!-- Tabla del usuario -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card" style="height:650px;">

                    {{-- Menu de opciones --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="home" aria-selected="true">{{ $user->name }} {{ $user->apellido_pater }}</a>
                            </li>
                            @if (@App\User::findOrFail($user->id)->trabajos->first())
                                <li class="nav-item">
                                    <a class="nav-link" id="mantenimientos-tab" data-toggle="tab" href="#mantenimientos" role="tab" aria-controls="contact" aria-selected="false">Mantenimientos</a>
                                </li>
                            @endif
                            @if (@App\User::findOrFail($user->id)->trabajos->first())
                                <li class="nav-item">
                                    <a class="nav-link" id="trabajos-tab" data-toggle="tab" href="#trabajos" role="tab" aria-controls="contact" aria-selected="false">Trabajos</a>
                                </li>
                            @endif
                        </ul>

                    {{-- Containers de opciones --}}
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                {{-- Pestaña del Usuario --}}
                                    <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="home-tab">
                                        @if ($user->path)
                                            <div class="avatar text-center" style="background-image: url({{ $user->url_path }})"></div>
                                        @else
                                            <div class="avatar text-center" style="background-image: url({{ asset('images/profile2.png') }})"></div>
                                        @endif

                                        {{-- Cedula --}}
                                            <div class="form-group row">
                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Cedula</label>
                                                <div class="col-md-6">
                                                    <input id="codigo" type="text" pattern="{9}" class="form-control" disabled value="{{ $user->cedula }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                </div>
                                            </div>

                                        {{-- Nombre--}}
                                            <div class="form-group row">
                                                <label for="codigo" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                                <div class="col-md-6">
                                                    <input id="codigo" type="text" pattern="{9}" class="form-control" disabled value="{{ $user->name }} {{ $user->apellido_pater }} {{ $user->apellido_mater }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                </div>
                                            </div>

                                        {{-- Direccion --}}
                                            <div class="form-group row">
                                                <label for="direc" class="col-md-4 col-form-label text-md-right">Direccion</label>

                                                <div class="col-md-6">
                                                    <input id="direc" type="text" class="form-control" disabled value="{{ $user->direc }}" name="direc" required autofocus>
                                                </div>
                                            </div>

                                        {{-- Telefono --}}
                                            <div class="form-group row">
                                                <label for="tlf" class="col-md-4 col-form-label text-md-right">Telefono</label>

                                                <div class="col-md-6">
                                                    <input id="tlf" type="text" pattern="[0-9]{7,10}" class="form-control" disabled value="{{ $user->tlf }}" name="tlf" required autofocus>
                                                </div>
                                            </div>

                                        {{-- Email --}}
                                            <div class="form-group row">
                                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control" disabled value="{{ $user->email }}" name="email" required autofocus>
                                                </div>
                                            </div>

                                        {{-- Role --}}
                                            <div class="form-group row">
                                                <label for="email" class="col-md-4 col-form-label text-md-right">Role Asignado</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control" disabled value="{{ @$user->roles()->first()->name }}" name="email" required autofocus>
                                                </div>
                                            </div>

                                        {{-- btn--}}
                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-6">
                                                    @can('users.edit')
                                                        <a href="{{ route('users.edit', Hashids::encode($user->id)) }}" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-fw fa-pen"></i>
                                                            Editar
                                                        </a>
                                                    @endcan
                                                </div>
                                            </div>
                                    </div>

                                {{-- Pestaña Mantenimientos --}}

                                    <div class="tab-pane fade" id="mantenimientos" role="tabpanel" aria-labelledby="contact-tab">
                                        <div id="accordion">
                                            <div id="cardScroll">
                                                @foreach (@App\User::findOrFail($user->id)->trabajos->all() as $item)
                                                    <div class="card mb-1">
                                                        <!-- Card Header - Accordion -->
                                                            <a href="#collapseCard{{ $item->mantenimientos->nro_ficha }}{{ $loop->iteration }}" class="d-block card-header py-2 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                                <button class="btn " data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapseOne">
                                                                    {{ $item->mantenimientos->nro_ficha }}
                                                                </button>
                                                            </a>
                                                        <!-- Card Content - Collapse -->
                                                            <div class="collapse hide" id="collapseCard{{ $item->mantenimientos->nro_ficha }}{{ $loop->iteration }}">
                                                                <div class="card-body">

                                                                    {{-- Codigo --}}
                                                                        <div class="form-group row">
                                                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Mantenimiento</label>
                                                                            <div class="col-md-6">
                                                                                <input type="input" disabled value="{{ $item->mantenimientos->nro_ficha }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                            </div>
                                                                        </div>

                                                                    {{-- Fecha Ingreso --}}
                                                                        <div class="form-group row">
                                                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha Ingreso</label>
                                                                            <div class="col-md-6">
                                                                                <input type="input" disabled value="{{ $item->mantenimientos->fecha_ingreso }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                            </div>
                                                                        </div>

                                                                    {{-- Fecha Egreso --}}
                                                                        <div class="form-group row">
                                                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha Egreso</label>
                                                                            <div class="col-md-6">
                                                                                <input type="input" disabled value="{{ $item->mantenimientos->fecha_egreso }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                            </div>
                                                                        </div>

                                                                    {{-- Observacion --}}
                                                                        <div class="form-group row">
                                                                            <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                                                            <div class="col-md-6">
                                                                                <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $item->mantenimientos->observacion }} </textarea>
                                                                            </div>
                                                                        </div>

                                                                    {{-- Diagnostico --}}
                                                                        <div class="form-group row">
                                                                            <label for="detalle" class="col-md-4 col-form-label text-md-right">Diagnostico</label>
                                                                            <div class="col-md-6">
                                                                                <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $item->mantenimientos->diagnostico }} </textarea>
                                                                            </div>
                                                                        </div>


                                                                    {{-- Valor Total --}}
                                                                        <div class="form-group row">
                                                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Valor Total</label>
                                                                            <div class="col-md-6">
                                                                                <input type="input" disabled value="{{ $item->mantenimientos->valor_total }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                            </div>
                                                                        </div>

                                                                    {{-- Estado --}}
                                                                        <div class="form-group row">
                                                                            <label for="codigo" class="col-md-4 col-form-label text-md-right">Estado</label>
                                                                            <div class="col-md-6">
                                                                                <input type="input" disabled value="{{ $item->mantenimientos->estado }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                            </div>
                                                                        </div>

                                                                    <div  class="text-center"><a href="{{ route('mantenimientos.show', Hashids::encode($item->mantenimientos->id)) }}">Este mantenimiento posee {{ $item->mantenimientos->trabajos->count() }} trabajo(s), y {{ $item->mantenimientos->trabajos->where('estado', 'En espera')->count() }} de ellos estan en espera.</a></div>

                                                                    {{-- btn --}}
                                                                        <div class="form-group row mb-0">
                                                                            @if ($item->mantenimientos->estado != 'Finalizado')
                                                                                <div class="align-maquinarias-center col-md-6 offset-md-6">
                                                                                    @can('mantenimientos.edit')
                                                                                        <a href="{{ route('mantenimientos.edit', Hashids::encode($item->mantenimientos->id)) }}" class="btn btn-sm btn-warning">
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

                                {{-- Pestaña Trabajos --}}
                                    <div class="tab-pane fade" id="trabajos" role="tabpanel" aria-labelledby="contact-tab">
                                        <div id="cardScroll">
                                            @foreach (@App\User::findOrFail($user->id)->trabajos->all() as $item)
                                                <div class="card mb-1">
                                                    <!-- Card Header - Accordion -->
                                                        <a href="#collapseCard{{ $item->fake_id }}{{ $loop->iteration }}" class="d-block card-header py-2 border-left-info" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                            <button class="btn " data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapseOne">
                                                                {{ $item->fake_id }}
                                                            </button>
                                                        </a>
                                                    <!-- Card Content - Collapse -->
                                                        <div class="collapse hide" id="collapseCard{{ $item->fake_id }}{{ $loop->iteration }}">
                                                            <div class="card-body">

                                                                {{-- Codigo Trabajo --}}
                                                                    <div class="form-group row">
                                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Tarea</label>
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
                                                                            <div class="col-md-6 offset-md-6">
                                                                                @can('tareas.edit')
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
@stop

@push('scripts')
<script>
    $(function() {
        $(document).ready(function(){
            // modal ver archivo
                $("#btnVerArchivo").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#verArchivoModal").modal("show");
                });

        });

    });

</script>
@endpush
