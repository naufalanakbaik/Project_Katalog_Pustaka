@include('admin.layout.header')
<title>Detail Akun | Pustaka Katalog</title>

<div class="flex items-center justify-between mb-3">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2">Detail Akun</h3>
    <a href="{{ route('admin.users.index') }}" class="button-kembali">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<div class="bg-white border border-gray-300 rounded-md shadow-sm w-full max-w-auto">
    <div class="px-6 py-4 border-b border-gray-300 bg-gray-50 rounded-t-md">
        <h3 class="font-semibold text-gray-800">Informasi Akun</h3>
    </div>
    <div class="px-6 py-5">
        <dl class="divide-y divide-gray-200">
            <div class="flex py-3 text-gray-700">
                <dt class="w-48 font-medium">Nama Akun</dt>
                <dd class="flex-1">{{ $user->name }}</dd>
            </div>
            <div class="flex py-3 text-gray-700">
                <dt class="w-48 font-medium">Email</dt>
                <dd class="flex-1">{{ $user->email }}</dd>
            </div>
            <div class="flex py-3 text-gray-700">
                <dt class="w-48 font-medium">Role</dt>
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $user->role === 'admin' ? 'bg-green-100 text-green-800' : ($user->role === 'user' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700') }}">
                    {{ ucfirst($user->role) }}
                </span>
            </div>
        </dl>
    </div>
</div>

@include('admin.layout.footer')
