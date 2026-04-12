@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card card-default shadow-sm mb-0">
            <div class="card-header bg-white border-bottom">
                <ul class="nav nav-tabs card-header-tabs" id="dashboardTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link active"
                            id="tab-paises"
                            data-bs-toggle="tab"
                            data-bs-target="#pane-paises"
                            type="button"
                            role="tab"
                            aria-controls="pane-paises"
                            aria-selected="true"
                        >
                            {{ __('Países') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="tab-departamentos"
                            data-bs-toggle="tab"
                            data-bs-target="#pane-departamentos"
                            type="button"
                            role="tab"
                            aria-controls="pane-departamentos"
                            aria-selected="false"
                        >
                            {{ __('Departamentos') }}
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body bg-light">
                <div class="tab-content" id="dashboardTabsContent">
                    <div
                        class="tab-pane fade show active"
                        id="pane-paises"
                        role="tabpanel"
                        aria-labelledby="tab-paises"
                        tabindex="0"
                    >
                        <livewire:pais-manager />
                    </div>
                    <div
                        class="tab-pane fade"
                        id="pane-departamentos"
                        role="tabpanel"
                        aria-labelledby="tab-departamentos"
                        tabindex="0"
                    >
                        <livewire:departamento-manager />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
