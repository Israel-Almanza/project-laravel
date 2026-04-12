<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
    body {
        background: #eef1f5;
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-card {
        width: 900px;
        display: flex;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .login-left {
        width: 50%;
        background: linear-gradient(135deg, #ff4b6e, #ff1e3c);
        color: white;
        padding: 40px;
        text-align: center;
    }

    .login-right {
        width: 50%;
        background: #f8f9fa;
        padding: 40px;
    }

    .form-control {
        background: #e9ecef;
        border: none;
    }

    .btn-login {
        background: #ff1e3c;
        color: white;
        width: 100%;
    }

    .extra-options {
        display: flex;
        justify-content: space-between;
    }
    </style>
</head>

<body>

<div class="login-container">
    <div class="login-card">

        <!-- IZQUIERDA -->
        <div class="login-left">
            <h2>AD</h2>

            <p>
                BIENAVENTURADO el varón que no anduvo en consejo de malos,
                Ni estuvo en camino de pecadores...
            </p>

            <p class="mt-5">Y todo lo que hace, prosperará.</p>
            <small>Salmos 1:1-3</small>
        </div>

        <!-- DERECHA -->
        <div class="login-right">
            <h3>Bienvenidos:</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required>

                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Contraseña</label>
                    <input type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required>

                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 extra-options">
                    <div>
                        <input type="checkbox" name="remember">
                        <label>Soy humano</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn btn-login">
                    Ingresar
                </button>

            </form>
        </div>

    </div>
</div>

</body>
</html>