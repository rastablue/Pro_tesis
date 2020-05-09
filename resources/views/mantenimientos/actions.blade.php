@can('trabajos.create')
    @if ($estado != 'Finalizado')
        <a href="{{ route('trabajos.show', Hashids::encode($id)) }}" class="btn btn-sm btn-success">
            <i class="fas fa-fw fa-plus"></i>
            Trabajo
        </a>
    @else
        <button type="button" data-toggle="modal" data-observacion="{{ $observacion }}" data-diagnostico="{{ $diagnostico }}" data-target="#NoOptionModal" class="btn btn-success btn-sm">
            <i class="fas fa-plus"></i>
            Trabajo
        </button>
    @endif
@endcan
@can('mantenimientos.show')
    <a href="{{ route('mantenimientos.show', Hashids::encode($id)) }}" class="btn btn-sm btn-primary text-white">
        <i class="fas fa-eye"></i>
        Ver
    </a>
@endcan
@can('mantenimientos.revisar')

    @if ($estado != 'Finalizado')
        <button type="button" data-id="{{ $id }}" data-toggle="modal" data-observacion="{{ $observacion }}" data-diagnostico="{{ $diagnostico }}" data-target="#RevisaTareaModal" class="btn btn-warning btn-sm" id="getActualizaId">
            <i class="fas fa-fw fa-check-circle"></i>
            Revisar
        </button>
    @else
        <button type="button" data-toggle="modal" data-observacion="{{ $observacion }}" data-diagnostico="{{ $diagnostico }}" data-target="#NoOptionModal" class="btn btn-warning btn-sm">
            <i class="fas fa-fw fa-check-circle"></i>
            Revisar
        </button>
    @endif

@endcan
@can('mantenimientos.destroy')
    <button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">
        <i class="fas fa-trash"></i>
        Eliminar
    </button>
@endcan
