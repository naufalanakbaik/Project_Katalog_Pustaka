@extends('katalog.head-footer')

@section('title', 'Edit Profile')

@section('content')
    <div class="max-w-6xl mx-auto mt-8 px-4 mb-10">

        <h2 class="text-2xl font-semibold text-gray-800 mb-6">
            Informasi Profile
            <span></span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- GRID 1: FORM --}}
            <div class="md:col-span-2 bg-white rounded-xl shadow-lg border border-gray-200 p-9">

                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b border-blue-300 pb-2">
                    Informasi Akun
                </h3>

                {{-- Alert sukses --}}
                @if (session('success'))
                    <div class="mt-6 bg-green-100 text-green-700 px-4 py-2 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" id="profileForm" class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div>
                        <label class="block text-sm font-normal text-gray-700 mb-1.5">
                            Nama Lengkap
                        </label>
                        <input type="text" name="name" id="name" value="{{ auth()->user()->name }}"
                            class="form-input" required>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-normal text-gray-700 mb-1.5">
                            Email
                        </label>
                        <input type="email" name="email" id="email" value="{{ auth()->user()->email }}"
                            class="form-input" required>
                    </div>


                    {{-- Password --}}
                    <div class="relative">
                        <label class="block text-sm font-normal text-gray-700 mb-1.5">
                            Password Baru <span class="text-gray-400">(opsional)</span>
                        </label>

                        <input type="password" name="password" id="password" class="form-input"
                            placeholder="Kosongkan jika tidak ingin mengubah">

                        <img src="{{ asset('img/icon/eye-icon.png') }}" id="eyePassword"
                            class="w-5 h-5 absolute right-4 top-9 cursor-pointer hidden"
                            onclick="togglePassword('password','eyePassword')" alt="Toggle Password">
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div id="passwordConfirmWrapper" class="relative hidden">
                        <label class="block text-sm font-normal text-gray-700 mb-1.5">
                            Konfirmasi Password
                        </label>

                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-input">

                        <img src="{{ asset('img/icon/eye-icon.png') }}" id="eyeConfirm"
                            class="w-5 h-5 absolute right-4 top-9 cursor-pointer"
                            onclick="togglePassword('password_confirmation','eyeConfirm')" alt="Toggle Password">
                    </div>


                    {{-- Tombol --}}
                    <div id="actionButtons" class="hidden justify-end gap-3 pt-4">
                        <a href="{{ url()->previous() }}"
                            class="px-5 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                            Batal
                        </a>

                        <button type="submit" class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>

            {{-- GRID 2: INFORMASI --}}
            <div class="bg-blue-50 border border-blue-300 rounded-xl p-9 h-fit">

                <h3 class="text-lg font-semibold text-blue-800 mb-4">
                    Informasi Perubahan Data
                </h3>

                <ul class="space-y-3 text-sm text-blue-900">
                    <li class="flex items-start gap-2">
                        <span class="material-icons text-blue-600 text-base">info</span>
                        <span>
                            Nama dan email akan digunakan sebagai identitas akun Anda.
                        </span>
                    </li>

                    <li class="flex items-start gap-2">
                        <span class="material-icons text-blue-600 text-base">lock</span>
                        <span>
                            Password bersifat opsional. Kosongkan jika tidak ingin mengubah password.
                        </span>
                    </li>

                    <li class="flex items-start gap-2">
                        <span class="material-icons text-blue-600 text-base">security</span>
                        <span>
                            Demi keamanan, gunakan password yang kuat dan mudah Anda ingat.
                        </span>
                    </li>

                    <li class="flex items-start gap-2">
                        <span class="material-icons text-blue-600 text-base">verified_user</span>
                        <span>
                            Perubahan data akan langsung berlaku setelah disimpan.
                        </span>
                    </li>
                </ul>

            </div>

        </div>
    </div>

    <script>
        /*
                |--------------------------------------------------------------------------
                | ELEMENT REFERENCES
                |--------------------------------------------------------------------------
                */
        const form = document.getElementById('profileForm');

        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');

        const passwordInput = document.getElementById('password');
        const confirmWrapper = document.getElementById('passwordConfirmWrapper');

        const eyePassword = document.getElementById('eyePassword');
        const actionButtons = document.getElementById('actionButtons');

        /*
        |--------------------------------------------------------------------------
        | INITIAL DATA (UNTUK DETEKSI PERUBAHAN)
        |--------------------------------------------------------------------------
        */
        const initialData = {
            name: nameInput.value,
            email: emailInput.value
        };

        /*
        |--------------------------------------------------------------------------
        | EVENT LISTENER UTAMA
        | - Dipanggil setiap user mengubah input form
        |--------------------------------------------------------------------------
        */
        form.addEventListener('input', () => {
            handlePasswordUI();
            detectChanges();
        });

        /*
        |--------------------------------------------------------------------------
        | HANDLE PASSWORD UI
        | - Munculkan konfirmasi password & eye icon
        |   hanya jika password diisi
        |--------------------------------------------------------------------------
        */
        function handlePasswordUI() {
            const hasPassword = passwordInput.value.trim() !== '';

            confirmWrapper.classList.toggle('hidden', !hasPassword);
            eyePassword.classList.toggle('hidden', !hasPassword);
        }

        /*
        |--------------------------------------------------------------------------
        | DETEKSI PERUBAHAN DATA FORM
        | - Jika ada perubahan → tampilkan tombol aksi
        |--------------------------------------------------------------------------
        */
        function detectChanges() {
            const isChanged =
                nameInput.value !== initialData.name ||
                emailInput.value !== initialData.email ||
                passwordInput.value !== '';

            actionButtons.classList.toggle('hidden', !isChanged);
            actionButtons.classList.toggle('flex', isChanged);
        }

        /*
        |--------------------------------------------------------------------------
        | TOGGLE VISIBILITY PASSWORD
        | - Mengganti type input + icon mata
        |--------------------------------------------------------------------------
        */
        function togglePassword(inputId, eyeId) {
            const input = document.getElementById(inputId);
            const eye = document.getElementById(eyeId);

            if (input.type === 'password') {
                input.type = 'text';
                eye.src = "{{ asset('img/icon/close-eye.png') }}";
            } else {
                input.type = 'password';
                eye.src = "{{ asset('img/icon/eye-icon.png') }}";
            }
        }
    </script>

    <style>
        .form-input {
            width: 100%;
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            outline: none;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }
    </style>

@endsection
