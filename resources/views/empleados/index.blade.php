@extends('layouts.app')

@section('content')
<!-- Tabla -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4><b>Lista de Empleados</b></h4></span>
                        @can('empleados.create')
                            <button type="button" id="btnCrearEmpleado" class="btn btn-success btn-sm">
                                Nuevo Empleado
                            </button>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="empleados-table">
                                <thead>
                                    <tr>
                                        <th width="75px">Cedula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Telefono</th>
                                        <th>E-mail</th>
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
    <div class="modal fade" id="creaEmpleadoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Empleado</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <form id="formEmpleado" method="POST" action="{{ route('empleados.store') }}">
                            @csrf
                            {{-- cedula --}}
                                <div class="form-group row">
                                    <label for="cedula" class="col-md-3 col-form-label">Cedula</label>

                                    <div class="col-md-9">
                                        <input id="cedula" type="text" pattern="[0-9]{10}" class="form-control" name="cedula" required autocomplete="cedula" autofocus>
                                    </div>
                                </div>
                        </form>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" form="formEmpleado" id="submitBtn" class="btn btn-primary">Agregar</button>
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
                var table = $("#empleados-table").DataTable({
                    searching: false,
                    serverSide: true,
                    pageLength: -1,
                    ajax: '{!! route('datatables.empleados') !!}',
                    columns: [
                        { data: 'empleados_ced', name: 'empleados_ced' },
                        { data: 'empleados_name', name: 'empleados_name' },
                        { data: 'empleados_ape', name: 'empleados_ape' },
                        { data: 'empleados_tlf', name: 'empleados_tlf' },
                        { data: 'empleados_email', name: 'empleados_email' }
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
                $("#btnCrearEmpleado").click(function(e) {
                    e.preventDefault();
                    $("#alertModal").addClass("display-none").removeClass("alert-danger")
                    $("#inputId").val(null)
                    $("#creaEmpleadoModal").modal("show");
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
                $('#creaEmpleadoModal').on('hidden.bs.modal', function() {
                    $('#formEmpleado')[0].reset();
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
                    <span><h4><b>Lista de Empleados</b></h4></span>

                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr class="table-secondary">
                                <th scope="col"><div class="text-center">Cedula</div></th>
                                <th scope="col"><div class="text-center">Nombre</div></th>
                                <th scope="col" width="190px"><div class="text-center">Apellidos</div></th>
                                <th scope="col" width="190px"><div class="text-center">Direccion</div></th>
                                <th scope="col"><div class="text-center">Telefono</div></th>
                                <th scope="col"><div class="text-center">E-mail</div></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($empleados as $items)
                                @if ($items->estado == 'Activo')
                                    <tr>
                                        @foreach ($items->users->where('id', $items->user_id)->get() as $item)
                                            <th scope="row"><div class="text-center">{{ $item->cedula }}</div></th>
                                            <td><div class="text-center">{{ $item->name }}</div></td>
                                            <td><div class="text-center">{{ $item->apellido_pater }}    {{ $item->apellido_mater }}</div></td>
                                            <td><div class="text-center">{{ $item->direc }}</div></td>
                                            <td><div class="text-center">{{ $item->tlf }}</div></td>
                                            <td><div class="text-center">{{ $item->email }}</div></td>
                                            <td>
                                                @can('users.show')
                                                    <a href="{{ route('users.show', $item) }}">
                                                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/ver.png') }}" title="Ver Detalles">
                                                    </a>
                                                @endcan
                                            </td>
                                            <td>
                                                @can('empleados.edit')
                                                    <a href="{{ route('users.edit', $item) }}">
                                                        <img class="img-responsive img-rounded float-right" src="{{ asset('images/actualizar.png') }}" title="Actualizar">
                                                    </a>
                                                @endcan
                                            </td>
                                        @endforeach
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                {{-- fin card body
                </div>
            </div>
        </div>
    </div>
</div>

@endsection--}}
