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
    <div class="dashboard-shell p-0 m-0 w-100" >
        <div class="card-header border-0 p-1">
            
            <div class="card-header border-0 p-1">
                <ul class="nav nav-tabs dashboard-tabs border-0" id="dashboardTabs" role="tablist">

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-pais" data-bs-toggle="tab" data-bs-target="#pane-pais" type="button">
                            <i class="fa-solid fa-plus me-1"></i> {{ __('País') }}
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-departamento" data-bs-toggle="tab" data-bs-target="#pane-departamento" type="button">
                            <i class="fa-solid fa-plus me-1"></i> {{ __('Departamento') }}
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-provincia" data-bs-toggle="tab" data-bs-target="#pane-provincia" type="button">
                            <i class="fa-solid fa-plus me-1"></i> {{ __('Provincia') }}
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-municipio" data-bs-toggle="tab" data-bs-target="#pane-municipio" type="button">
                            <i class="fa-solid fa-plus me-1"></i> {{ __('Municipio') }}
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-cargo" data-bs-toggle="tab" data-bs-target="#pane-cargo" type="button">
                            <i class="fa-solid fa-plus me-1"></i> {{ __('Cargos') }}
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-role" data-bs-toggle="tab" data-bs-target="#pane-role" type="button">
                            <i class="fa-solid fa-plus me-1"></i> {{ __('Roles') }}
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-jerarquia" data-bs-toggle="tab" data-bs-target="#pane-jerarquia" type="button">
                            <i class="fa-solid fa-plus me-1"></i> {{ __('Jerarquías') }}
                        </button>
                    </li>

                </ul>
            </div>

            <div class="card-body p-2 p-md-3 m-0">
                <div class="tab-content" id="dashboardTabsContent">

                    <div class="tab-pane fade show active" id="pane-pais">
                        <livewire:pais-manager />
                    </div>

                    <div class="tab-pane fade" id="pane-departamento">
                        <livewire:departamento-manager />
                    </div>

                    <div class="tab-pane fade" id="pane-provincia">
                        <livewire:provincia-manager />
                    </div>

                    <div class="tab-pane fade" id="pane-municipio">
                        <livewire:municipio-manager />
                    </div>

                    <div class="tab-pane fade" id="pane-cargo">
                        <livewire:cargo-manager />
                    </div>

                    <div class="tab-pane fade" id="pane-role">
                        <livewire:role-manager />
                    </div>

                    <div class="tab-pane fade" id="pane-jerarquia">
                        <livewire:jerarquia-manager />
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection