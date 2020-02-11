@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Lista de Roles</b></h4></span>
                    <a href="javascript:history.back()" class="btn btn-primary btn-sm">Volver</a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr class="table-secondary">
                                <th></th>
                                <th scope="col"><div class="text-center">Nombre</div></th>
                                <th scope="col"><div class="text-center">Slug</div></th>
                                <th scope="col" width="400px"><div class="text-center">Descripcion</div></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($role->get() as $item)
                            <tr>
                                <th scope="row"><i>{{ $loop->iteration }}</i></th>
                                <td><div class="text-center">{{ $item->name }}</div></td>
                                <td><div class="text-center">{{ $item->slug }}</div></td>
                                <td><div class="text-center">{{ $item->description }}</div></td>
                                <td>

                                    @can('roles.show')
                                        <a href="{{ route('roles.show', $item) }}">
                                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/ver.png') }}">
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('roles.edit')
                                        <a href="{{ route('roles.edit', $item) }}">
                                            <img class="img-responsive img-rounded float-right" src="{{ asset('images/actualizar.png') }}">
                                        </a>
                                    @endcan

                                </td>
                                <td>

                                    @can('roles.destroy')
                                        {!! Form::open(['route' => ['roles.destroy', $item->id],
                                        'method' => 'DELETE']) !!}
                                            <input type=image src="{{ asset('images/basura.png') }}">
                                        {!! Form::close() !!}
                                    @endcan

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                {{-- fin card body --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
