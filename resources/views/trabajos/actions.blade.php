<a href="{{ route('mantenimientos.show', Hashids::encode(App\Mantenimiento::where('id', $mantenimiento_id)->first()->id)) }}" class="btn btn-sm btn-info">
    Ver
</a>
@if ($estado == 'Finalizado')
    <button type="button" data-toggle="modal" data-target="#NoOptionModal" class="btn btn-secondary btn-sm">Finalizar</button>
    <button type="button" data-toggle="modal" data-target="#NoOptionModal" class="btn btn-warning btn-sm" id="getFinalizaId">Editar</button>
@else
    @can('trabajos.edit')
        <button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#FinalizaTrabajoModal" class="btn btn-secondary btn-sm" id="getFinalizaId">Finalizar</button>
        <a href="{{ route('trabajos.edit', Hashids::encode($id)) }}" class="btn btn-sm btn-warning">
            Editar
        </a>
    @endcan
@endif

@can('trabajos.destroy')
    <button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Eliminar</button>
@endcan
