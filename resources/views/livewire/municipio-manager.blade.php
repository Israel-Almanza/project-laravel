<div class="row g-4" wire:key="municipio-manager-root">
    <div class="col-md-3">
        <div class="card module-form-card shadow-sm border-0 h-100">
            <div class="card-header bg-white fw-semibold py-3 px-3 border-bottom">
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
                    <label for="mun-prefijo" class="form-label small text-muted text-uppercase fw-semibold">{{ __('Prefijo') }}</label>
                    <input type="text" id="mun-prefijo" wire:model="prefijo" class="form-control rounded-3 @error('prefijo') is-invalid @enderror" placeholder="{{ __('Prefijo') }}">
                    @error('prefijo')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="mun-nombre" class="form-label small text-muted text-uppercase fw-semibold">{{ __('Nombre') }}</label>
                    <input type="text" id="mun-nombre" wire:model="nombre" class="form-control rounded-3 @error('nombre') is-invalid @enderror" placeholder="{{ __('Nombre') }}">
                    @error('nombre')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="mun-pais-id" class="form-label small text-muted text-uppercase fw-semibold">{{ __('País') }}</label>
                    <select id="mun-pais-id" wire:model="pais_id" class="form-select rounded-3 @error('pais_id') is-invalid @enderror">
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
                    <label for="mun-depto-id" class="form-label small text-muted text-uppercase fw-semibold">{{ __('Departamento') }}</label>
                    <select id="mun-depto-id" wire:model="departamento_id" class="form-select rounded-3 @error('departamento_id') is-invalid @enderror">
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
                    <label for="mun-prov-id" class="form-label small text-muted text-uppercase fw-semibold">{{ __('Provincia') }}</label>
                    <select id="mun-prov-id" wire:model="provincia_id" class="form-select rounded-3 @error('provincia_id') is-invalid @enderror">
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
                    <label for="mun-coordenadas" class="form-label small text-muted text-uppercase fw-semibold">{{ __('Coordenadas') }}</label>
                    <input type="text" id="mun-coordenadas" wire:model="coordenadas" class="form-control rounded-3 @error('coordenadas') is-invalid @enderror" placeholder="{{ __('Coordenadas') }}">
                    @error('coordenadas')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="mun-zoom" class="form-label small text-muted text-uppercase fw-semibold">{{ __('Zoom') }}</label>
                    <input type="text" id="mun-zoom" wire:model="zoom" class="form-control rounded-3 @error('zoom') is-invalid @enderror" placeholder="{{ __('Zoom') }}">
                    @error('zoom')
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
                <span class="fw-semibold mb-0">{{ __('Listado de municipios') }}</span>
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
                                    <td class="ps-3 text-muted small">{{ ($municipios->currentPage() - 1) * $municipios->perPage() + $loop->iteration }}</td>
                                    <td class="fw-medium">{{ $mun->prefijo }}</td>
                                    <td>{{ $mun->nombre }}</td>
                                    <td>{{ $mun->pais?->nombre ?? '—' }}</td>
                                    <td>{{ $mun->departamento?->nombre ?? '—' }}</td>
                                    <td>{{ $mun->provincia?->nombre ?? '—' }}</td>
                                    <td><span class="text-muted small">{{ $mun->coordenadas }}</span></td>
                                    <td><span class="text-muted small">{{ $mun->zoom }}</span></td>
                                    <td class="text-end pe-3">
                                        @if ($confirmingDeleteId === $mun->id)
                                            <div class="d-inline-flex flex-column align-items-end gap-1">
                                                <span class="small text-danger">{{ __('¿Eliminar este municipio?') }}</span>
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" wire:click="delete" class="btn btn-danger">{{ __('Sí') }}</button>
                                                    <button type="button" wire:click="cancelDelete" class="btn btn-outline-secondary">{{ __('No') }}</button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="d-inline-flex gap-1 justify-content-end">
                                                <button type="button" wire:click="edit({{ $mun->id }})" class="btn btn-light btn-icon border shadow-sm" title="{{ __('Editar') }}">
                                                    <i class="fa-solid fa-pen text-secondary"></i>
                                                </button>
                                                <button type="button" wire:click="askDelete({{ $mun->id }})" class="btn btn-light btn-icon border shadow-sm" title="{{ __('Eliminar') }}">
                                                    <i class="fa-solid fa-trash text-danger"></i>
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
            <div class="card-footer bg-white border-0 pt-2 pb-3 d-flex justify-content-center">
                {{ $municipios->links() }}
            </div>
        </div>
    </div>
</div>
