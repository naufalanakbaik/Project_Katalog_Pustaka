@include('admin.layout.header')
<title>Detail Peminjaman | Katalog Pustaka</title>

<div class="flex items-center justify-between mb-4">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2">Detail Peminjaman</h3>
    <a href="{{ route('admin.peminjaman.index') }}"
        class="button-kembali">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<div class="mb-6 bg-white shadow-sm rounded-md p-6 border border-gray-300">
    <h2 class="text-lg font-medium text-gray-900 mb-3">Informasi Peminjaman</h2>
    <p class="mb-2"><span class="font-normal text-gray-600">Tanggal Peminjaman :</span> {{ $peminjaman->tgl_peminjaman }}</p>
    <p class="mb-2"><span class="font-normal text-gray-600">Anggota :</span> {{ $peminjaman->anggota->nama_anggota }}</p>
    <p class="mb-2">
        <span class="font-normal text-gray-600">Status Pengembalian :</span>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
            {{ $peminjaman->status_pengembalian == 'Dipinjam' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
            {{ $peminjaman->status_pengembalian }}
        </span>
    </p>
</div>

<div class="overflow-x-auto bg-white border border-gray-300 shadow-sm rounded-md">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-100 border-b border-gray-300">
                <th class="px-4 py-2 font-semibold text-gray-800">No.</th>
                <th class="px-4 py-2 font-semibold text-gray-800">Judul Buku</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman->buku as $key => $buku)
                <tr class="hover:bg-gray-50 border-b">
                    <td class="px-4 py-2">{{ $key + 1 }}</td>
                    <td class="px-4 py-2">{{ $buku->judul }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if ($peminjaman->status_pengembalian == 'Dipinjam')
    <div class="my-6 bg-white shadow-sm rounded-md p-6 border border-gray-300">
        <h3 class="text-lg font-medium text-gray-800 mb-3">Pengembalian Buku</h3>
        <form action="{{ route('admin.peminjaman.update', $peminjaman->id) }}" method="post" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="tgl_kembali" class="block font-normal text-gray-700 mb-2">Tanggal Pengembalian</label>
                <input type="date" name="tgl_kembali" id="tgl_kembali" value="{{ date('Y-m-d') }}"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-1 focus:ring-red-400 focus:outline-none">
            </div>
            <button type="submit" onclick="return confirm('Yakin ingin mengubah status ini ?')"
                class="font-medium text-sm px-6 py-2 text-red-800 rounded-xl shadow border border-red-400 bg-red-100 hover:bg-red-200 hover:border-red-500
                transition duration-200">
                Proses Pengembalian
            </button>
        </form>
    </div>
@endif

@include('admin.layout.footer')
