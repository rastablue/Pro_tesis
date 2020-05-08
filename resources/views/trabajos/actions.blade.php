@can('trabajos.show')
    <a href="{{ route('mantenimientos.show', Hashids::encode(App\Mantenimiento::where('id', $mantenimiento_id)->first()->id)) }}" class="btn btn-sm btn-primary text-white">
        <i class="fas fa-eye"></i>
        Ver
    </a>
@endcan

@if ($estado != 'Finalizado')
    @can('trabajos.edit')
        <button type="button" data-id="{{ $id }}" data-manobra="{{ $manobra }}" data-diagnostico="{{ $diagnostico }}" data-toggle="modal" data-target="#RevisaTareaModal" class="btn btn-warning btn-sm" id="getActualizaId">
            <i class="fas fa-fw fa-check-circle"></i>
            Revisar
        </button>
    @endcan
@else
    @can('trabajos.edit')
        <button type="button" data-toggle="modal" data-manobra="{{ $manobra }}" data-diagnostico="{{ $diagnostico }}" data-target="#NoOptionModal" class="btn btn-warning btn-sm">
            <i class="fas fa-fw fa-check-circle"></i>
            Revisar
        </button>
    @endcan
@endif

@can('trabajos.destroy')
    <button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">
        <i class="fas fa-trash"></i>
        Eliminar
    </button>
@endcan
