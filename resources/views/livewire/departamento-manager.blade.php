<div class="row" wire:key="departamento-manager-root">
    <div class="col-md-3">
        <div class="card card-default">
            <div class="card-header">
                <span class="card-title">
                    @if ($editingId)
                        {{ __('Update') }} {{ __('Departamento') }}
                    @else
                        {{ __('Create') }} {{ __('Departamento') }}
                    @endif
                </span>
            </div>
            <div class="card-body bg-white">
                @if ($successMessage)
                    <div class="alert alert-success py-2 small" role="alert">{{ $successMessage }}</div>
                @endif

                <div class="mb-3">
                    <label for="dept-nombre" class="form-label">{{ __('Nombre') }}</label>
                    <input type="text" id="dept-nombre" wire:model="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="{{ __('Nombre') }}">
                    @error('nombre')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="dept-pais-id" class="form-label">{{ __('Pais') }}</label>
                    <select id="dept-pais-id" wire:model="pais_id" class="form-select @error('pais_id') is-invalid @enderror">
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
                    <label for="dept-coordena" class="form-label">{{ __('Coordena') }}</label>
                    <input type="text" id="dept-coordena" wire:model="coordena" class="form-control @error('coordena') is-invalid @enderror" placeholder="{{ __('Coordena') }}">
                    @error('coordena')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="dept-zoom" class="form-label">{{ __('Zoom') }}</label>
                    <input type="text" id="dept-zoom" wire:model="zoom" class="form-control @error('zoom') is-invalid @enderror" placeholder="{{ __('Zoom') }}">
                    @error('zoom')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="button" wire:click="save" class="btn btn-primary">
                        @if ($editingId)
                            {{ __('Update') }}
                        @else
                            {{ __('Save') }}
                        @endif
                    </button>
                    @if ($editingId)
                        <button type="button" wire:click="cancel" class="btn btn-outline-secondary">{{ __('Cancel') }}</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card card-default">
            <div class="card-header">
                <span class="card-title">{{ __('Departamento') }}</span>
            </div>
            <div class="card-body bg-white">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead">
                            <tr>
                                <th>No</th>
                                <th>{{ __('Nombre') }}</th>
                                <th>{{ __('Pais') }}</th>
                                <th>{{ __('Coordena') }}</th>
                                <th>{{ __('Zoom') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($departamentos as $depto)
                                <tr wire:key="departamento-row-{{ $depto->id }}">
                                    <td>{{ ($departamentos->currentPage() - 1) * $departamentos->perPage() + $loop->iteration }}</td>
                                    <td>{{ $depto->nombre }}</td>
                                    <td>{{ $depto->pais?->nombre ?? '—' }}</td>
                                    <td>{{ $depto->coordena }}</td>
                                    <td>{{ $depto->zoom }}</td>
                                    <td style="min-width: 220px;">
                                        @if ($confirmingDeleteId === $depto->id)
                                            <span class="small text-danger d-block mb-1">{{ __('Are you sure you want to delete this department?') }}</span>
                                            <div class="d-flex flex-wrap gap-1">
                                                <button type="button" wire:click="delete" class="btn btn-danger btn-sm">{{ __('Confirm') }}</button>
                                                <button type="button" wire:click="cancelDelete" class="btn btn-secondary btn-sm">{{ __('Cancel') }}</button>
                                            </div>
                                        @else
                                            <div class="d-flex flex-wrap gap-1">
                                                <button type="button" wire:click="edit({{ $depto->id }})" class="btn btn-success btn-sm">{{ __('Edit') }}</button>
                                                <button type="button" wire:click="askDelete({{ $depto->id }})" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">{{ __('No departments yet.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-2">
            {{ $departamentos->links() }}
        </div>
    </div>
</div>
