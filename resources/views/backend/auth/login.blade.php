
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - EduRelawan</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png"
        href="{{ asset('spark-admin/assets/images/favicon.ico') }}">

    <!-- Bootstrap dan Bootstrap Icons -->
    <link rel="stylesheet"
        href="{{ asset('spark-admin/assets/libs/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('spark-admin/assets/libs/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- CSS Spark Admin -->
    <link rel="stylesheet"
        href="{{ asset('spark-admin/assets/css/main.css') }}">
</head>
<body>

    <!-- Authentication Container -->
    <div class="login-wrapper">

        <!-- Background Shapes -->
        <div class="login-bg-shape login-bg-shape-1"></div>
        <div class="login-bg-shape login-bg-shape-2"></div>

        <!-- Login Card -->
        <div class="login-card">

            <!-- Brand -->
            <a href="{{ route('login') }}"
                class="login-brand text-decoration-none">

                <i class="bi bi-asterisk"></i>
                <span>EduRelawan</span>

            </a>

            <p class="login-subtitle">
                Masuk untuk mengakses akun EduRelawan
            </p>

            <!-- Pesan Kesalahan -->
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.proses') }}"
                method="POST"
                id="loginForm">

                @csrf

                <!-- Email -->
                <div class="login-form-group">

                    <label for="email" class="login-form-label">
                        Alamat Email
                    </label>

                    <div class="login-input-group">

                        <i class="bi bi-envelope input-icon"></i>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="login-input"
                            placeholder="nama@email.com"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >

                    </div>
                </div>

                <!-- Password -->
                <div class="login-form-group">

                    <label for="password" class="login-form-label">
                        Password
                    </label>

                    <div class="login-input-group">

                        <i class="bi bi-shield-lock input-icon"></i>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="login-input login-input-password"
                            placeholder="Masukkan password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle-btn"
                            id="toggle-password"
                            aria-label="Tampilkan password">

                            <i class="bi bi-eye"></i>

                        </button>

                    </div>
                </div>

                <!-- Remember Me -->
                <div class="login-options">

                    <label class="custom-control-label">

                        <input
                            type="checkbox"
                            class="custom-checkbox-input"
                            id="rememberMe"
                            name="remember"
                            value="1"
                        >

                        <span>Ingat Saya</span>

                    </label>

                </div>

                <!-- Tombol Login -->
                <button type="submit"
                    class="btn-login"
                    id="btn-submit">

                    <span>Masuk ke EduRelawan</span>
                    <i class="bi bi-arrow-right"></i>

                </button>

            </form>

            <!-- Link Registrasi -->
            <p class="login-footer-text">

                Belum memiliki akun?

                <a href="{{ route('regis') }}" id="link-register">
                    Daftar Sekarang
                </a>

            </p>

        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('spark-admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('spark-admin/assets/js/auth.js') }}"></script>

</body>
</html>
