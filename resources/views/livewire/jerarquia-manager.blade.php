<div class="row g-4" wire:key="jerarquia-manager-root">
    <div class="col-md-3">
        <div class="card module-form-card shadow-sm border-0 h-100">
            <div class="card-header bg-white fw-semibold py-3 px-3 border-bottom">
                @if ($editingId)
                    {{ __('Actualizar jerarquía') }}
                @else
                    {{ __('Crear jerarquía') }}
                @endif
            </div>
            <div class="card-body p-3 bg-white rounded-bottom">
                @if ($successMessage)
                    <div class="alert alert-success py-2 small mb-3" role="alert">{{ $successMessage }}</div>
                @endif

                <div class="mb-3">
                    <label for="jerarquia-prefijo" class="form-label small text-muted text-uppercase fw-semibold">{{ __('Prefijo') }}</label>
                    <input type="text" id="jerarquia-prefijo" wire:model="prefijo" class="form-control rounded-3 @error('prefijo') is-invalid @enderror" placeholder="{{ __('Prefijo') }}">
                    @error('prefijo')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="jerarquia-organizacion" class="form-label small text-muted text-uppercase fw-semibold">{{ __('Organización') }}</label>
                    <input type="text" id="jerarquia-organizacion" wire:model="organizacion" class="form-control rounded-3 @error('organizacion') is-invalid @enderror" placeholder="{{ __('Organización') }}">
                    @error('organizacion')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button type="button" wire:click="save" class="btn btn-danger w-100 py-3 fw-bold rounded-3 shadow-sm text-uppercase">
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
                <span class="fw-semibold mb-0">{{ __('Listado de jerarquías') }}</span>
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
                                <th class="ps-3" style="width: 5rem;">{{ __('ID') }}</th>
                                <th>{{ __('Prefijo') }}</th>
                                <th>{{ __('Organización') }}</th>
                                <th class="text-end pe-3" style="min-width: 8rem;">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jerarquias as $jerarquia)
                                <tr wire:key="jerarquia-row-{{ $jerarquia->id }}">
                                    <td class="ps-3 text-muted small">{{ $jerarquia->id }}</td>
                                    <td class="fw-medium">{{ $jerarquia->prefijo }}</td>
                                    <td>{{ $jerarquia->organizacion }}</td>
                                    <td class="text-end pe-3">
                                        @if ($confirmingDeleteId === $jerarquia->id)
                                            <div class="d-inline-flex flex-column align-items-end gap-1">
                                                <span class="small text-danger">{{ __('¿Eliminar esta jerarquía?') }}</span>
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" wire:click="delete" class="btn btn-danger">{{ __('Sí') }}</button>
                                                    <button type="button" wire:click="cancelDelete" class="btn btn-outline-secondary">{{ __('No') }}</button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="d-inline-flex gap-1 justify-content-end">
                                                <button type="button" wire:click="edit({{ $jerarquia->id }})" class="btn btn-light btn-icon border shadow-sm" title="{{ __('Editar') }}">
                                                    <i class="fa-solid fa-pen text-secondary"></i>
                                                </button>
                                                <button type="button" wire:click="askDelete({{ $jerarquia->id }})" class="btn btn-light btn-icon border shadow-sm" title="{{ __('Eliminar') }}">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-5">{{ __('No hay jerarquías registradas.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-0 pt-2 pb-3 d-flex justify-content-center">
                {{ $jerarquias->links() }}
            </div>
        </div>
    </div>
</div>
