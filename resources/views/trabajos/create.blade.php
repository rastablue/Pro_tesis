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
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Trabajo</a>
                                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Mantenimiento</i></a>

                                <br><br><button type="submit" form="formMantenimiento" id="submitBtn" class="btn btn-success mt-4">Agregar</button>
                            </div>


                        </div>

                    {{-- Container de opciones --}}
                        <div class="card-body col-9">

                            <form id="formMantenimiento" method="POST" action="{{ route('trabajos.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="tab-content" id="v-pills-tabContent">
                                    {{-- Trabajos --}}
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                                            {{-- Encargado --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Encargado') }}</label>
                                                    <div class="col-md-6">

                                                        <select id="cedula" class="form-control @error('cedula') is-invalid @enderror" name="cedula">
                                                            <option disabled selected='true'>Seleccione un Encargado</option>
                                                            @foreach(@App\User::all() as $item)
                                                                <option value="{{ $item->cedula }}">{{ $item->name }} {{ $item->apellido_pater }} {{ $item->apellido_mater }}</option>
                                                            @endforeach
                                                        </select>

                                                        @error('cedula')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Mano de Obra --}}
                                                <div class="form-group row">
                                                    <label for="Mano De Obra" class="col-md-4 col-form-label text-md-right">{{ __('Mano De Obra') }}</label>
                                                    <div class="col-md-6">
                                                        <textarea type="text" name="mano_de_obra" class="form-control @error('mano_de_obra') is-invalid @enderror" autocomplete="Mano De Obra" autofocus>{{ old('mano_de_obra') }}</textarea>

                                                        @error('mano_de_obra')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Repuestos --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Repuestos') }}</label>
                                                    <div class="col-md-6">
                                                        <textarea type="text" name="repuestos" class="form-control @error('repuestos') is-invalid @enderror" autocomplete="Repuestos" autofocus> {{ old('repuestos') }} </textarea>

                                                        @error('repuestos')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Costo Mano De Obra --}}
                                                <div class="form-group row">
                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">{{ __('Costo De Mano De Obra') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="number" step="any" name="costo_mano_de_obra" value="{{ old('costo_mano_de_obra') }}" class="form-control @error('costo_mano_de_obra') is-invalid @enderror" autocomplete="Costo de Mano de Obra" autofocus>

                                                        @error('costo_mano_de_obra')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Costo Repuestos --}}
                                                <div class="form-group row">
                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">{{ __('Costo De Repuestos') }}</label>
                                                    <div class="col-md-6">
                                                        <input type="number" step="any" name="costo_de_repuestos" value="{{ old('costo_de_repuestos') }}" class="form-control @error('costo_de_repuestos') is-invalid @enderror" autocomplete="Costo de Repuestos" autofocus>


                                                        @error('costo_de_repuestos')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- Tipo --}}
                                                <div class="form-group row">
                                                    <label for="tipo_contrato" class="col-md-4 col-form-label text-md-right">{{ __('Tipo De Trabajo') }}</label>

                                                    <div class="col-md-6">

                                                        <select id="tipo" class="form-control @error('tipo') is-invalid @enderror" name="tipo">
                                                            <option value="{{ old('tipo') }}" selected>{{ old('tipo') }}</option>
                                                            @foreach(App\Trabajo::getEnumValues('trabajos', 'tipo') as $tipo)
                                                                <option value="{{ $tipo }}">  {{ $tipo }}  </option>
                                                            @endforeach
                                                        </select>


                                                        @error('tipo')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                </div>

                                            {{-- id Mantenimiento --}}
                                                <input type="hidden" name="id_mantenimiento" value="{{ $mantenimiento->id }}">

                                        </div>

                                    {{-- mantenimiento --}}
                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                                            {{-- Codigo --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Mantenimiento</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $mantenimiento->nro_ficha }}" class="form-control" autocomplete="Fecha inicio" autofocus>
                                                    </div>
                                                </div>

                                            {{-- Fecha Ingreso --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha Ingreso</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $mantenimiento->fecha_ingreso }}" class="form-control" autocomplete="Fecha inicio" autofocus>
                                                    </div>
                                                </div>

                                            {{-- Fecha Egreso --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha Egreso</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $mantenimiento->fecha_egreso }}" class="form-control" autocomplete="Fecha fin" autofocus>
                                                    </div>
                                                </div>

                                            {{-- Observacion --}}
                                                <div class="form-group row">
                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                                    <div class="col-md-6">
                                                        <textarea type="text" disabled class="form-control" autocomplete="detalle" autofocus> {{ $mantenimiento->observacion }} </textarea>
                                                    </div>
                                                </div>

                                            {{-- Diagnostico --}}
                                                <div class="form-group row">
                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">Diagnostico</label>
                                                    <div class="col-md-6">
                                                        <textarea type="text" disabled class="form-control" autocomplete="detalle" autofocus> {{ $mantenimiento->diagnostico }} </textarea>
                                                    </div>
                                                </div>


                                            {{-- Valor Total --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Valor Total</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $mantenimiento->valor_total }}" class="form-control" autocomplete="Fecha fin" autofocus>
                                                    </div>
                                                </div>

                                            {{-- Valor Total --}}
                                                <div class="form-group row">
                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Estado</label>
                                                    <div class="col-md-6">
                                                        <input type="input" disabled value="{{ $mantenimiento->estado }}" class="form-control" autocomplete="Fecha fin" autofocus>
                                                    </div>
                                                </div>

                                            {{-- btn --}}
                                                <div class="form-group row mb-0">
                                                    <div class="align-maquinarias-center col-md-6 offset-md-6">
                                                        @can('mantenimientos.show')
                                                            <button type="button" id="btnVerArchivo" class="btn btn-success btn-sm">
                                                                <i class="fas fa-fw fa-image"></i>
                                                                Archivo
                                                            </button>
                                                        @endcan
                                                    </div>
                                                </div>

                                        </div>

                                </div>
                            </form>
                        </div>
                </div>
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

                        @if ($mantenimiento->estado != 'Finalizado')
                            <form id="formFoto" method="POST" action="{{ route('mantenimientos.updateFoto', Hashids::encode($mantenimiento->id)) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf

                                    @can('mantenimientos.edit')
                                        <div class="form-group text-center">
                                            <label for="file-upload" class="custom-file-upload mt-4">
                                                <i class="fas fa-cloud-upload-alt"></i> Agregar imagen de la ficha
                                            </label>
                                            <br>
                                            <span id="file-selected"></span>
                                            <input id="file-upload" accept="image/jpeg,image/png" type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" value="{{ old('foto') }}" autofocus>

                                            @error('foto')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <div>
                                                <button type="submit" id="AgregarFoto" class="btn btn-primary">
                                                    {{ __('Agregar') }}
                                                </button>
                                            </div>
                                        </div>
                                    @endcan

                            </form>
                        @endif
                        
                    </div>
                @endif

            </div>
        </div>
    </div>

<script>
    function mayus(e) {
        e.value = e.value.toUpperCase();
    }
    
    $(function() {
        $(document).ready(function(){
            $('#AgregarFoto').hide()
        });
    });
    $('#file-upload').bind('change', function() { 
        var fileName = '';
        fileName = $(this).val();
        $('#file-selected').html(fileName);
        $('#AgregarFoto').show()
    })
    // Resetear modal una vez que se cierra
    $('#verArchivoModal').on('hidden.bs.modal', function() {
        $('#formFoto')[0].reset();
        $('#file-selected').html('');
        $('#AgregarFoto').hide()
    });

</script>
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

        });

    });

</script>
@endpush
