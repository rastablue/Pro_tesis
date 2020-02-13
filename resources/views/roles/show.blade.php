@extends('layouts.app')

@section('content')

<!-- Tabla del Cliente -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Detalles del Rol:</b><i> {{ $role->name }} </i></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
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
                    {!! Form::model($role, ['route' => ['roles.show', $role->id]]) !!}
                    <hr>
                    <h3>Permisos Especiales</h3>
                    <div class="form-group">
                        <label>{{ Form::radio('special', 'all-access', null, ['disabled' => 'true']) }} Acceso Total</label>
                        <label>{{ Form::radio('special', 'no-access', null, ['disabled' => 'true']) }} Ningun Acceso</label>
                    </div>
                        <hr>
                        <h3>Lista de Permisos</h3>
                        <div class="form-group">
                            <ul class="list-unstyled">
                                @foreach ($permissions as $permission)
                                    <li>
                                        <label>
                                            {{ Form::checkbox('permissions[]', $permission->id, null, ['disabled' => 'true']) }}
                                            {{ $permission->name }}
                                            <em>({{ $permission->description ?: 'N/A' }})</em>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
