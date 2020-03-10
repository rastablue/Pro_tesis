@can('mantenimientos.show')
    <a href="{{ route('mantenimientos.show', $id) }}" class="btn btn-sm btn-info">
        Ver
    </a>
@endcan
@can('mantenimientos.edit')
    <a href="{{ route('mantenimientos.edit', $id) }}" class="btn btn-sm btn-warning">
        Editar
    </a>
@endcan
@can('mantenimientos.destroy')
<button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Eliminar</button>
@endcan
