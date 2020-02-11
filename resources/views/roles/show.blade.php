@extends('layouts.app')

@section('content')

<!-- Tabla del Cliente -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Detalles del Rol:</b><i> {{ $role->name }} </i></h4></span>
                    <a href="javascript:history.back()" class="btn btn-primary btn-sm">Volver</a>
                </div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr class="table-secondary">
                                <th scope="col"><div class="text-center">Nombre</div></th>
                                <th scope="col"><div class="text-center">Slug</div></th>
                                <th scope="col" width="400px"><div class="text-center">Descripcion</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><div class="text-center">{{ $role->name }}</div></td>
                                <td><div class="text-center">{{ $role->slug }}</div></td>
                                <td><div class="text-center">{{ $role->description }}</div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
