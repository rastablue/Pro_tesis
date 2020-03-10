@extends('layouts.app')

@section('content')
<!-- Tabla -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4><b>Lista de Vehiculos</b></h4></span>
                        @can('vehiculos.create')
                            <button type="button" id="btnCrearVehiculo" class="btn btn-success btn-sm">
                                Nuevo Vehiculo
                            </button>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="vehiculos-table">
                                <thead>
                                    <tr>
                                        <th width="75px">Placa</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Color</th>
                                        <th width="155">&nbsp;</th>
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
                                            @foreach(App\MarcaVehiculo::all() as $marcas)
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
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-body">
                        <h5 align="center">¿Desea eliminar el vehiculo?</h5>
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
                    pageLength: 5,
                    ajax: '{!! route('datatables.vehiculo') !!}',
                    columns: [
                        { data: 'placa', name: 'placa' },
                        { data: 'marca', name: 'marca'   },
                        { data: 'modelo', name: 'modelo'  },
                        { data: 'color', name: 'color'  },
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
                    <span><h4><b>Lista de Vehiculos</b></h4></span>
                    <!-- Cuadro Buscar  -->
                        @can('vehiculos.show')
                            <div class="sidebar-search">
                                <div>
                                    <div class="input-group">
                                        <form action="{{ route('vehiculos.search') }}">
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
                                <th scope="col" width="150px"><div class="text-center">Placa</div></th>
                                <th scope="col"><div class="text-center">Marca</div></th>
                                <th scope="col" width="300px"><div class="text-center">Modelo</div></th>
                                <th scope="col"><div class="text-center">Color</div></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehiculo as $item)
                            <tr>
                                <th scope="row"><i>{{ $loop->iteration }}</i></th>
                                <th scope="row"><div class="text-center">{{ $item->placa }}</div></th>
                                <td><div class="text-center">{{ $item->marcas->marca }}</div></td>
                                <td><div class="text-center">{{ $item->modelo }}</div></td>
                                <td><div class="text-center">{{ $item->color }}</div></td>
                                <td>
                                    @can('vehiculos.show')
                                        <a href="{{ route('vehiculos.show', $item) }}">
                                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/ver.png') }}" title="Ver Detalles">
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('vehiculos.edit')
                                        <a href="{{ route('vehiculos.edit', $item) }}">
                                            <img class="img-responsive img-rounded float-right" src="{{ asset('images/actualizar.png') }}" title="Actualizar">
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('vehiculos.destroy')
                                        {!! Form::open(['route' => ['vehiculos.destroy', $item->id],
                                        'method' => 'DELETE']) !!}
                                            <input type=image src="{{ asset('images/basura.png') }}" title="Eliminar">
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $vehiculo->links() }}
                fin card body
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
--}}
