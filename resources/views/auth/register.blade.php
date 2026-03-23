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
        <h1>Registrasi Akun</h1>

        <form action="{{ route('registerProses') }}" method="post">
            @csrf

            <div class="form-group">
                <input type="text" name="name" required>
                <label>Nama Lengkap</label>
            </div>

            <div class="form-group">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>

            <div class="form-group">
                <input type="password" name="password" id="password" required>
                <label>Password</label>

                <span class="toggle-password" onclick="togglePassword('password', 'togglePasswordIcon')"
                    title="Tampilkan Password">
                    <img src="{{ asset('img/icon/eye-icon.png') }}" id="togglePasswordIcon">
                </span>
            </div>


            <div class="form-group">
                <input type="password" name="password_confirmation" id="password_confirmation" required>
                <label>Konfirmasi Password</label>

                <span class="toggle-password" onclick="togglePassword('password_confirmation', 'toggleConfirmIcon')"
                    title="Tampilkan Password">
                    <img src="{{ asset('img/icon/eye-icon.png') }}" id="toggleConfirmIcon">
                </span>
            </div>


            <button type="submit">DAFTAR</button>

            <div class="signup_link">
                Sudah punya akun? &raquo;
                <a href="{{ route('login') }}">Login disini</a>
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
