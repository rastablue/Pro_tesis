@can('trabajos.edit')
    <a href="{{ route('trabajos.edit', $id) }}" class="btn btn-sm btn-warning">
        Editar
    </a>
@endcan
@can('trabajos.destroy')
<button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Eliminar</button>
@endcan
