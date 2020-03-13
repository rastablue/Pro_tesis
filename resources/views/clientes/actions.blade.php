@can('clientes.show')
    <a href="{{ route('clientes.show', Hashids::encode($id)) }}" class="btn btn-sm btn-info">
        Ver
    </a>
@endcan
@can('clientes.edit')
    <a href="{{ route('clientes.edit', Hashids::encode($id)) }}" class="btn btn-sm btn-warning">
        Editar
    </a>
@endcan
@can('clientes.destroy')
<button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Eliminar</button>
@endcan
