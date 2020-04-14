@extends('layouts.app')

@section('content')
<!-- Tabla -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4><b>Mantenimientos</b></h4></span>
                        <div class="group">
                            @can('mantenimientos.show')
                                <a href=" {{ route('mantenimientos.reportes') }} " class="btn btn-sm btn-info" target="_blank">
                                    <i class="fas fa-fw fa-file-alt"></i>
                                    Reporte
                                </a>
                            @endcan
                            @can('mantenimientos.create')
                                <a href=" {{ route('mantenimientos.create') }} " class="btn btn-success btn-sm">
                                    Nuevo Mantenimiento
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="mantenimientos-table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nro. Ficha</th>
                                        <th>Placa</th>
                                        <th width="100px">Fecha. Ingreso</th>
                                        <th width="100px">Fecha. Egreso</th>
                                        <th>Estado</th>
                                        <th>Valor</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Crear -->
    <div class="modal fade" id="creaMantenimientoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Mantenimiento</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <form id="formMantenimiento" method="POST" action="{{ route('mantenimientos.store') }}" enctype="multipart/form-data">
                            @csrf
                            {{-- Ficha --}}
                                <div class="form-group row">
                                    <label for="ficha" class="col-md-3 text-md-right">Numero de Ficha</label>
                                    <div class="col-md-8">
                                        <input id="ficha" type="text" pattern="[0-9]{7}" class="form-control" name="ficha" required autocomplete="ficha" autofocus>
                                    </div>
                                </div>

                            {{-- Placa del Vehiculo --}}
                                <div class="form-group row">

                                    <label for="placa" class="col-md-3 text-md-right">Placa del Vehiculo</label>

                                    <div class="col-md-8">
                                        <input id="placa" type="text" class="form-control" name="placa" required autocomplete="placa" autofocus>
                                    </div>
                                </div>

                            {{-- Observacion --}}
                                <div class="form-group row">
                                    <label for="observacion" class="col-md-3 text-md-right">Observacion</label>
                                    <div class="col-md-8">
                                        <textarea id="observacion" type="text" class="form-control" name="observacion" required autocomplete="observacion" autofocus></textarea>
                                    </div>
                                </div>

                            {{-- Diagnostico --}}
                                <div class="form-group row">
                                    <label for="diagnostico" class="col-md-3 text-md-right">Diagnostico</label>

                                    <div class="col-md-8">
                                        <textarea id="diagnostico" type="text" class="form-control" name="diagnostico" required autocomplete="diagnostico" autofocus></textarea>
                                    </div>
                                </div>

                            {{-- Imagen de la Ficha --}}
                                <div class="form-group row">
                                    <label for="file" class="col-md-3 text-md-right">Cargar Imagen de la Ficha</label>
                                    <div class="col-md-8">
                                        <input id="file" type="file" name="file">
                                    </div>
                                </div>
                        </form>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" form="formMantenimiento" id="submitBtn" class="btn btn-primary">Agregar</button>
                    </div>
            </div>
        </div>
    </div>

<!-- Finalizar Mantenimiento Modal -->
    <div class="modal fade" id="FinalizaMantenimientoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-warning" id="SubmitFinalizarMantenimientoForm">Finalizar</button>
                    </div>
            </div>
        </div>
    </div>

<!-- Mantenimiento Finalizado Modal -->
    <div class="modal fade" id="NoOptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5><b>Advertencia</b></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h6 align="center">
                            Este mantenimiento ya ha finalizado por lo que no es posible editar su informacion.
                        </h6>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
            </div>
        </div>
    </div>

<!-- Delete Product Modal -->
    <div class="modal fade" id="DeleteProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5><b>Eliminar Mantenimiento</b></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h6 align="center">Eliminar este mantenimiento tambien eliminara todos los trabajos vinculados. <br><br><b>¿Desea continuar?</b></h6>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="SubmitDeleteProductForm">Eliminar</button>
                    </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function() {
        $(document).ready(function(){
            // initializing Datatable
                var table = $("#mantenimientos-table").DataTable({
                    serverSide: true,
                    pageLength: 10,
                    ajax: '{!! route('datatables.mantenimientos') !!}',
                    columns: [
                        { data: 'nro_ficha', name: 'mantenimientos.nro_ficha' },
                        { data: 'placa', name: 'vehiculos.placa' },
                        { data: 'fecha_ingreso', name: 'mantenimientos.fecha_ingreso' },
                        { data: 'fecha_egreso', name: 'mantenimientos.fecha_egreso' },
                        { data: 'estado', name: 'mantenimientos.estado'  },
                        { data: 'valor_total', name: 'mantenimientos.valor_total'  },
                        { data: 'btn', name: 'btn',orderable:false,serachable:false,sClass:'text-center' }
                    ],
                    "language":{
                        "info": "_TOTAL_ registros",
                        "search": "Buscar:",
                        "paginate": {
                            "next": ">>",
                            "previous": "<<"
                        },
                        "lengthMenu": 'Mostrar <select>'+
                                    '<option value="5">5</option>'+
                                    '<option value="10">10</option>'+
                                    '<option value="20">20</option>'+
                                    '<option value="40">40</option>'+
                                    '<option value="-1">Todos</option>'+
                                    '</select> registros',
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "emptyTable": "No hay datos",
                        "zeroRecords": "No hay coincidencias",
                        "infoEmpty": "",
                        "infoFiltered": ""
                    }
                });

            // modal crear
                $("#btnCrearMantenimiento").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#creaMantenimientoModal").modal("show");
                });

            // Resetear modal crear una vez que se cierra
                $('#creaMantenimientoModal').on('hidden.bs.modal', function() {
                    $('#formMantenimiento')[0].reset();
                });

            // Finalizar Mantenimiento.
                var finalizaID;
                $('body').on('click', '#getFinalizaId', function(){
                    finalizaID = $(this).data('id');
                })
                $('#SubmitFinalizarMantenimientoForm').click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    var id = finalizaID;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "mantenimientos/finalizar/"+id,
                        method: 'PUT',
                        success: function(result) {
                            setImmediate(function(){
                                $('#mantenimientos-table').DataTable().ajax.reload();
                                $('#FinalizaMantenimientoModal').modal('hide');
                            });
                        }
                    });
                });

            // Eliminar vehiculo Ajax request.
                var deleteID;
                $('body').on('click', '#getDeleteId', function(){
                    deleteID = $(this).data('id');
                })
                $('#SubmitDeleteProductForm').click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    var id = deleteID;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "mantenimientos/"+id,
                        method: 'DELETE',
                        success: function(result) {
                            setImmediate(function(){
                                $('#mantenimientos-table').DataTable().ajax.reload();
                                $('#DeleteProductModal').modal('hide');
                            });
                        }
                    });
                });

        });

    });

</script>
@endpush
