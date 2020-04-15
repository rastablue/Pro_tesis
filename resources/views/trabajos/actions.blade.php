<a href="{{ route('mantenimientos.show', Hashids::encode(App\Mantenimiento::where('id', $mantenimiento_id)->first()->id)) }}" class="btn btn-sm btn-primary text-white">
    <i class="fas fa-eye"></i>
    Ver
</a>
@if ($estado == 'Finalizado')
    <button type="button" data-toggle="modal" data-target="#NoOptionModal" class="btn btn-secondary btn-sm">
        <i class="fas fa-flag"></i>
        Finalizar
    </button>
    <button type="button" data-toggle="modal" data-target="#NoOptionModal" class="btn btn-warning btn-sm" id="getFinalizaId">
        <i class="fas fa-pen"></i>
        Editar
    </button>
@else
    @can('trabajos.edit')
        <button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#FinalizaTrabajoModal" class="btn btn-secondary btn-sm" id="getFinalizaId">
            <i class="fas fa-flag"></i>
            Finalizar
        </button>
        <a href="{{ route('trabajos.edit', Hashids::encode($id)) }}" class="btn btn-sm btn-warning">
            <i class="fas fa-pen"></i>
            Editar
        </a>
    @endcan
@endif

@can('trabajos.destroy')
    <button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">
        <i class="fas fa-trash"></i>
        Eliminar
    </button>
@endcan
