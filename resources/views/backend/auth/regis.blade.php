<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - EduRelawan</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('spark-admin/assets/images/favicon.ico') }}">

    <!-- Bootstrap dan Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('spark-admin/assets/libs/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('spark-admin/assets/libs/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- CSS Spark Admin -->
    <link rel="stylesheet" href="{{ asset('spark-admin/assets/css/main.css') }}">
</head>

<body>

    <!-- Authentication Container -->
    <div class="login-wrapper">

        <!-- Background Shapes -->
        <div class="login-bg-shape login-bg-shape-1"></div>
        <div class="login-bg-shape login-bg-shape-2"></div>

        <!-- Register Card -->
        <div class="login-card">

            <!-- Brand -->
            <a href="{{ route('regis') }}" class="login-brand text-decoration-none">

                <i class="bi bi-asterisk"></i>
                <span>EduRelawan</span>

            </a>

            <p class="login-subtitle">
                Bergabunglah dan jadilah bagian dari EduRelawan
            </p>

            <!-- Pesan Kesalahan -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Register Form -->
            <form action="{{ route('register.proses') }}" method="POST" id="registerForm">

                @csrf

                <!-- Nama Lengkap -->
                <div class="login-form-group">

                    <label for="name" class="login-form-label">
                        Nama Lengkap
                    </label>

                    <div class="login-input-group">

                        <i class="bi bi-person input-icon"></i>

                        <input type="text" id="name" name="name" class="login-input"
                            placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>

                    </div>
                </div>

                <!-- Email -->
                <div class="login-form-group">

                    <label for="email" class="login-form-label">
                        Alamat Email
                    </label>

                    <div class="login-input-group">

                        <i class="bi bi-envelope input-icon"></i>

                        <input type="email" id="email" name="email" class="login-input"
                            placeholder="nama@email.com" value="{{ old('email') }}" required>

                    </div>
                </div>

                <!-- Password -->
                <div class="login-form-group">

                    <label for="password" class="login-form-label">
                        Password
                    </label>

                    <div class="login-input-group">

                        <i class="bi bi-shield-lock input-icon"></i>

                        <input type="password" id="password" name="password" class="login-input"
                            placeholder="Minimal 8 karakter" required>

                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="login-form-group">

                    <label for="password_confirmation" class="login-form-label">
                        Konfirmasi Password
                    </label>

                    <div class="login-input-group">

                        <i class="bi bi-shield-check input-icon"></i>

                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="login-input" placeholder="Ulangi password" required>

                    </div>
                </div>

                <!-- Pilihan Peran -->
                <div class="login-form-group">

                    <label for="role" class="login-form-label">
                        Daftar Sebagai
                    </label>

                    <div class="login-input-group">

                        <i class="bi bi-people input-icon"></i>

                        <select id="role" name="role" class="login-input" required>
                            <option value="">Pilih Peran</option>

                            <option value="relawan" {{ old('role') == 'relawan' ? 'selected' : '' }}>
                                Relawan
                            </option>

                            <option value="mitra" {{ old('role') == 'mitra' ? 'selected' : '' }}>
                                Mitra
                            </option>
                        </select>

                    </div>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-login" id="btn-submit">

                    <span>Daftar Sekarang</span>
                    <i class="bi bi-arrow-right"></i>

                </button>

            </form>

            <!-- Link Login -->
            <p class="login-footer-text">

                Sudah memiliki akun?

                <a href="{{ route('login') }}">
                    Masuk di sini
                </a>

            </p>

        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('spark-admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
