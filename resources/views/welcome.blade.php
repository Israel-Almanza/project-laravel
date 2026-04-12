@extends('layouts.app')

@push('styles')
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
@endpush

@section('content')
    <div class="container dashboard-shell py-0">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-header bg-white border-0 p-1">
                <ul class="nav nav-tabs dashboard-tabs border-0" id="dashboardTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link active"
                            id="tab-pais"
                            data-bs-toggle="tab"
                            data-bs-target="#pane-pais"
                            type="button"
                            role="tab"
                            aria-controls="pane-pais"
                            aria-selected="true"
                        >
                            {{ __('País') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="tab-departamento"
                            data-bs-toggle="tab"
                            data-bs-target="#pane-departamento"
                            type="button"
                            role="tab"
                            aria-controls="pane-departamento"
                            aria-selected="false"
                        >
                            {{ __('Departamento') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="tab-provincia"
                            data-bs-toggle="tab"
                            data-bs-target="#pane-provincia"
                            type="button"
                            role="tab"
                            aria-controls="pane-provincia"
                            aria-selected="false"
                        >
                            {{ __('Provincia') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="tab-municipio"
                            data-bs-toggle="tab"
                            data-bs-target="#pane-municipio"
                            type="button"
                            role="tab"
                            aria-controls="pane-municipio"
                            aria-selected="false"
                        >
                            {{ __('Municipio') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="tab-cargo"
                            data-bs-toggle="tab"
                            data-bs-target="#pane-cargo"
                            type="button"
                            role="tab"
                            aria-controls="pane-cargo"
                            aria-selected="false"
                        >
                            {{ __('Cargos') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="tab-role"
                            data-bs-toggle="tab"
                            data-bs-target="#pane-role"
                            type="button"
                            role="tab"
                            aria-controls="pane-role"
                            aria-selected="false"
                        >
                            {{ __('Roles') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="tab-jerarquia"
                            data-bs-toggle="tab"
                            data-bs-target="#pane-jerarquia"
                            type="button"
                            role="tab"
                            aria-controls="pane-jerarquia"
                            aria-selected="false"
                        >
                            {{ __('Jerarquías') }}
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body bg-light p-3 p-md-4">
                <div class="tab-content" id="dashboardTabsContent">
                    <div
                        class="tab-pane fade show active"
                        id="pane-pais"
                        role="tabpanel"
                        aria-labelledby="tab-pais"
                        tabindex="0"
                    >
                        <livewire:pais-manager />
                    </div>
                    <div
                        class="tab-pane fade"
                        id="pane-departamento"
                        role="tabpanel"
                        aria-labelledby="tab-departamento"
                        tabindex="0"
                    >
                        <livewire:departamento-manager />
                    </div>
                    <div
                        class="tab-pane fade"
                        id="pane-provincia"
                        role="tabpanel"
                        aria-labelledby="tab-provincia"
                        tabindex="0"
                    >
                        <livewire:provincia-manager />
                    </div>
                    <div
                        class="tab-pane fade"
                        id="pane-municipio"
                        role="tabpanel"
                        aria-labelledby="tab-municipio"
                        tabindex="0"
                    >
                        <livewire:municipio-manager />
                    </div>
                    <div
                        class="tab-pane fade"
                        id="pane-cargo"
                        role="tabpanel"
                        aria-labelledby="tab-cargo"
                        tabindex="0"
                    >
                        <livewire:cargo-manager />
                    </div>
                    <div
                        class="tab-pane fade"
                        id="pane-role"
                        role="tabpanel"
                        aria-labelledby="tab-role"
                        tabindex="0"
                    >
                        <livewire:role-manager />
                    </div>
                    <div
                        class="tab-pane fade"
                        id="pane-jerarquia"
                        role="tabpanel"
                        aria-labelledby="tab-jerarquia"
                        tabindex="0"
                    >
                        <livewire:jerarquia-manager />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
