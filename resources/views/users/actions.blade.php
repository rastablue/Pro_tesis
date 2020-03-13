@can('users.show')
    <a href="{{ route('users.show', Hashids::encode($id)) }}" class="btn btn-sm btn-info">
        Ver
    </a>
@endcan
@can('users.edit')
    <a href="{{ route('users.edit', Hashids::encode($id)) }}" class="btn btn-sm btn-warning">
        Editar
    </a>
@endcan
@can('users.destroy')
<button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Eliminar</button>
@endcan
