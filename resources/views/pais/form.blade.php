@php
    $paisModel = (isset($pais) && $pais instanceof \App\Models\Pais) ? $pais : new \App\Models\Pais();
@endphp
<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="prefijo" class="form-label">{{ __('Prefijo') }}</label>
            <input type="text" name="prefijo" class="form-control @error('prefijo') is-invalid @enderror" value="{{ old('prefijo', $paisModel?->prefijo) }}" id="prefijo" placeholder="Prefijo">
            {!! $errors->first('prefijo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $paisModel?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="coordenadas" class="form-label">{{ __('Coordenadas') }}</label>
            <input type="text" name="coordenadas" class="form-control @error('coordenadas') is-invalid @enderror" value="{{ old('coordenadas', $paisModel?->coordenadas) }}" id="coordenadas" placeholder="{{ __('Coordenadas') }}">
            {!! $errors->first('coordenadas', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="zoom" class="form-label">{{ __('Zoom') }}</label>
            <input type="text" name="zoom" class="form-control @error('zoom') is-invalid @enderror" value="{{ old('zoom', $paisModel?->zoom) }}" id="zoom" placeholder="Zoom">
            {!! $errors->first('zoom', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>