@extends('layouts.app')

@section('content')
<!-- Tabla -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4><b>Vehiculos</b></h4></span>
                        <div class="group">
                            @can('vehiculos.show')
                                <a href="{{ route('vehiculos.reportes') }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-fw fa-file-alt"></i>
                                    Reporte
                                </a>
                            @endcan
                            @can('vehiculos.create')
                                <a href=" {{ route('vehiculos.create') }} " class="btn btn-success btn-sm">
                                    Nuevo Vehiculo
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="vehiculos-table">
                                <thead>
                                    <tr>
                                        <th>Placa</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Color</th>
                                        <th>Propietario</th>
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

<!-- Modal Crear-->
    <div class="modal fade" id="creaVehiculoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Vehiculos</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <form id="formVehiculo" method="POST" action="{{ route('vehiculos.store') }}">
                            @csrf
                            {{-- Placa --}}
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Placa</label>
                                    <div class="col-md-9">
                                        <input required name="placa" type="text" class="form-control" id="inputPlaca" placeholder="Placa">
                                    </div>
                                </div>
                            {{-- Marca --}}
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Marca</label>
                                    <div class="col-md-9">
                                        <select id="marca" class="form-control" name="marca">
                                            <option disabled="true" selected='true'>Seleccione Marca</option>
                                            @foreach(App\Marca::all() as $marcas)
                                                <option value="{{ $marcas->id }}">  {{ $marcas->marca}}  </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            {{-- Modelo --}}
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Modelo</label>
                                    <div class="col-md-9">
                                        <input required name="modelo" type="text" class="form-control" id="inputModelo" placeholder="Modelo">
                                    </div>
                                </div>
                            {{-- Color --}}
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Color</label>
                                    <div class="col-md-9">
                                        <input required name="color" type="text" class="form-control datepicker" id="inputColor" placeholder="Color">
                                    </div>
                                </div>
                            {{-- Kilometraje --}}
                                <div class="form-group row">
                                    <label for="user_id" class="col-md-3 col-form-label">Kilometraje</label>
                                    <div class="col-md-9">
                                        <input name="kilometraje" type="num" pattern="[0-9]{0,10}" class="form-control" id="kilometraje" placeholder="Kilometraje" required autocomplete="kilometraje" autofocus>
                                    </div>
                                </div>
                            {{-- Observaciones --}}
                                <div class="form-group row">
                                    <label for="observacion" class="col-md-3 col-form-label">Observacion</label>
                                    <div class="col-md-9">
                                        <textarea name="observa" type="text" class="form-control" id="observa" required autocomplete="observacion" autofocus></textarea>
                                    </div>
                                </div>
                            {{-- Cedula del cliente --}}
                                <div class="form-group row">
                                    <label for="user_id" class="col-md-3 col-form-label">Cedula del Cliente</label>
                                    <div class="col-md-9">
                                        <input name="user_id" type="text" pattern="[0-9]{10}" class="form-control" id="user_id" placeholder="Cedula del Cliente" required autocomplete="user_id" autofocus>
                                    </div>
                                </div>

                        </form>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" form="formVehiculo" id="submitBtn" class="btn btn-primary">Agregar</button>
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
                        <h5><b>Eliminar Vehiculo</b></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h6 align="center">
                            Eliminar este vehiculo no eliminara los mantenimientos vinculados,
                             sin embargo, esos mantenimientos ya no quedaran vinculados
                             a ningun vehiculo. <br><br><b>¿Desea continuar?</b>
                        </h6>
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
                var table = $("#vehiculos-table").DataTable({
                    serverSide: true,
                    pageLength: 10,
                    ajax: '{!! route('datatables.vehiculo') !!}',
                    columns: [
                        //{ data: 'marca', name: 'marca_vehiculos.id' },
                        { data: 'placa', name: 'vehiculos.placa' },
                        { data: 'marca', name: 'marcas.marca'   },
                        { data: 'modelo', name: 'vehiculos.modelo'  },
                        { data: 'color', name: 'vehiculos.color'  },
                        { data: 'name', name: 'clientes.name'  },
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
                $("#btnCrearVehiculo").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#creaVehiculoModal").modal("show");
                });

            // Cuando se presiona submit en crear
                $('#submitBtn').submit(function(e) {
                    e.preventDefault()
                    var form = $(this),
                        url = form.attr("action")
                    var formData = form.serialize();
                    $.ajax({
                        url: window.app + "/vehiculos-table",
                        data: formData,
                        dataType: 'json', // data type
                        type: 'POST',
                        success: function(data, textStatus, jqXHR) {
                            if (data.error) {
                                $("#alertModal").toggleClass("display-none").toggleClass("alert-danger");
                                $("#alertMessage").html(data.msg);
                                setTimeout(function() {
                                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                                }, 3000);
                            } else {
                                $("#alertHome").toggleClass("display-none").toggleClass("alert-success");
                                setTimeout(function() {
                                    $("#alertHome").addClass("display-none").removeClass("alert-success")
                                }, 3000);
                                $("#alertMsgHome").html(data.msg);
                                $("#datatableModal").modal("hide");
                                $("#datatable").DataTable().ajax.reload();
                            }
                        }
                    });
                });

            // Resetear modal crear una vez que se cierra
                $('#creaVehiculoModal').on('hidden.bs.modal', function() {
                    $('#formVehiculo')[0].reset();
                });

            // Get single product in EditModel
                var id;
                $(document).on('click', '#getEditProductData', function(e){
                    e.preventDefault();
                    id = $(this).data('id');
                    $.ajax({
                        url: "vehiculos/"+id+"/edit",
                        method: 'GET',
                        data: {
                            id: id,
                        },
                        success: function(result) {
                            console.log(result);
                            $('#editaVehiculoBody').html(result.html);
                            $('#myModal').show();
                        }
                    });
                    $('.modal-body').load('content.html',function(){
                        $("#alertModal").addClass("display-none").removeClass("alert-danger")
                        $("#inputId").val(null)
                        $('#myModal').modal({show:true});
                    });
                });

            // Update product Ajax request.
                $('#SubmitEditVehiculoForm').click(function(e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "vehiculos/"+id,
                        method: 'PUT',
                        data: {
                            placa: $('#placa').val(),
                            marca: ('#marca').val(),
                            modelo: $('#modelo').val(),
                            color: $('#color').val(),
                            observacion: $('#observa').val(),
                            user_id: $('#user_id').val(),
                        },
                        success: function(result) {
                            if(result.errors) {
                                $('.alert-danger').html('');
                                $.each(result.errors, function(key, value) {
                                    $('.alert-danger').show();
                                    $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                                });
                            } else {
                                $('.alert-danger').hide();
                                $('.alert-success').show();
                                $('.datatable').DataTable().ajax.reload();
                                setInterval(function(){
                                    $('.alert-success').hide();
                                    $('#EditProductModal').hide();
                                }, 2000);
                            }
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
                        url: "vehiculos/"+id,
                        method: 'DELETE',
                        success: function(result) {
                            setImmediate(function(){
                                $('#vehiculos-table').DataTable().ajax.reload();
                                $('#DeleteProductModal').modal('hide');
                            });
                        }
                    });
                });

        });

    });

</script>
@endpush
