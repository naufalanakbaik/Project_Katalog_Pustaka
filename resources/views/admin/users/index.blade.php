@include('admin.layout.header')
<title>Akun | Pustaka Katalog</title>

<div class="mb-3">
    <h3 class="text-2xl font-semibold text-gray-900">Daftar Akun</h3>
    <p class="text-xs mt-0.5 text-gray-600">Kelola akun pengguna dalam sistem.</p>
</div>

{{-- Form tambah dan pencarian --}}
<div class="mb-5 bg-white p-5 rounded-lg border border-gray-300 shadow-sm">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        {{-- KIRI: Tombol Tambah --}}
        <div class="flex">
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center text-gray-800 text-base font-normal px-2 py-1 hover:text-blue-700 transition">
                <span
                    class="material-icons text-white mr-2 px-1 py-1 border border-blue-700 bg-blue-700 rounded-full hover:bg-white hover:text-blue-600 transition">add</span>
                Tambah Akun
            </a>
        </div>

        {{-- KANAN: Filter + Search --}}
        <form action="{{ route('admin.users.index') }}" method="get"
            class="flex flex-col md:flex-row items-stretch md:items-center gap-3">

            {{-- Filter Role --}}
            <div x-data="{
                open: false,
                selected: '{{ request('role') ? (request('role') === 'admin' ? 'Admin' : 'User') : 'Semua Role' }}'
            }" class="relative w-full md:w-56">
                <button type="button" @click="open = !open"
                    class="w-full flex justify-between items-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-700 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    <span x-text="selected"></span>
                    <svg class="h-4 w-4 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open }"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" x-cloak @click.away="open = false" x-transition
                    class="absolute z-10 mt-1 w-full rounded-md border border-gray-200 bg-white shadow-lg">
                    <ul class="py-1 text-gray-700">
                        <li @click="selected='Semua Role'; open=false; $refs.hiddenRole.value=''"
                            class="px-4 py-2 cursor-pointer hover:bg-gray-100">
                            Semua Role
                        </li>
                        <li @click="selected='Admin'; open=false; $refs.hiddenRole.value='admin'"
                            class="px-4 py-2 cursor-pointer hover:bg-gray-100">
                            Admin
                        </li>
                        <li @click="selected='User'; open=false; $refs.hiddenRole.value='user'"
                            class="px-4 py-2 cursor-pointer hover:bg-gray-100">
                            User
                        </li>
                    </ul>
                </div>
                {{-- Hidden input agar value tetap terkirim ke backend --}}
                <input type="hidden" name="role" x-ref="hiddenRole" value="{{ request('role') }}">
            </div>

            {{-- Search --}}
            <div class="flex w-full md:w-80">
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari Nama Akun..."
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-l-lg focus:outline-none shadow-sm">

                <button type="submit" class="px-3 bg-blue-700 hover:bg-blue-800 text-white rounded-r-lg shadow">
                    <span class="material-icons text-base mt-1.5">search</span>
                </button>
            </div>

        </form>
    </div>
</div>

{{-- Alert sukses --}}
@if (session('success'))
    <div class="mt-4 mb-4 bg-green-100 text-green-700 px-4 py-2 rounded-lg">
        {{ session('success') }}
    </div>
@endif

{{-- Table data --}}
<div class="overflow-x-auto border border-blue-300 rounded-md shadow-sm bg-white">
    <table class="w-full text-base">
        <thead class="bg-blue-100 text-sm text-gray-900 border-b border-blue-300 tracking-wide">
            <tr>
                <th class="px-2 py-3 text-center font-medium">No.</th>
                <th class="px-2 py-3 text-left font-medium">Nama</th>
                <th class="px-2 py-3 text-left font-medium">Email</th>
                <th class="px-2 py-3 text-left font-medium">Role</th>
                <th class="px-2 py-3 text-left font-medium">Tanggal Dibuat</th>
                <th class="px-2 py-3 text-center font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-300">
            @foreach ($allUsers as $key => $r)
                <tr class="hover:bg-gray-50">
                    <td class="px-2 py-3 text-center">{{ $key + $allUsers->firstItem() }}</td>
                    <td class="px-2 py-3">{{ $r->name }}</td>
                    <td class="px-2 py-3">{{ $r->email }}</td>
                    <td class="px-2 py-3">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $r->role === 'admin' ? 'bg-green-100 text-green-800' : ($r->role === 'user' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700') }}">
                            {{ ucfirst($r->role) }}
                        </span>
                    </td>
                    <td class="px-2 py-3">{{ $r->created_at->format('d M Y') }}</td>
                    <td class="px-2 py-3 text-center">
                        <form action="{{ route('admin.users.destroy', $r->id) }}" method="POST"
                            class="inline-flex gap-3 items-center justify-center">
                            <a href="{{ route('admin.users.show', $r->id) }}" class="button-detail">
                                <img src="{{ asset('img/icon/detail-icon.png') }}" alt="Detail"
                                    class="w-[18px] h-[18px]">
                            </a>
                            <a href="{{ route('admin.users.edit', $r->id) }}" class="button-edit">
                                <img src="{{ asset('img/icon/edit-icon.png') }}" alt="Edit"
                                    class="w-[18px] h-[18px]">
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus akun ini ?')"
                                class="button-delete">
                                <img src="{{ asset('img/icon/delete-icon.png') }}" alt="Hapus"
                                    class="w-[18px] h-[18px]">
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- pagination --}}
<div class="mt-3">
    {{ $allUsers->links('vendor.pagination.tailwind') }}
</div>

@include('admin.layout.footer')
