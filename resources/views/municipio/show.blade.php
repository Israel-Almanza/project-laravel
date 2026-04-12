@extends('layouts.app')

@section('template_title')
    {{ $municipio->name ?? __('Show') . " " . __('Municipio') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Municipio</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('municipios.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Prefijo:</strong>
                            {{ $municipio->prefijo }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Pais Id:</strong>
                            {{ $municipio->pais_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Departamento Id:</strong>
                            {{ $municipio->departamento_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Provincia Id:</strong>
                            {{ $municipio->provincia_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $municipio->nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Coordenadas:</strong>
                            {{ $municipio->coordenadas }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Zoom:</strong>
                            {{ $municipio->zoom }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
