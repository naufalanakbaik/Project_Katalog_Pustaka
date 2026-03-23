@include('admin.layout.header')
<title>Tambah Kategori | Katalog</title>

<div class="flex items-center justify-between mb-4">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2">Tambah Kategori</h3>
    <a href="{{ route('admin.kategori.index') }}"
        class="inline-flex items-center py-1.5 px-2.5 text-blue-900 rounded-full bg-blue-100 hover:bg-blue-300 shadow-sm transition">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<div class="bg-white border border-gray-300 rounded-lg shadow-sm w-full max-w-auto p-6">
    <form action="{{ route('admin.kategori.store') }}" method="post" class="space-y-5">
        @csrf

        {{-- Input Nama Kategori --}}
        <div>
            <label for="nama_kategori" class="block text-base font-semibold text-gray-800 mb-2">
                Nama Kategori :
            </label>
            <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}"
                placeholder="Masukkan nama kategori"
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none
                @error('nama_kategori') border-red-500 @enderror">

            {{-- Notifikasi error --}}
            @error('nama_kategori')
                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Submit --}}
        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center bg-blue-600 text-white px-5 py-2 rounded-lg
                hover:bg-blue-700 font-normal shadow-sm transition">
                Simpan
            </button>
        </div>
    </form>
</div>

@include('admin.layout.footer')
