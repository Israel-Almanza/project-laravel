<div class="row g-3" wire:key="role-manager-root">
    <div class="col-md-2">
        <div class="card module-form-card border-0 h-100">
            <div class="card-header form-header py-2 px-3 border-bottom">
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
                        <label for="administrador" class="form-label small text-muted fw-semibold">{{ __('Administrador') }}</label>
                        <div wire:ignore class="w-100">
                            <select
                                id="administrador"
                                multiple
                                class="form-select form-select-sm rounded-3 @error('administrador') is-invalid @enderror"
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

                    <div class="mb-3">
                        <label for="representante" class="form-label small text-muted fw-semibold">{{ __('Representante') }}</label>
                        <div wire:ignore class="w-100">
                            <select
                                id="representante"
                                multiple
                                class="form-select form-select-sm rounded-3 @error('representante') is-invalid @enderror"
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

                <button type="button" wire:click="save" class="btn btn-custom w-100 py-1 fw-bold rounded-1 shadow-sm ">
                    @if ($editingId)
                        {{ __('Actualizar') }}
                    @else
                        {{ __('GUARDAR') }}
                    @endif
                </button>
                @if ($editingId)
                    <button type="button" wire:click="cancel" class="btn btn-outline-secondary w-100 mt-2 rounded-3">{{ __('Cancelar') }}</button>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-10">
        <div class="card module-table-card shadow-sm border-0">
            <div
                class="card-header bg-white py-3 px-3 border-bottom-0 d-flex flex-wrap align-items-center justify-content-start gap-3">
                <span class="fw-semibold mb-0">{{ __('Listado de roles') }}</span>

                <div class="dashboard-table-search flex-grow-1 flex-md-grow-0"
                    style="min-width: 200px; max-width: 320px;">
                    <div class="input-group input-group-sm shadow-sm rounded-3 overflow-hidden">
                        <input type="search" wire:model.live.debounce.350ms="search" class="form-control border-1"
                            placeholder="{{ __('Buscar…') }}" aria-label="{{ __('Buscar') }}">
                        <span class="input-group-text border-1 bg-white text-muted">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-sm  align-middle mb-0">
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
                                    <td class="text-end pe-2">
                                        @if ($confirmingDeleteId === $role->id)
                                            <div class="d-inline-flex flex-column align-items-end gap-1">
                                                <span class="small text-danger">{{ __('¿Eliminar este rol?') }}</span>
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" wire:click="delete" class="btn btn-danger btn-sm">
                                                        {{ __('Sí') }}
                                                    </button>
                                                    <button type="button" wire:click="cancelDelete"
                                                        class="btn btn-outline-secondary btn-sm">
                                                        {{ __('No') }}
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="d-inline-flex gap-1 justify-content-end">

                                                <!-- Editar -->
                                                <button type="button" wire:click="edit({{ $role->id }})"
                                                    class="btn btn-light p-0 d-flex align-items-center justify-content-center"
                                                    style="width:28px; height:28px;" title="{{ __('Editar') }}">
                                                    <i class="fa-solid fa-pen-to-square text-warning"
                                                        style="font-size:12px;"></i>
                                                </button>

                                                <button type="button" wire:click="askDelete({{ $role->id }})"
                                                    class="btn btn-light p-0 d-flex align-items-center justify-content-center"
                                                    style="width:28px; height:28px;" title="{{ __('Eliminar') }}">
                                                    <i class="fa-solid fa-trash text-danger" style="font-size:12px;"></i>
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
            <div class="card-footer bg-white border-0 pt-2 pb-3">
                <div class="d-flex justify-content-center">
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .form-header {
        background: #F9FAFD;
        font-size: 10px;
        font-weight: 500;
    }

    .btn-custom {
        background: #FF0A35;
        color: white;
    }

    .btn-custom:hover {
        background: #e60023;
        /* un poco más oscuro */
        color: white;
    }

    .module-form-card {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }
</style>
