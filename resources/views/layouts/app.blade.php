<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Chile') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container-fluid px-4 px-xl-5">

                <!-- LOGO -->
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img class="me-2" src="https://i.ibb.co/8g05j3mG/logo-asambleasdedios.png" width="40" />
                    <span class="text-danger fw-bold" style="font-size: 26px; text-shadow: 0 0 2px currentColor;">
                        CHILE
                    </span>
                </a>

                <!-- MENÚ PRINCIPAL -->
                <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
                    <ul class="navbar-nav">

                        <!-- Maestro -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Maestro</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="dash_admin.php">Home</a>
                                <a class="dropdown-item" href="coordinador.php">Coordinador</a>
                            </div>
                        </li>

                        <!-- Actividades -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Actividades</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="perfil_nacional.php">Perfil</a>
                                <a class="dropdown-item" href="dash_nacional.php">Dashboard</a>
                            </div>
                        </li>

                    </ul>
                </div>

                <!-- BOTÓN RESPONSIVE -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- DERECHA -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                        @else

                            <!-- ICONOS + USUARIO -->
                            <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">

                                <!-- THEME -->
                                <li class="nav-item ps-2 pe-0">
                                    <div class="dropdown theme-control-dropdown">
                                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                            <span class="fas fa-sun"></span>
                                       
                                        </a>
                                    </div>
                                </li>

                                <!-- GRID -->
                                <li class="nav-item dropdown px-1">
                                    <a class="nav-link" data-bs-toggle="dropdown">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                            <circle cx="2" cy="2" r="2" />
                                            <circle cx="2" cy="8" r="2" />
                                            <circle cx="2" cy="14" r="2" />
                                            <circle cx="8" cy="8" r="2" />
                                            <circle cx="8" cy="14" r="2" />
                                            <circle cx="14" cy="8" r="2" />
                                            <circle cx="14" cy="14" r="2" />
                                            <circle cx="8" cy="2" r="2" />
                                            <circle cx="14" cy="2" r="2" />
                                        </svg>
                                    </a>
                                </li>

                                <!-- USUARIO -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link pe-0 ps-2" data-bs-toggle="dropdown">
                                        <div class="avatar">
                                            <img class="rounded-circle avatar-img" src="assets/img/usuarios/nilsen.jpg">
                                        </div>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end py-0">
                                        <div class="bg-white rounded-2 py-2">

                                            <a class="dropdown-item fw-bold text-warning">
                                                <span class="fas fa-crown me-1"></span>Perfil
                                            </a>

                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item">Distrito</a>
                                            <a class="dropdown-item">Regiones</a>

                                            <div class="dropdown-divider"></div>

                                            <!-- SALIR -->
                                            <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                                Salir
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>

                                        </div>
                                    </div>
                                </li>

                            </ul>

                        @endguest

                    </ul>
                </div>

            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>

<style>
    .avatar {
        width: 35px;
        height: 35px;
    }

    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>