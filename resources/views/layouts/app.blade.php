<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
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
            <div class="container-fluid px-4 px-xl-5 ">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img class="me-2" src="https://i.ibb.co/8g05j3mG/logo-asambleasdedios.png" alt="" width="40" />
                    <span class="font-sans-serif text-danger"
                        style="font-weight: 900; font-size: 26px; ;text-shadow: 0 0 2px currentColor;">
                        CHILE
                    </span>
                </a>
                <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
                    <ul class="navbar-nav" data-top-nav-dropdowns="data-top-nav-dropdowns">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" id="dashboards">Maestro</a>
                            <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0"
                                aria-labelledby="dashboards">
                                <div class="bg-white dark__bg-1000 rounded-3 py-2">
                                    <a class="dropdown-item link-600 fw-medium" href="dash_admin.php">Home</a>
                                    <a class="dropdown-item link-600 fw-medium" href="coordinador.php">Coordinador</a>
                                    <a class="dropdown-item link-600 fw-medium" href="">Soporte<span
                                            class="badge rounded-pill ms-2 badge-subtle-success">Info</span></a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" id="apps">Actividades</a>
                            <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0"
                                aria-labelledby="apps">
                                <div class="card navbar-card-app shadow-none dark__bg-1000">
                                    <div class="card-body scrollbar max-h-dropdown"><img class="img-dropdown"
                                            src="assets/img/icons/spot-ilustrations/corner-1.png" width="130" alt="" />
                                        <div class="row">
                                            <div class="col-6 col-md-4">
                                                <div class="nav flex-column">
                                                    <p class="nav-link text-700 mb-0 fw-bold">Nacional</p>
                                                    <a class="nav-link py-1 link-600 fw-medium"
                                                        href="perfil_nacional.php">Perfil</a>
                                                    <a class="nav-link py-1 link-600 fw-medium"
                                                        href="dash_nacional.php">Dashboard</a>
                                                    <a class="nav-link py-1 link-600 fw-medium"
                                                        href="agenda_cal-nal.php">Agenda</a>
                                                    <a class="nav-link py-1 link-600 fw-medium"
                                                        href="pastores.php">Pastores</a>
                                                    <a class="nav-link py-1 link-600 fw-medium"
                                                        href="dash_iglesias.php">Iglesias</a>
                                                    <p class="nav-link text-700 mb-0 fw-bold">Distrito</p>
                                                    <a class="nav-link py-1 link-600 fw-medium"
                                                        href="perfil_distrito.php">Perfil</a>
                                                    <a class="nav-link py-1 link-600 fw-medium"
                                                        href="dash_distrito.php">Dashboard</a>
                                                    <a class="nav-link py-1 link-600 fw-medium"
                                                        href="agenda_cal-dis.php">Agenda</a>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="nav flex-column">
                                                    <p class="nav-link text-700 mb-0 fw-bold">Sección/región</p>
                                                    <a class="nav-link py-1 link-600 fw-medium"
                                                        href="perfil_region.php">Perfil</a>
                                                    <a class="nav-link py-1 link-600 fw-medium"
                                                        href="dash_region.php">Dashboard</a>
                                                    <a class="nav-link py-1 link-600 fw-medium"
                                                        href="agenda_cal-reg.php">Agenda</a>
                                                    <p class="nav-link text-700 mb-0 fw-bold">Iglesia</p>
                                                    <a class="nav-link py-1 link-600 fw-medium"
                                                        href="perfil_iglesia.php">Perfil</a>
                                                    <a class="nav-link py-1 link-600 fw-medium"
                                                        href="dash_iglesia.php">Dashboard</a>
                                                    <a class="nav-link py-1 link-600 fw-medium"
                                                        href="agenda_cal-igl.php">Agenda</a>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <div class="nav flex-column">
                                                    <p class="nav-link text-700 mb-0 fw-bold">Otros</p>
                                                    <a class="nav-link py-1 link-600 fw-medium"
                                                        href="local-publico.php">Publico</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" id="documentations">Configuración</a>
                            <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0"
                                aria-labelledby="documentations">
                                <div class="bg-white dark__bg-1000 rounded-3 py-2">
                                    <a class="dropdown-item link-600 fw-medium" href="parametros.php">Parametros<span
                                            class="badge rounded-pill ms-2 badge-subtle-success">Admin</span></a>
                                    <a class="dropdown-item link-600 fw-medium" href="">Politicas</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                    role="button" data-bs-toggle="dropdown">

                                    <div class="user-avatar">
                                        <i class="fa-solid fa-user"></i>
                                    </div>

                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>
</body>

</html>
<style>
    .user-avatar {
        width: 35px;
        height: 35px;
        background-color: #e60023;
        /* rojo estilo CHILE */
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .user-avatar:hover {
        background-color: #c4001d;
    }
</style>