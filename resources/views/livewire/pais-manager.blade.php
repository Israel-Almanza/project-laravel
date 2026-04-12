<div class="row g-4" wire:key="pais-manager-root">
    <div class="col-md-3">
        <div class="card module-form-card shadow-sm border-0 h-100">
            <div class="card-header bg-white fw-semibold py-3 px-3 border-bottom">
                @if ($editingId)
                    {{ __('Actualizar país') }}
                @else
                    {{ __('Crear país') }}
                @endif
            </div>
            <div class="card-body p-3 bg-white rounded-bottom">
                @if ($successMessage)
                    <div class="alert alert-success py-2 small mb-3" role="alert">{{ $successMessage }}</div>
                @endif

                <div class="mb-3">
                    <label for="pais-prefijo" class="form-label small text-muted text-uppercase fw-semibold">{{ __('Prefijo') }}</label>
                    <input type="text" id="pais-prefijo" wire:model="prefijo" class="form-control rounded-3 @error('prefijo') is-invalid @enderror" placeholder="{{ __('ARG') }}">
                    @error('prefijo')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pais-nombre" class="form-label small text-muted text-uppercase fw-semibold">{{ __('Pais') }}</label>
                    <input type="text" id="pais-nombre" wire:model="nombre" class="form-control rounded-3 @error('nombre') is-invalid @enderror" placeholder="{{ __('Argentina') }}">
                    @error('nombre')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="pais-coordenadas" class="form-label small text-muted text-uppercase fw-semibold">{{ __('Coordenadas') }}</label>
                        <input type="text" id="pais-coordenadas" wire:model="coordenadas" class="form-control rounded-3 @error('coordenadas') is-invalid @enderror" placeholder="{{ __('-33.44683, -70.66138') }}">
                        @error('coordenadas')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="pais-zoom" class="form-label small text-muted text-uppercase fw-semibold">{{ __('Zoom') }}</label>
                        <input type="text" id="pais-zoom" wire:model="zoom" class="form-control rounded-3 @error('zoom') is-invalid @enderror" placeholder="{{ __('15') }}">
                        @error('zoom')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="button" wire:click="save" class="btn btn-danger w-100 py-1 fw-bold rounded-3 shadow-sm text-uppercase">
                    @if ($editingId)
                        {{ __('Actualizar') }}
                    @else
                        {{ __('Guardar') }}
                    @endif
                </button>
                @if ($editingId)
                    <button type="button" wire:click="cancel" class="btn btn-outline-secondary w-100 mt-2 rounded-3">{{ __('Cancelar') }}</button>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card module-table-card shadow-sm border-0">
            <div class="card-header bg-white py-3 px-3 border-bottom-0 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <span class="fw-semibold mb-0">{{ __('Listado de países') }}</span>
                <div class="dashboard-table-search flex-grow-1 flex-md-grow-0" style="min-width: 200px; max-width: 320px;">
                    <div class="input-group input-group-sm shadow-sm rounded-3 overflow-hidden">
                        <span class="input-group-text border-0 bg-white text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input
                            type="search"
                            wire:model.live.debounce.350ms="search"
                            class="form-control border-0"
                            placeholder="{{ __('Buscar…') }}"
                            aria-label="{{ __('Buscar') }}"
                        >
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3" style="width: 4rem;">#</th>
                                <th>{{ __('Prefijo') }}</th>
                                <th>{{ __('Nombre') }}</th>
                                <th>{{ __('Coordenadas') }}</th>
                                <th>{{ __('Zoom') }}</th>
                                <th class="text-end pe-3" style="min-width: 8rem;">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($paises as $pai)
                                <tr wire:key="pais-row-{{ $pai->id }}">
                                    <td class="ps-3 text-muted small">{{ ($paises->currentPage() - 1) * $paises->perPage() + $loop->iteration }}</td>
                                    <td>{{ $pai->prefijo }}</td>
                                    <td class="fw-medium">{{ $pai->nombre }}</td>
                                    <td><span class="text-muted small">{{ $pai->coordenadas }}</span></td>
                                    <td><span class="text-muted small">{{ $pai->zoom }}</span></td>
                                    <td class="text-end pe-3">
                                        @if ($confirmingDeleteId === $pai->id)
                                            <div class="d-inline-flex flex-column align-items-end gap-1">
                                                <span class="small text-danger">{{ __('¿Eliminar este país?') }}</span>
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" wire:click="delete" class="btn btn-danger">{{ __('Sí') }}</button>
                                                    <button type="button" wire:click="cancelDelete" class="btn btn-outline-secondary">{{ __('No') }}</button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="d-inline-flex gap-1 justify-content-end">
                                                <button type="button" wire:click="edit({{ $pai->id }})" class="btn btn-light btn-icon border shadow-sm" title="{{ __('Editar') }}">
                                                    <i class="fa-solid fa-pen text-secondary"></i>
                                                </button>
                                                <button type="button" wire:click="askDelete({{ $pai->id }})" class="btn btn-light btn-icon border shadow-sm" title="{{ __('Eliminar') }}">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">{{ __('No hay países registrados.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-0 pt-2 pb-3 d-flex justify-content-center">
                {{ $paises->links() }}
            </div>
        </div>
    </div>
</div>
