@include('admin.layout.header')
<title>Detail Kategori | Pustaka Katalog</title>

<div class="flex items-center justify-between mb-4">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2 dark:text-gray-200">Detail Kategori</h3>
    <a href="{{ route('admin.kategori.index') }}"
        class="inline-flex items-center py-1.5 px-2.5 text-blue-900 rounded-full bg-blue-100 hover:bg-blue-300 shadow-sm   dark:text-gray-100 dark:bg-gray-800 dark:hover:bg-gray-600 transition">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<div class="bg-white border border-gray-300 rounded-lg shadow-sm w-full max-w-auto dark:bg-gray-800 dark:border-gray-300">
    <div class="px-6 py-4 border-b border-gray-300 rounded-t-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-300">
        <h3 class="font-semibold text-gray-800 dark:text-gray-200">Informasi Kategori</h3>
    </div>
    <div class="px-6 py-5">
        <dl class="divide-y divide-gray-200 dark:divide-gray-600">
            <div class="flex py-3 text-gray-700 dark:text-gray-300">
                <dt class="w-48 font-medium">Nama Kategori</dt>
                <dd class="flex-1">{{ $kategori->nama_kategori }}</dd>
            </div>
        </dl>
    </div>
</div>

@include('admin.layout.footer')
