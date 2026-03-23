@include('admin.layout.header')
<title>Detail Buku | Pustaka Katalog</title>
<div class="bg-white  p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-2xl font-semibold text-gray-900 ml-2">Detail Buku</h3>
        <a href="{{ route('admin.buku.index') }}"
            class="button-kembali">
            <span class="material-icons !text-xl">east</span>
        </a>
    </div>

    <!-- Cover Buku -->
    @if ($buku->cover)
        <div class="flex justify-center mb-6">
            <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover Buku" class="w-40 h-auto">
        </div>
    @endif

    <!-- Detail Table -->
    <div class="overflow-hidden rounded-lg border border-gray-300">
        <table class="w-full text-sm text-left text-gray-700">
            <tbody class="divide-y divide-gray-300">
                <tr>
                    <td class="px-4 py-3 font-medium w-40">Judul Buku</td>
                    <td class="px-2 py-3">:</td>
                    <td class="px-4 py-3">{{ $buku->judul }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-3 font-medium">Pengarang</td>
                    <td class="px-2 py-3">:</td>
                    <td class="px-4 py-3">{{ $buku->pengarang }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-3 font-medium">Tahun Terbit</td>
                    <td class="px-2 py-3">:</td>
                    <td class="px-4 py-3">{{ $buku->tahun_terbit }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-3 font-medium">Penerbit</td>
                    <td class="px-2 py-3">:</td>
                    <td class="px-4 py-3">{{ $buku->penerbit->nama_penerbit }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-3 font-medium">Kategori</td>
                    <td class="px-2 py-3">:</td>
                    <td class="px-4 py-3">{{ $buku->kategori->nama_kategori }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-3 font-medium">Deskripsi/ Sinopsis</td>
                    <td class="px-2 py-3">:</td>
                    <td class="px-4 py-3">{{ $buku->deskripsi }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@include('admin.layout.footer')
