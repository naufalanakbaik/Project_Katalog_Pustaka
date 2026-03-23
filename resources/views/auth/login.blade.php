<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Pustaka Katalog</title>
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/logo-katalog_pustaka.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}?v={{ time() }}">
    @vite('resources/css/app.css')
</head>

<body>
    <div class="logo-header">
        <img src="img/katalog-pustaka2.png" alt="Logo Gabungan" />
    </div>
    <div class="login-container">
        <h1>Halaman Login</h1>
        <form action="{{ route('loginProses') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" name="email" required>
                <label>Email</label>
                @error('email')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <input type="password" name="password" id="password" required>
                <label>Password</label>

                <span class="toggle-password" onclick="togglePassword('password', 'toggleIcon')"
                    title="Tampilkan Password">
                    <img src="{{ asset('img/icon/eye-icon.png') }}" id="toggleIcon">
                </span>
            </div>

            <button type="submit">MASUK</button>
            <div class="signup_link">
                Belum punya akun? &raquo; <a href="{{ route('register') }}">Registrasi</a>
            </div>
        </form>
    </div>
    {{-- notifikasi --}}
    @include('sweetalert::alert')
</body>

<script>
    function togglePassword(inputId, eyeId) {
        const input = document.getElementById(inputId);
        const eyeIcon = document.getElementById(eyeId);

        if (!input || !eyeIcon) return;

        if (input.type === "password") {
            input.type = "text";
            eyeIcon.src = "{{ asset('img/icon/close-eye.png') }}";
        } else {
            input.type = "password";
            eyeIcon.src = "{{ asset('img/icon/eye-icon.png') }}";
        }
    }
</script>

</html>
