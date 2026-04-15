<div class="row g-3" wire:key="provincia-manager-root">
    <div class="col-md-2">
        <div class="card module-form-card border-0 h-100">
            <div class="card-header form-header py-2 px-3 border-bottom">
                @if ($editingId)
                    {{ __('Actualizar provincia') }}
                @else
                    {{ __('Crear provincia') }}
                @endif
            </div>
            <div class="card-body p-3 bg-white rounded-bottom">
                @if ($successMessage)
                    <div class="alert alert-success py-2 small mb-3" role="alert">{{ $successMessage }}</div>
                @endif

                <div class="mb-3">
                    <label for="prov-prefijo" class="form-label small text-muted fw-semibold">{{ __('Prefijo') }}</label>
                    <input type="text" id="prov-prefijo" wire:model="prefijo" class="form-control form-control-sm rounded-3 @error('prefijo') is-invalid @enderror" placeholder="{{ __('MUR') }}">
                    @error('prefijo')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="prov-nombre" class="form-label small text-muted fw-semibold">{{ __('Condado/Provincia') }}</label>
                    <input type="text" id="prov-nombre" wire:model="nombre" class="form-control form-control-sm rounded-3 @error('nombre') is-invalid @enderror" placeholder="{{ __('MURILLO') }}">
                    @error('nombre')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="prov-pais-id" class="form-label small text-muted fw-semibold">{{ __('País') }}</label>
                    <select id="prov-pais-id" wire:model="pais_id" class="form-select form-select-sm rounded-3 @error('pais_id') is-invalid @enderror">
                        <option value="">{{ __('Seleccione un país') }}</option>
                        @foreach ($paises as $id => $nombrePais)
                            <option value="{{ $id }}">{{ $nombrePais }}</option>
                        @endforeach
                    </select>
                    @error('pais_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="prov-depto-id" class="form-label small text-muted fw-semibold">{{ __('Departamento') }}</label>
                    <select id="prov-depto-id" wire:model="departamento_id" class="form-select form-select-sm rounded-3 @error('departamento_id') is-invalid @enderror">
                        <option value="">{{ __('Seleccione un departamento') }}</option>
                        @foreach ($departamentos as $id => $labelDepto)
                            <option value="{{ $id }}">{{ $labelDepto }}</option>
                        @endforeach
                    </select>
                    @error('departamento_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="pais-coordenadas" class="form-label small text-muted fw-semibold">{{ __('Coordenadas') }}</label>
                        <input type="text" id="pais-coordenadas" wire:model="coordenadas" class="form-control form-control-sm rounded-3 @error('coordenadas') is-invalid @enderror" placeholder="{{ __('-33.44683, -70.66138') }}">
                        @error('coordenadas')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="pais-zoom" class="form-label small text-muted fw-semibold">{{ __('Zoom') }}</label>
                        <input type="text" id="pais-zoom" wire:model="zoom" class="form-control form-control-sm rounded-3 @error('zoom') is-invalid @enderror" placeholder="{{ __('15') }}">
                        @error('zoom')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="button" wire:click="save" class="btn btn-custom w-100 py-1 fw-bold rounded-1 shadow-sm ">
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

    <div class="col-md-10">
        <div class="card module-table-card shadow-sm border-0">
            <div
                class="card-header bg-white py-3 px-3 border-bottom-0 d-flex flex-wrap align-items-center justify-content-start gap-3">
                <span class="fw-semibold mb-0">{{ __('Condado/Provincia') }}</span>

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
                                <th class="ps-3">{{ __('Prefijo') }}</th>
                                <th>{{ __('Condado/Provincia') }}</th>
                                <th>{{ __('País') }}</th>
                                <th>{{ __('Departamento') }}</th>
                                <th>{{ __('Coordenadas') }}</th>
                                <th>{{ __('Zoom') }}</th>
                                <th class="text-end pe-3" style="min-width: 8rem;">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($provincias as $prov)
                                <tr wire:key="provincia-row-{{ $prov->id }}">
                                    <td class="ps-3">{{ $prov->prefijo }}</td>
                                    <td>{{ $prov->nombre }}</td>
                                    <td>{{ $prov->pais?->nombre ?? '—' }}</td>
                                    <td>{{ $prov->departamento?->nombre ?? '—' }}</td>
                                    <td><span class="text-muted small">{{ $prov->coordenadas }}</span></td>
                                    <td><span class="text-muted small">{{ $prov->zoom }}</span></td>
                                    <td class="text-end pe-2">
                                        @if ($confirmingDeleteId === $prov->id)
                                            <div class="d-inline-flex flex-column align-items-end gap-1">
                                                <span class="small text-danger">{{ __('¿Eliminar esta provincia?') }}</span>
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
                                                <button type="button" wire:click="edit({{ $prov->id }})"
                                                    class="btn btn-light p-0 d-flex align-items-center justify-content-center"
                                                    style="width:28px; height:28px;" title="{{ __('Editar') }}">
                                                    <i class="fa-solid fa-pen-to-square text-warning"
                                                        style="font-size:12px;"></i>
                                                </button>

                                                <button type="button" wire:click="askDelete({{ $prov->id }})"
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
                                    <td colspan="8" class="text-center text-muted py-5">{{ __('No hay provincias registradas.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-0 pt-2 pb-3">
                <div class="d-flex justify-content-center">
                    {{ $provincias->links() }}
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
