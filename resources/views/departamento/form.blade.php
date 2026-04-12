<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $departamento?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="pais_id" class="form-label">{{ __('Pais') }}</label>
            <select name="pais_id" id="pais_id" class="form-control @error('pais_id') is-invalid @enderror">
                <option value="">{{ __('Seleccione un país') }}</option>
                @foreach ($paises as $paisOption)
                    <option value="{{ $paisOption->id }}" @selected((string) old('pais_id', $departamento?->pais_id) === (string) $paisOption->id)>
                        {{ $paisOption->nombre }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('pais_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="coordenadas" class="form-label">{{ __('Coordenadas') }}</label>
            <input type="text" name="coordenadas" class="form-control @error('coordenadas') is-invalid @enderror" value="{{ old('coordenadas', $departamento?->coordenadas) }}" id="coordenadas" placeholder="{{ __('Coordenadas') }}">
            {!! $errors->first('coordenadas', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="zoom" class="form-label">{{ __('Zoom') }}</label>
            <input type="text" name="zoom" class="form-control @error('zoom') is-invalid @enderror" value="{{ old('zoom', $departamento?->zoom) }}" id="zoom" placeholder="Zoom">
            {!! $errors->first('zoom', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>