@include('admin.layout.header')
<title>Buku | Pustaka Katalog</title>

<div class="mb-4">
    <h3 class="text-2xl font-medium text-gray-900">Daftar Buku</h3>
    <p class="mt-0.5 text-sm text-gray-500">
        Daftar buku yang tersedia di Katalog Pustaka.
    </p>
</div>

{{-- Form tambah dan pencarian --}}
<div class="mb-5 bg-white p-5 rounded-lg border border-gray-300 shadow-sm">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Tombol Tambah -->
        <a href="{{ route('admin.buku.create') }}"
            class="inline-flex items-center text-gray-800 text-base font-normal px-2 py-1 hover:text-blue-700 transition">
            <span class="material-icons text-white mr-2 px-1 py-1 border border-blue-700 bg-blue-700 rounded-full hover:bg-white hover:text-blue-600 transition">add</span>
            Tambah Buku
        </a>

        <!-- Form Pencarian -->
        <form action="{{ route('admin.buku.index') }}" method="get" class="flex items-center gap-2 w-full md:w-auto">
            <input type="text" name="cari" placeholder="Cari Buku, Pengarang, Tahun terbit ..."
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-64 shadow-sm">
            <button type="submit"
                class="inline-flex items-center bg-blue-700 hover:bg-blue-800 text-white font-medium px-2.5 py-2 rounded-xl shadow transition">
                <span class="material-icons text-base">search</span>
            </button>
        </form>
    </div>
</div>

<div class="overflow-x-auto border border-gray-300 rounded-md shadow-sm bg-white">
    <table class="w-full text-base">
        <thead class="bg-gray-50 text-sm text-gray-950 border-b border-gray-300">
            <tr>
                <th class="px-4 py-3 text-center font-medium">No.</th>
                <th class="px-5 py-3 text-left font-medium">Cover</th>
                <th class="px-5 py-3 text-left font-medium">Judul Buku</th>
                <th class="px-5 py-3 text-left font-medium">Pengarang</th>
                <th class="px-4 py-3 text-left font-medium">Tahun</th>
                <th class="px-5 py-3 text-left font-medium">Penerbit</th>
                <th class="px-4 py-3 text-left font-medium">Kategori</th>
                <th class="px-5 py-3 text-center font-medium">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-300">
            @foreach ($allBuku as $key => $r)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-center">{{ $key + $allBuku->firstItem() }}</td>
                    <td class="px-5 py-3 img-cell">
                        @if ($r->cover)
                            <img src="{{ asset('storage/' . $r->cover) }}" alt="Cover" width="80">
                        @endif
                    </td>
                    {{-- <td class="px-5 py-3">{{ $r->judul }}</td> --}}
                    <td class="px-2 py-3" x-data="{ open: false }">
                        <span @mouseenter="open = true" @mouseleave="open = false" class="cursor-pointer">
                            {{ \Illuminate\Support\Str::words($r->judul, 3, '...') }}
                        </span>
                        <div x-show="open" class="absolute bg-white border p-2 shadow-md text-sm rounded">
                            {{ $r->judul }}
                        </div>
                    </td>
                    <td class="px-5 py-3">{{ $r->pengarang }}</td>
                    <td class="px-4 py-3">{{ $r->tahun_terbit }}</td>
                    <td class="px-5 py-3">{{ $r->penerbit->nama_penerbit }}</td>
                    <td class="px-4 py-3">{{ $r->kategori->nama_kategori }}</td>
                    <td class="px-2 py-3 text-center" width="200">
                        <form action="{{ route('admin.buku.destroy', $r->id) }}" method="POST"
                            class="inline-flex gap-3 items-center justify-center">
                            <a href="{{ route('admin.buku.show', $r->id) }}" class="button-detail">
                                <img src="{{ asset('img/icon/detail-icon.png') }}" alt="Detail"
                                    class="w-[18px] h-[18px]">
                            </a>
                            <a href="{{ route('admin.buku.edit', $r->id) }}" class="button-edit">
                                <img src="{{ asset('img/icon/edit-icon.png') }}" alt="Edit"
                                    class="w-[18px] h-[18px]">
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus buku ini ?')"
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
    {{ $allBuku->links('vendor.pagination.tailwind-darkmode') }}
</div>

@include('admin.layout.footer')
