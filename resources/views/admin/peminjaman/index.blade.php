@include('admin.layout.header')
<title>Peminjaman | Pustaka Katalog</title>

<div class="mb-4">
    <h3 class="text-2xl font-medium text-gray-900">Peminjaman Buku</h3>
    <p class="text-xs mt-0.5 text-gray-600">Daftar peminjaman buku yang sedang diproses.</p>
</div>

{{-- Form tambah dan pencarian --}}
<div class="mb-5 bg-white p-5 rounded-lg border border-gray-300 shadow-sm">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Tombol Tambah -->
        <a href="{{ route('admin.peminjaman.create') }}"
            class="inline-flex items-center text-gray-800 text-base font-normal px-2 py-1 hover:text-blue-700 transition">
            <span class="material-icons text-white mr-2 px-1 py-1 border border-blue-700 bg-blue-700 rounded-full hover:bg-white hover:text-blue-600 transition">add</span>
            Tambah Peminjaman
        </a>

        <!-- Form Pencarian -->
        <form action="{{ route('admin.peminjaman.index') }}" method="get" class="flex items-center gap-2 w-full md:w-auto">
            <input type="text" name="cari" placeholder="Cari Nama Peminjaman ..."
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-64 shadow-sm">
            <button type="submit"
                class="inline-flex items-center bg-blue-700 hover:bg-blue-800 text-white font-medium px-2.5 py-2 rounded-xl shadow transition">
                <span class="material-icons text-base">search</span>
            </button>
        </form>
    </div>
</div>


{{-- Table data --}}
<div class="overflow-x-auto border border-rose-300 rounded-md shadow-sm bg-white">
    <table class="w-full text-base">
        <thead class="bg-rose-50 text-sm text-gray-900 border-b border-rose-300">
            <tr>
                <th class="px-2 py-3 text-center font-medium">No.</th>
                <th class="px-5 py-3 text-left font-medium">Tanggal</th>
                <th class="px-5 py-3 text-left font-medium">Nama Anggota</th>
                <th class="px-5 py-3 text-left font-medium">Status Pengembalian</th>
                <th class="px-2 py-3 text-center font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-300">
            @foreach ($allPeminjaman as $key => $r)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3 text-center">{{ $key + $allPeminjaman->firstItem() }}</td>
                    <td class="px-5 py-3">{{ $r->tgl_peminjaman }}</td>
                    <td class="px-5 py-3">{{ $r->anggota->nama_anggota }}</td>
                    {{-- <td class="px-5 py-3">{{ $r->status_pengembalian }}</td> --}}
                    <td class="px-5 py-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                        @if ($r->status_pengembalian == 'Dikembalikan')
                            bg-green-100 text-green-700
                        @elseif($r->status_pengembalian == 'Dipinjam')
                            bg-yellow-100 text-yellow-700
                        @else
                            bg-gray-100 text-gray-700 @endif ">
                            {{ $r->status_pengembalian }}
                        </span>
                    </td>
                    <td class="px-5 py-3 text-center" width="150">
                        <form action="{{ route('admin.peminjaman.destroy', $r->id) }}" method="POST"
                            class="inline-flex gap-4 items-center justify-center">
                            <a href="{{ route('admin.peminjaman.show', $r->id) }}" class="button-detail">
                                <img src="{{ asset('img/icon/detail-icon.png') }}" alt="Detail"
                                    class="w-[18px] h-[18px]">
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm ('Yakin ingin mengahapus peminjaman ini ?')"
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
    {{ $allPeminjaman->links('vendor.pagination.tailwind-darkmode') }}
</div>
@include('admin.layout.footer')
