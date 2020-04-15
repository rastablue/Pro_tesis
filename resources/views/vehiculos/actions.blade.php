@can('mantenimientos.create')
    <a href="{{ route('mantenimientos.createfromvehiculos', Hashids::encode($id)) }}" class="btn btn-sm btn-success">
        <i class="fas fa-plus"></i>
        Mantenimiento
    </a>
@endcan
@can('vehiculos.show')
    <a href="{{ route('vehiculos.show', Hashids::encode($id)) }}" class="btn btn-sm btn-primary text-white">
        <i class="fas fa-eye"></i>
        Ver
    </a>
@endcan
@can('vehiculos.edit')
    <a href="{{ route('vehiculos.edit', Hashids::encode($id)) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-pen"></i>
        Editar
    </a>
@endcan
@can('vehiculos.destroy')
    <button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">
        <i class="fas fa-trash"></i>
        Eliminar
    </button>
@endcan
