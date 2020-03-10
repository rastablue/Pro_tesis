@extends('layouts.app')

@section('content')
<!-- Tabla -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4><b>Lista de Mantenimientos</b></h4></span>
                        @can('mantenimientos.create')
                            <button type="button" id="btnCrearMantenimiento" class="btn btn-success btn-sm">
                                Nuevo Mantenimiento
                            </button>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="mantenimientos-table">
                                <thead>
                                    <tr>
                                        <th width="95px">Nro. Ficha</th>
                                        <th>Fecha de Ingreso</th>
                                        <th>Fecha de Egreso</th>
                                        <th>Estado</th>
                                        <th>Valor Total</th>
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
                        <form id="formMantenimiento" method="POST" action="{{ route('mantenimientos.store') }}">
                            @csrf
                            {{-- Ficha --}}
                                <div class="form-group row">
                                    <label for="ficha" class="col-md-4 col-form-label">Numero de Ficha</label>

                                    <div class="col-md-8">
                                        <input id="ficha" type="text" pattern="[0-9]{7}" class="form-control" name="ficha" required autocomplete="ficha" autofocus>
                                    </div>
                                </div>

                            {{-- Placa del Vehiculo --}}
                                <div class="form-group row">

                                    <label for="placa" class="col-md-4 col-form-label">Placa</label>

                                    <div class="col-md-8">
                                        <input id="placa" type="text" class="form-control" name="placa" required autocomplete="placa" autofocus>
                                    </div>
                                </div>

                            {{-- Observacion --}}
                                <div class="form-group row">
                                    <label for="observacion" class="col-md-4 col-form-label">Observacion</label>

                                    <div class="col-md-8">
                                        <textarea id="observacion" type="text" class="form-control" name="observacion" required autocomplete="observacion" autofocus></textarea>
                                    </div>
                                </div>

                            {{-- Diagnostico --}}
                                <div class="form-group row">
                                    <label for="diagnostico" class="col-md-4 col-form-label">Diagnostico</label>

                                    <div class="col-md-8">
                                        <textarea id="diagnostico" type="text" class="form-control" name="diagnostico" required autocomplete="diagnostico" autofocus></textarea>
                                    </div>
                                </div>

                            {{-- Imagen de la Ficha --}}
                                <div class="form-group row">
                                    <label for="file" class="col-md-4 col-form-label">Cargar Imagen de la Ficha</label>

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
                        <h5 align="center">¿Desea eliminar el mantenimiento?</h5>
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
                    pageLength: 5,
                    ajax: '{!! route('datatables.mantenimientos') !!}',
                    columns: [
                        { data: 'nro_ficha', name: 'nro_ficha' },
                        { data: 'fecha_ingreso', name: 'fecha_ingreso' },
                        { data: 'fecha_egreso', name: 'fecha_egreso' },
                        { data: 'estado', name: 'estado'  },
                        { data: 'valor_total', name: 'valor_total'  },
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
                $('#creaMantenimientoModal').on('hidden.bs.modal', function() {
                    $('#formMantenimiento')[0].reset();
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
                        url: "mantenimientos/"+id,
                        method: 'DELETE',
                        success: function(result) {
                            setImmediate(function(){
                                $('#mantenimientos-table').DataTable().ajax.reload();
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
                    <span><h4><b>Lista de Mantenimientos</b></h4></span>
                    <!-- Cuadro Buscar  -->
                    @can('mantenimientos.show')
                        <div class="sidebar-search">
                            <div>
                                <div class="input-group">
                                    <form action="{{ route('mantenimientos.search') }}">
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
                                <th scope="col" width="100px"><div class="text-center">Nro. Ficha</div></th>
                                <th scope="col" width="200px"><div class="text-center">Fecha de Ingreso</div></th>
                                <th scope="col" width="200px"><div class="text-center">Fecha de Egreso</div></th>
                                <th scope="col" width="100px"><div class="text-center">Estado</div></th>
                                <th scope="col" width="150px"><div class="text-center">Valor Total</div></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mantenimiento as $item)
                            <tr>
                                <th scope="row"><i>{{ $loop->iteration }}</i></th>
                                <th scope="row"><div class="text-center">{{ $item->nro_ficha }}</div></th>
                                <td><div class="text-center">{{ $item->fecha_ingreso }}</div></td>
                                <td><div class="text-center">{{ $item->fecha_egreso }}</div></td>
                                <td><div class="text-center">{{ $item->estado }}</div></td>
                                <td><div class="text-center">{{ $item->valor_total }}</div></td>
                                <td>
                                    @can('mantenimientos.show')
                                        <a href="{{ route('mantenimientos.show', $item) }}">
                                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/ver.png') }}" title="Ver Detalles">
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('trabajos.create')
                                        <a href="{{ route('trabajos.show', $item) }}">
                                            <img class="img-responsive img-rounded float-right" src="{{ asset('images/trabajos.png') }}" title="Agregar Trabajo">
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('mantenimientos.edit')
                                        <a href="{{ route('mantenimientos.edit', $item) }}">
                                            <img class="img-responsive img-rounded float-right" src="{{ asset('images/actualizar.png') }}" title="Actualizar">
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('mantenimientos.destroy')
                                        {!! Form::open(['route' => ['mantenimientos.destroy', $item->id],
                                        'method' => 'DELETE']) !!}
                                            <input type=image src="{{ asset('images/basura.png') }}" title="Eliminar">
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $mantenimiento->links() }}
                {{-- fin card body
                </div>
            </div>
        </div>
    </div>
</div>

@endsection--}}
