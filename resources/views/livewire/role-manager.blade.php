<div class="row g-4" wire:key="role-manager-root">
    <div class="col-md-3">
        <div class="card module-form-card shadow-sm border-0 h-100">
            <div class="card-header bg-white fw-semibold py-3 px-3 border-bottom">
                @if ($editingId)
                    {{ __('Actualizar rol') }}
                @else
                    {{ __('Crear rol') }}
                @endif
            </div>
            <div class="card-body p-3 bg-white rounded-bottom" wire:init="syncTomSelectBrowser">
                @if ($successMessage)
                    <div class="alert alert-success py-2 small mb-3" role="alert">{{ $successMessage }}</div>
                @endif

                <div class="role-ts-form" data-role-ts-wrap data-lw-id="{{ $this->getId() }}">
                    <div class="mb-3">
                        <label for="administrador" class="form-label small text-muted text-uppercase fw-semibold">{{ __('Administrador') }}</label>
                        <div wire:ignore class="w-100">
                            <select
                                id="administrador"
                                multiple
                                class="form-select rounded-3 @error('administrador') is-invalid @enderror"
                            >
                                <option value="Coordinador">{{ __('Coordinador') }}</option>
                                <option value="Home">{{ __('Home') }}</option>
                                <option value="Soporte">{{ __('Soporte') }}</option>
                            </select>
                        </div>
                        @error('administrador')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @error('administrador.*')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="representante" class="form-label small text-muted text-uppercase fw-semibold">{{ __('Representante') }}</label>
                        <div wire:ignore class="w-100">
                            <select
                                id="representante"
                                multiple
                                class="form-select rounded-3 @error('representante') is-invalid @enderror"
                            >
                                <option value="Home">{{ __('Home') }}</option>
                                <option value="Dashboard">{{ __('Dashboard') }}</option>
                            </select>
                        </div>
                        @error('representante')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @error('representante.*')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
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
                <span class="fw-semibold mb-0">{{ __('Listado de roles') }}</span>
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
                                <th>{{ __('Administrador') }}</th>
                                <th>{{ __('Representante') }}</th>
                                <th class="text-end pe-3" style="min-width: 8rem;">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr wire:key="role-row-{{ $role->id }}">
                                    <td class="ps-3 text-muted small">{{ $role->id }}</td>
                                    <td>{{ \App\Livewire\RoleManager::etiquetasLista($role->administrador) }}</td>
                                    <td>{{ \App\Livewire\RoleManager::etiquetasLista($role->representante) }}</td>
                                    <td class="text-end pe-3">
                                        @if ($confirmingDeleteId === $role->id)
                                            <div class="d-inline-flex flex-column align-items-end gap-1">
                                                <span class="small text-danger">{{ __('¿Eliminar este rol?') }}</span>
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" wire:click="delete" class="btn btn-danger">{{ __('Sí') }}</button>
                                                    <button type="button" wire:click="cancelDelete" class="btn btn-outline-secondary">{{ __('No') }}</button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="d-inline-flex gap-1 justify-content-end">
                                                <button type="button" wire:click="edit({{ $role->id }})" class="btn btn-light btn-icon border shadow-sm" title="{{ __('Editar') }}">
                                                    <i class="fa-solid fa-pen text-secondary"></i>
                                                </button>
                                                <button type="button" wire:click="askDelete({{ $role->id }})" class="btn btn-light btn-icon border shadow-sm" title="{{ __('Eliminar') }}">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-5">{{ __('No hay roles registrados.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-0 pt-2 pb-3 d-flex justify-content-center">
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</div>
