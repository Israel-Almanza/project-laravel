<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="pais_id" class="form-label">{{ __('Pais Id') }}</label>
            <input type="text" name="pais_id" class="form-control @error('pais_id') is-invalid @enderror" value="{{ old('pais_id', $provincia?->pais_id) }}" id="pais_id" placeholder="Pais Id">
            {!! $errors->first('pais_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="departamento_id" class="form-label">{{ __('Departamento Id') }}</label>
            <input type="text" name="departamento_id" class="form-control @error('departamento_id') is-invalid @enderror" value="{{ old('departamento_id', $provincia?->departamento_id) }}" id="departamento_id" placeholder="Departamento Id">
            {!! $errors->first('departamento_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="coordenadas" class="form-label">{{ __('Coordenadas') }}</label>
            <input type="text" name="coordenadas" class="form-control @error('coordenadas') is-invalid @enderror" value="{{ old('coordenadas', $provincia?->coordenadas) }}" id="coordenadas" placeholder="{{ __('Coordenadas') }}">
            {!! $errors->first('coordenadas', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="zoom" class="form-label">{{ __('Zoom') }}</label>
            <input type="text" name="zoom" class="form-control @error('zoom') is-invalid @enderror" value="{{ old('zoom', $provincia?->zoom) }}" id="zoom" placeholder="Zoom">
            {!! $errors->first('zoom', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>