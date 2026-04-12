<div class="row g-3" wire:key="municipio-manager-root">
    <div class="col-md-2">
        <div class="card module-form-card border-0 h-100">
            <div class="card-header form-header py-2 px-3 border-bottom">
                @if ($editingId)
                    {{ __('Actualizar municipio') }}
                @else
                    {{ __('Crear municipio') }}
                @endif
            </div>
            <div class="card-body p-3 bg-white rounded-bottom">
                @if ($successMessage)
                    <div class="alert alert-success py-2 small mb-3" role="alert">{{ $successMessage }}</div>
                @endif

                <div class="mb-3">
                    <label for="mun-prefijo" class="form-label small text-muted fw-semibold">{{ __('Prefijo') }}</label>
                    <input type="text" id="mun-prefijo" wire:model="prefijo" class="form-control form-control-sm rounded-3 @error('prefijo') is-invalid @enderror" placeholder="{{ __('SCZ') }}">
                    @error('prefijo')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="mun-nombre" class="form-label small text-muted fw-semibold">{{ __('Nombre') }}</label>
                    <input type="text" id="mun-nombre" wire:model="nombre" class="form-control form-control-sm rounded-3 @error('nombre') is-invalid @enderror" placeholder="{{ __('Santa Cruz de la Sierra') }}">
                    @error('nombre')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="mun-pais-id" class="form-label small text-muted fw-semibold">{{ __('País') }}</label>
                    <select id="mun-pais-id" wire:model="pais_id" class="form-select form-select-sm rounded-3 @error('pais_id') is-invalid @enderror">
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
                    <label for="mun-depto-id" class="form-label small text-muted fw-semibold">{{ __('Estado o Departamento') }}</label>
                    <select id="mun-depto-id" wire:model="departamento_id" class="form-select form-select-sm rounded-3 @error('departamento_id') is-invalid @enderror">
                        <option value="">{{ __('Seleccione un departamento') }}</option>
                        @foreach ($departamentos as $id => $labelDepto)
                            <option value="{{ $id }}">{{ $labelDepto }}</option>
                        @endforeach
                    </select>
                    @error('departamento_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="mun-prov-id" class="form-label small text-muted fw-semibold">{{ __('Provincia') }}</label>
                    <select id="mun-prov-id" wire:model="provincia_id" class="form-select form-select-sm rounded-3 @error('provincia_id') is-invalid @enderror">
                        <option value="">{{ __('Seleccione una provincia') }}</option>
                        @foreach ($provincias as $id => $labelProv)
                            <option value="{{ $id }}">{{ $labelProv }}</option>
                        @endforeach
                    </select>
                    @error('provincia_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="mun-coordenadas" class="form-label small text-muted fw-semibold">{{ __('Coordenadas') }}</label>
                    <input type="text" id="mun-coordenadas" wire:model="coordenadas" class="form-control form-control-sm rounded-3 @error('coordenadas') is-invalid @enderror" placeholder="{{ __('Coordenadas') }}">
                    @error('coordenadas')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="mun-zoom" class="form-label small text-muted fw-semibold">{{ __('Zoom') }}</label>
                    <input type="text" id="mun-zoom" wire:model="zoom" class="form-control form-control-sm rounded-3 @error('zoom') is-invalid @enderror" placeholder="{{ __('Zoom') }}">
                    @error('zoom')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button type="button" wire:click="save" class="btn btn-custom w-100 py-1 fw-bold rounded-3 shadow-sm ">
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
                <span class="fw-semibold mb-0">{{ __('Municipio/Comuna/Ciudad') }}</span>

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
                                <th>{{ __('Municipio') }}</th>
                                <th>{{ __('País') }}</th>
                                <th>{{ __('Departamento') }}</th>
                                <th>{{ __('Provincia') }}</th>
                                <th>{{ __('Coordenadas') }}</th>
                                <th>{{ __('Zoom') }}</th>
                                <th class="text-end pe-3" style="min-width: 8rem;">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($municipios as $mun)
                                <tr wire:key="municipio-row-{{ $mun->id }}">
                                    <td class="ps-3">{{ $mun->prefijo }}</td>
                                    <td>{{ $mun->nombre }}</td>
                                    <td>{{ $mun->pais?->nombre ?? '—' }}</td>
                                    <td>{{ $mun->departamento?->nombre ?? '—' }}</td>
                                    <td>{{ $mun->provincia?->nombre ?? '—' }}</td>
                                    <td><span class="text-muted small">{{ $mun->coordenadas }}</span></td>
                                    <td><span class="text-muted small">{{ $mun->zoom }}</span></td>
                                    <td class="text-end pe-2">
                                        @if ($confirmingDeleteId === $mun->id)
                                            <div class="d-inline-flex flex-column align-items-end gap-1">
                                                <span class="small text-danger">{{ __('¿Eliminar este municipio?') }}</span>
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
                                                <button type="button" wire:click="edit({{ $mun->id }})"
                                                    class="btn btn-light p-0 d-flex align-items-center justify-content-center"
                                                    style="width:28px; height:28px;" title="{{ __('Editar') }}">
                                                    <i class="fa-solid fa-pen-to-square text-warning"
                                                        style="font-size:12px;"></i>
                                                </button>

                                                <button type="button" wire:click="askDelete({{ $mun->id }})"
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
                                    <td colspan="9" class="text-center text-muted py-5">{{ __('No hay municipios registrados.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-0 pt-2 pb-3">
                <div class="d-flex justify-content-center">
                    {{ $municipios->links() }}
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
