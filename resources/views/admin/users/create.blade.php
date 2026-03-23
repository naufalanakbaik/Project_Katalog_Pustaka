@include('admin.layout.header')
<title>Tambah Akun | Pustaka Katalog</title>

<div class="flex items-center justify-between mb-3">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2">Tambah Akun</h3>
    <a href="{{ route('admin.users.index') }}" class="button-kembali">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<div class="bg-white border border-gray-300 rounded-md shadow-sm w-full max-w-auto p-6">
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        <div class="mb-3">
            <label class="block text-base font-semibold text-gray-800 mb-2">Nama</label>
            <input type="text" name="name" placeholder="Masukkan Nama lengkap"
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none"
                required>
        </div>
        <div class="mb-3">
            <label class="block text-base font-semibold text-gray-800 mb-2">Email</label>
            <input type="email" name="email" placeholder="Masukkan Email"
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none"
                required>
        </div>

        {{-- Role --}}
        <div class="mb-3">
            <label class="block text-base font-semibold text-gray-800 mb-2">
                Role
            </label>

            <select name="role"
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none"
                required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
                <option value="publisher">Publisher</option>
            </select>
        </div>

        <!-- Password -->
        <div class="mb-3 relative">
            <label class="block text-base font-semibold text-gray-800 mb-2">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan Password"
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none pr-10"
                required>
            <img src="{{ asset('img/icon/eye-icon.png') }}" id="eyePassword"
                class="w-6 h-6 absolute right-3 top-10 cursor-pointer opacity-70 hover:opacity-100"
                onclick="togglePassword('password', 'eyePassword')">
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-3 relative">
            <label class="block text-base font-semibold text-gray-800 mb-2">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                placeholder="Konfirmasi Ulang Password"
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none pr-10"
                required>
            <img src="{{ asset('img/icon/eye-icon.png') }}" id="eyeConfirm"
                class="w-6 h-6 absolute right-3 top-10 cursor-pointer opacity-70 hover:opacity-100"
                onclick="togglePassword('password_confirmation', 'eyeConfirm')">
        </div>

        {{-- button submit --}}
        <div class="flex justify-end">
            <button type="submit" class="button-submit">
                Submit
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
            eyeIcon.src = "{{ asset('img/icon/close-eye.png') }}"; // ganti ke icon mata tertutup
        } else {
            input.type = "password";
            eyeIcon.src = "{{ asset('img/icon/eye-icon.png') }}"; // kembali ke icon mata terbuka
        }
    }
</script>


@include('admin.layout.footer')
