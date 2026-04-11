<div class="row">
    <div class="col-md-3">
        <div class="card card-default">
            <div class="card-header">
                <span class="card-title">
                    @if ($editingId)
                        {{ __('Update') }} {{ __('Pais') }}
                    @else
                        {{ __('Create') }} {{ __('Pais') }}
                    @endif
                </span>
            </div>
            <div class="card-body bg-white">
                @if ($successMessage)
                    <div class="alert alert-success py-2 small" role="alert">{{ $successMessage }}</div>
                @endif

                <div class="mb-3">
                    <label for="prefijo" class="form-label">{{ __('Prefijo') }}</label>
                    <input type="text" id="prefijo" wire:model="prefijo" class="form-control @error('prefijo') is-invalid @enderror" placeholder="{{ __('Prefijo') }}">
                    @error('prefijo')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
                    <input type="text" id="nombre" wire:model="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="{{ __('Nombre') }}">
                    @error('nombre')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="coordena" class="form-label">{{ __('Coordena') }}</label>
                    <input type="text" id="coordena" wire:model="coordena" class="form-control @error('coordena') is-invalid @enderror" placeholder="{{ __('Coordena') }}">
                    @error('coordena')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="zoom" class="form-label">{{ __('Zoom') }}</label>
                    <input type="text" id="zoom" wire:model="zoom" class="form-control @error('zoom') is-invalid @enderror" placeholder="{{ __('Zoom') }}">
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
                <span class="card-title">{{ __('Pais') }}</span>
            </div>
            <div class="card-body bg-white">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead">
                            <tr>
                                <th>No</th>
                                <th>{{ __('Prefijo') }}</th>
                                <th>{{ __('Nombre') }}</th>
                                <th>{{ __('Coordena') }}</th>
                                <th>{{ __('Zoom') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($paises as $pai)
                                <tr wire:key="pais-row-{{ $pai->id }}">
                                    <td>{{ ($paises->currentPage() - 1) * $paises->perPage() + $loop->iteration }}</td>
                                    <td>{{ $pai->prefijo }}</td>
                                    <td>{{ $pai->nombre }}</td>
                                    <td>{{ $pai->coordena }}</td>
                                    <td>{{ $pai->zoom }}</td>
                                    <td style="min-width: 220px;">
                                        @if ($confirmingDeleteId === $pai->id)
                                            <span class="small text-danger d-block mb-1">{{ __('Are you sure you want to delete this country?') }}</span>
                                            <div class="d-flex flex-wrap gap-1">
                                                <button type="button" wire:click="delete" class="btn btn-danger btn-sm">{{ __('Confirm') }}</button>
                                                <button type="button" wire:click="cancelDelete" class="btn btn-secondary btn-sm">{{ __('Cancel') }}</button>
                                            </div>
                                        @else
                                            <div class="d-flex flex-wrap gap-1">
                                                <button type="button" wire:click="edit({{ $pai->id }})" class="btn btn-success btn-sm">{{ __('Edit') }}</button>
                                                <button type="button" wire:click="askDelete({{ $pai->id }})" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">{{ __('No countries yet.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-2">
            {{ $paises->links() }}
        </div>
    </div>
</div>
