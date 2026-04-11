<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $departamento?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="pais" class="form-label">{{ __('Pais') }}</label>
            <input type="text" name="pais" class="form-control @error('pais') is-invalid @enderror" value="{{ old('pais', $departamento?->pais) }}" id="pais" placeholder="Pais">
            {!! $errors->first('pais', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="coordena" class="form-label">{{ __('Coordena') }}</label>
            <input type="text" name="coordena" class="form-control @error('coordena') is-invalid @enderror" value="{{ old('coordena', $departamento?->coordena) }}" id="coordena" placeholder="Coordena">
            {!! $errors->first('coordena', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
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