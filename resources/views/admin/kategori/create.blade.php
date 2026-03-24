@include('admin.layout.header')
<title>Tambah Kategori | Katalog</title>

<div class="flex items-center justify-between mb-4">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2 dark:text-gray-200">Tambah Kategori</h3>
    <a href="{{ route('admin.kategori.index') }}"
        class="inline-flex items-center py-1.5 px-2.5 text-blue-900 rounded-full bg-blue-100 hover:bg-blue-300 shadow-sm   dark:text-gray-100 dark:bg-gray-800 dark:hover:bg-gray-600 transition">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<div class="bg-white border border-gray-300 rounded-lg shadow-sm w-full max-w-auto p-6 dark:bg-gray-800 dark:border-gray-300">
    <form action="{{ route('admin.kategori.store') }}" method="post" class="space-y-5">
        @csrf

        {{-- Input Nama Kategori --}}
        <div>
            <label for="nama_kategori" class="block text-base font-semibold text-gray-800 mb-2 dark:text-gray-200">
                Nama Kategori :
            </label>
            <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}"
                placeholder="Masukkan nama kategori"
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none dark:bg-gray-800 dark:border-gray-400 dark:text-gray-200">
                
                @error('nama_kategori')@enderror

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
