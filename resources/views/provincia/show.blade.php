@extends('layouts.app')

@section('template_title')
    {{ $provincia->name ?? __('Show') . " " . __('Provincia') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Provincia</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('provincias.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Prefijo:</strong>
                            {{ $provincia->prefijo }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $provincia->nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Pais Id:</strong>
                            {{ $provincia->pais_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Departamento Id:</strong>
                            {{ $provincia->departamento_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Coordenadas:</strong>
                            {{ $provincia->coordenadas }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Zoom:</strong>
                            {{ $provincia->zoom }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
