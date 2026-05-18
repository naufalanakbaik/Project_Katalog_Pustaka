@include('admin.layout.header')
<title>Anggota | Pustaka Katalog</title>

<div class="mb-4">
    <h3 class="text-2xl font-semibold text-gray-900">Daftar Anggota Pustaka</h3>
    <p class="text-sm text-gray-500 mt-0.5">
        Daftar anggota yang terdaftar di pustaka katalog, termasuk informasi nama, alamat, nomor telepon, dan tanggal
        pendaftaran untuk memudahkan pengelolaan data anggota.
    </p>
</div>

{{-- Form tambah dan pencarian --}}
<div class="mb-5 bg-white p-5 rounded-lg border border-gray-300 shadow-sm">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Tombol Tambah -->
        <a href="{{ route('admin.anggota.create') }}"
            class="inline-flex items-center text-gray-800 text-base font-normal px-2 py-1 hover:text-blue-700 transition">
            <span
                class="material-icons text-white mr-2 px-1 py-1 border border-blue-700 bg-blue-700 rounded-full hover:bg-white hover:text-blue-600 transition">add</span>
            Tambah Anggota
        </a>

        <!-- Form Pencarian -->
        <form action="{{ route('admin.anggota.index') }}" method="get" class="flex items-center gap-2 w-full md:w-auto">
            <input type="text" name="cari" placeholder="Cari Nama Anggota ..."
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-64 shadow-sm">
            <button type="submit"
                class="inline-flex items-center bg-blue-700 hover:bg-blue-800 text-white font-medium px-2.5 py-2 rounded-xl shadow transition">
                <span class="material-icons text-base">search</span>
            </button>
        </form>
    </div>
</div>

{{-- Table data --}}
<div class="overflow-x-auto border border-blue-300 rounded-md shadow-sm bg-white">
    <table class="w-full text-base">
        <thead class="bg-blue-50 text-sm text-gray-900 border-b border-blue-300">
            <tr>
                <th class="px-3 py-3 text-center font-medium">No.</th>
                <th class="px-4 py-3 text-left font-medium">Nama</th>
                <th class="px-2 py-3 text-left font-medium">Alamat</th>
                <th class="px-2 py-3 text-left font-medium">No. Telpon</th>
                {{-- <th class="px-2 py-3 text-left font-medium">Tgl Dibuat</th> --}}
                <th class="px-2 py-3 text-center font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-300">
            @foreach ($allAnggota as $key => $r)
                <tr class="hover:bg-gray-50">
                    <td class="px-3 py-3 text-center">{{ $key + $allAnggota->firstItem() }}</td>
                    <td class="px-4 py-3">{{ $r->nama_anggota }}</td>
                    {{-- <td class="px-2 py-3" width="250">{{ $r->alamat }}</td> --}}
                    <td class="px-2 py-3" x-data="{ open: false }">
                        <span @mouseenter="open = true" @mouseleave="open = false" class="cursor-pointer">
                            {{ \Illuminate\Support\Str::words($r->alamat, 6, '...') }}
                        </span>
                        <div x-show="open" class="absolute bg-white border p-2 shadow-md text-sm rounded-md">
                            {{ $r->alamat }}
                        </div>
                    </td>
                    <td class="px-2 py-3" width="150">{{ $r->no_telpon }}</td>
                    {{-- <td class="px-2 py-3">{{ $r->created_at->format('d M Y') }}</td> --}}
                    <td class="px-2 py-3 text-center" width="180">
                        {{-- Button Action --}}
                        <form action="{{ route('admin.anggota.destroy', $r->id) }}" method="POST"
                            class="inline-flex gap-3 items-center justify-center">

                            {{-- Button Detail --}}
                            <a href="{{ route('admin.anggota.show', $r->id) }}"class="button-detail">
                                <img src="{{ asset('img/icon/detail-icon.png') }}" alt="Detail"
                                    class="w-[18px] h-[18px]">
                            </a>

                            {{-- Button Edit --}}
                            <a href="{{ route('admin.anggota.edit', $r->id) }}" class="button-edit">
                                <img src="{{ asset('img/icon/edit-icon.png') }}" alt="Edit"
                                    class="w-[18px] h-[18px]">
                            </a>

                            {{-- Button Delete --}}
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus anggota ini ?')"
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

<div class="mt-3">
    {{ $allAnggota->links('vendor.pagination.tailwind-darkmode') }}
</div>

@include('admin.layout.footer')
