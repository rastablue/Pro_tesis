@can('vehiculos.show')
    <a href="{{ route('vehiculos.show', Hashids::encode($id)) }}" class="btn btn-sm btn-info">
        Ver
    </a>
@endcan
@can('vehiculos.edit')
    <a href="{{ route('vehiculos.edit', Hashids::encode($id)) }}" class="btn btn-sm btn-warning">
        Editar
    </a>
@endcan
@can('vehiculos.destroy')
<button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Eliminar</button>
@endcan
