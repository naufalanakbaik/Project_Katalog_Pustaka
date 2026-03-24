@include('admin.layout.header')
<title>Edit Kategori | Pustaka Katalog</title>

<div class="flex items-center justify-between mb-6">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2 dark:text-gray-200">Edit Kategori</h3>
    <a href="{{ route('admin.kategori.index') }}"
        class="inline-flex items-center py-1.5 px-2.5 text-blue-900 rounded-full bg-blue-100 hover:bg-blue-300 shadow-sm   dark:text-gray-100 dark:bg-gray-800 dark:hover:bg-gray-600 transition">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<div class="bg-white border border-gray-300 rounded-lg shadow-sm w-full max-w-auto p-6 dark:bg-gray-800 dark:border-gray-300">
    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="post" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Input Nama Kategori --}}
        <div>
            <label for="nama_kategori" class="block text-base font-medium text-gray-700 mb-2 dark:text-gray-300">
                Nama Kategori
            </label>
            <input type="text" name="nama_kategori" id="nama_kategori" value="{{ $kategori->nama_kategori }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800 dark:bg-gray-800 dark:border-gray-400 dark:text-gray-200">
        </div>

        {{-- Tombol Update --}}
        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center bg-blue-600 text-white px-5 py-2 rounded-lg
                hover:bg-blue-700 font-normal shadow-sm transition">
                Update
            </button>
        </div>
    </form>
</div>

@include('admin.layout.footer')
