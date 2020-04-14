@extends('layouts.app')

@section('content')
<!-- Tabla -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4><b>Empleados</b></h4></span>
                        <div class="group">
                            @can('users.show')
                                <a href=" {{ route('users.reportes') }} " class="btn btn-sm btn-info">
                                    <i class="fas fa-fw fa-file-alt"></i>
                                    Reporte
                                </a>
                            @endcan
                            @can('users.create')
                                <a href=" {{ route('users.create') }} " class="btn btn-sm btn-success">
                                    <i class="fas fa-fw fa-file-alt"></i>
                                    Nuevo Empleado
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="users-table">
                                <thead>
                                    <tr>
                                        <th width="75px">Cedula</th>
                                        <th>Nombre</th>
                                        <th>Telefono</th>
                                        <th>E-mail</th>
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
    <div class="modal fade" id="creaUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Usuarios</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <form id="formUser" method="POST" action="{{ route('users.store') }}">
                            @csrf
                            {{-- cedula --}}
                                <div class="form-group row">
                                    <label for="cedula" class="col-md-3 col-form-label">Cedula</label>

                                    <div class="col-md-9">
                                        <input id="cedula" type="text" pattern="[0-9]{10}" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{ old('cedula') }}" required autocomplete="cedula" autofocus>

                                        @error('cedula')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Nombre --}}
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 col-form-label">Nombre</label>

                                    <div class="col-md-9">
                                        <input id="name" type="text" pattern="[A-Za-z]{1,25}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Apellido Paterno --}}
                                <div class="form-group row">
                                    <label for="apellido_pater" class="col-md-3 col-form-label">Apellido Paterno</label>

                                    <div class="col-md-9">
                                        <input id="apellido_pater" type="text" pattern="[A-Za-z ]{1,25}" class="form-control @error('apellido_pater') is-invalid @enderror" name="apellido_pater" value="{{ old('apellido_pater') }}" required autocomplete="apellido_pater" autofocus>

                                        @error('apellido_pater')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Apellido Materno --}}
                                <div class="form-group row">

                                    <label for="apellido_mater" class="col-md-3 col-form-label">Apellido Materno</label>

                                    <div class="col-md-9">
                                        <input id="apellido_mater" type="text" pattern="[A-Za-z]{1,25}" class="form-control @error('apellido_mater') is-invalid @enderror" name="apellido_mater" value="{{ old('apellido_mater') }}" required autocomplete="apellido_mater" autofocus>

                                        @error('apellido_mater')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Direccion --}}
                                <div class="form-group row">
                                    <label for="direc" class="col-md-3 col-form-label">Direccion</label>

                                    <div class="col-md-9">
                                        <input id="direc" type="text" class="form-control @error('direc') is-invalid @enderror" name="direc" value="{{ old('direc') }}" required autocomplete="direc" autofocus>

                                        @error('direc')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Telefono --}}
                                <div class="form-group row">
                                    <label for="tlf" class="col-md-3 col-form-label">Telefono</label>

                                    <div class="col-md-9">
                                        <input id="tlf" type="text" pattern="[0-9]{7,10}" class="form-control @error('tlf') is-invalid @enderror" name="tlf" value="{{ old('tlf') }}" required autocomplete="tlf" autofocus>

                                        @error('tlf')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Email --}}
                                <div class="form-group row">
                                    <label for="email" class="col-md-3 col-form-label">E-Mail Address</label>

                                    <div class="col-md-9">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Password --}}
                                <div class="form-group row">
                                    <label for="password" class="col-md-3 col-form-label">Password</label>

                                    <div class="col-md-9">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Confirm Password --}}
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-3 col-form-label">Confirm Password</label>

                                    <div class="col-md-9">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                        </form>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" form="formUser" id="submitBtn" class="btn btn-primary">Agregar</button>
                    </div>
            </div>
        </div>
    </div>

<!-- Modal Editar-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Editar Vehiculo</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    <!-- Modal body -->
                        <div class="modal-body">
                            <div id="editaVehiculoBody">

                            </div>
                        </div>
                    <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" form="formVehiculo" id="SubmitEditVehiculoForm" class="btn btn-primary">Actualizar</button>
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
                        <h5><b>Eliminar Empleado</b></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h6 align="center">Eliminar este empleado provocara que todos sus trabajos asignados se queden sin encargado. <br><br><b>¿Desea continuar?</b></h6>
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
                var table = $("#users-table").DataTable({
                    serverSide: true,
                    pageLength: 10,
                    ajax: '{!! route('datatables.users') !!}',
                    columns: [
                        { data: 'cedula', name: 'cedula' },
                        { data: 'apellido_pater', render: function(data, type, row, meta){return row.name + ' ' + row.apellido_pater}},
                        { data: 'tlf', name: 'tlf'  },
                        { data: 'email', name: 'email'  },
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
                $("#btnCrearUser").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#creaUserModal").modal("show");
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
                $('#creaUserModal').on('hidden.bs.modal', function() {
                    $('#formUser')[0].reset();
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

            // Eliminar Ajax request.
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
                        url: "users/"+id,
                        method: 'DELETE',
                        success: function(result) {
                            setImmediate(function(){
                                $('#users-table').DataTable().ajax.reload();
                                $('#DeleteProductModal').modal('hide');
                            });
                        }
                    });
                });

        });

    });

</script>
@endpush
