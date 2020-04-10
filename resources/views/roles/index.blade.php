@extends('layouts.app')

@section('content')
<!-- Tabla -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4><b>Roles</b></h4></span>
                        @can('roles.create')
                            <button type="button" id="btnCrearRoles" class="btn btn-success btn-sm">
                                Nuevo Role
                            </button>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="roles-table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Slug</th>
                                        <th>Descripcion</th>
                                        <th width="170">&nbsp;</th>
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
    <div class="modal fade bd-example-modal-lg" id="creaRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Role</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <form id="formRole" method="POST" action="{{ route('roles.store') }}">
                            @csrf

                                @include('roles.partials.formCreate')

                        </form>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" form="formRole" id="submitBtn" class="btn btn-primary">Agregar</button>
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
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h5 align="center">¿Desea eliminar el Role?</h5>
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
                var table = $("#roles-table").DataTable({
                    serverSide: true,
                    pageLength: 10,
                    ajax: '{!! route('datatables.roles') !!}',
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'slug', name: 'slug' },
                        { data: 'description', name: 'description'  },
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
                $("#btnCrearRoles").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#creaRoleModal").modal("show");
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
                $('#creaRoleModal').on('hidden.bs.modal', function() {
                    $('#formRole')[0].reset();
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
                        url: "roles/"+id,
                        method: 'DELETE',
                        success: function(result) {
                            setImmediate(function(){
                                $('#roles-table').DataTable().ajax.reload();
                                $('#DeleteProductModal').modal('hide');
                            });
                        }
                    });
                });

        });

    });

</script>
@endpush


{{--@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Lista de Roles</b></h4></span>
                    <!-- Cuadro Buscar  -->
                    @can('users.show')
                        <div class="sidebar-search">
                            <div>
                                <div class="input-group">
                                    <form action="{{ route('roles.search') }}">
                                        <div class="form-group">
                                            <input id="search" name="search" type="text" class="form-control search-menu" placeholder="Search..." onkeypress="pulsar(event)">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr class="table-secondary">
                                <th></th>
                                <th scope="col"><div class="text-center">Nombre</div></th>
                                <th scope="col"><div class="text-center">Slug</div></th>
                                <th scope="col" width="400px"><div class="text-center">Descripcion</div></th>
                                <th width="50px"></th>
                                <th width="50px"></th>
                                <th width="50px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($role as $item)
                            <tr>
                                <th scope="row"><i>{{ $loop->iteration }}</i></th>
                                <td><div class="text-center">{{ $item->name }}</div></td>
                                <td><div class="text-center">{{ $item->slug }}</div></td>
                                <td><div class="text-center">{{ $item->description }}</div></td>
                                <td>

                                    @can('roles.show')
                                        <a href="{{ route('roles.show', $item) }}">
                                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/ver.png') }}" title="Ver Detalles">
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('roles.edit')
                                        <a href="{{ route('roles.edit', $item) }}">
                                            <img class="img-responsive img-rounded float-right" src="{{ asset('images/actualizar.png') }}" title="Actualizar">
                                        </a>
                                    @endcan

                                </td>
                                <td>

                                    @can('roles.destroy')
                                        {!! Form::open(['route' => ['roles.destroy', $item->id],
                                        'method' => 'DELETE']) !!}
                                            <input type=image src="{{ asset('images/basura.png') }}" title="Eliminar">
                                        {!! Form::close() !!}
                                    @endcan

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $role->links() }}
                {{-- fin card body
                </div>
            </div>
        </div>
    </div>
</div>

@endsection--}}
