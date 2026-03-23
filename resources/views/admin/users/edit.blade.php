@include('admin.layout.header')
<title>Edit Akun | Pustaka Katalog</title>

<div class="flex items-center justify-between mb-3">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2">Edit Akun</h3>
    <a href="{{ route('admin.users.index') }}" class="button-kembali">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<div class="bg-white border border-gray-300 rounded-md shadow-sm w-full max-w-auto p-6">
    <form action="{{ route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data"
        class="space-y-5">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block text-base font-medium text-gray-700 mb-2">Nama :</label>
            <input type="text" name="name" value="{{ $user->name }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800"
                required>
        </div>

        <div class="mb-3">
            <label class="block text-base font-medium text-gray-700 mb-2">Email :</label>
            <input type="email" name="email" value="{{ $user->email }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800"
                required>
        </div>

        <div class="mb-3">
            <label class="block text-base font-semibold text-gray-800 mb-2">
                Role
            </label>

            <select name="role"
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none"
                required>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                    Admin
                </option>
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                    User
                </option>
                <option value="publisher" {{ $user->role === 'publisher' ? 'selected' : '' }}>
                    Publisher
                </option>
            </select>
        </div>

        <!-- Password -->
        <div class="mb-3 relative">
            <label class="block text-base font-medium text-gray-700 mb-2">Password (biarkan kosong jika tidak diubah)
                :</label>
            <input type="password" id="password" name="password"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800 pr-10">
            <img src="{{ asset('img/icon/eye-icon.png') }}" id="eyePassword"
                class="w-6 h-6 absolute right-3 top-10 cursor-pointer opacity-70 hover:opacity-100"
                onclick="togglePassword('password', 'eyePassword')">
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-3 relative" id="confirm-password-wrapper" style="display: none;">
            <label class="block text-base font-medium text-gray-700 mb-2">Konfirmasi Password :</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800 pr-10">
            <img src="{{ asset('img/icon/eye-icon.png') }}" id="eyeConfirm"
                class="w-6 h-6 absolute right-3 top-10 cursor-pointer opacity-70 hover:opacity-100"
                onclick="togglePassword('password_confirmation', 'eyeConfirm')">
        </div>

        {{-- Tombol Update --}}
        <div class="flex justify-end">
            <button type="submit" class="button-submit">
                Update
            </button>
        </div>
    </form>
</div>

<script>
    function togglePassword(inputId, eyeId) {
        const input = document.getElementById(inputId);
        const eyeIcon = document.getElementById(eyeId);

        if (input.type === "password") {
            input.type = "text";
            eyeIcon.src = "{{ asset('img/icon/close-eye.png') }}"; // mata tertutup
        } else {
            input.type = "password";
            eyeIcon.src = "{{ asset('img/icon/eye-icon.png') }}"; // mata terbuka
        }
    }

    // tampilkan konfirmasi password kalau user isi password
    const passwordInput = document.getElementById('password');
    const confirmWrapper = document.getElementById('confirm-password-wrapper');
    passwordInput.addEventListener('input', function() {
        confirmWrapper.style.display = this.value.length > 0 ? 'block' : 'none';
    });
</script>


@include('admin.layout.footer')
