@include('admin.layout.header')
<title>Detail Penerbit | Pustaka Katalog</title>

<div class="flex items-center justify-between mb-4">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2">Detail Penerbit</h3>
    <a href="{{ route('admin.penerbit.index') }}"
        class="button-kembali">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<div class="bg-white border border-gray-300 rounded-md shadow-sm w-full max-w-auto">
    <div class="px-6 py-4 border-b border-gray-300 bg-gray-50 rounded-t-md">
        <h3 class="font-semibold  text-gray-800">Informasi Penerbit</h3>
    </div>
    <div class="px-6 py-5">
        <dl class="divide-y divide-gray-200">
            <div class="flex py-3 text-gray-700">
                <dt class="w-48 font-medium">Nama Penerbit</dt>
                <dd class="flex-1 text-gray-700">{{ $penerbit->nama_penerbit }}</dd>
            </div>
        </dl>
    </div>
</div>

@include('admin.layout.footer')
