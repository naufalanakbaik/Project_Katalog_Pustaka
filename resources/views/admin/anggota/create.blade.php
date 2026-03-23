@include('admin.layout.header')

<title>Tambah Anggota | Pustaka Katalog</title>

<div class="flex items-center justify-between mb-3">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2">Tambah Anggota Pustaka</h3>
    <a href="{{ route('admin.anggota.index') }}"
        class="button-kembali">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<div class="bg-white border border-gray-300 rounded-md shadow-sm w-full max-w-auto p-6">
    {{-- Form untuk menambahkan anggota baru --}}
    <form action="{{ route('admin.anggota.store') }}" method="post" class="space-y-5">
        @csrf
        <div class="mb-3">
            <label for="" class="block text-base font-semibold text-gray-800 mb-2">Nama Anggota :</label>
            <input type="text" name="nama_anggota" id="" placeholder="Masukkan Nama Anggota"
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="mb-3">
            <label for="" class="block text-base font-semibold text-gray-800 mb-2">Alamat :</label>
            <input type="text" name="alamat" placeholder="Masukkan Alamat Anggota" class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="mb-3">
            <label for="" class="block text-base font-semibold text-gray-800 mb-2">Nomor Telpon :</label>
            <input type="text" name="no_telpon" placeholder="Masukkan No Telpon" class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">
        </div>
        
        {{-- button submit --}}
        <div class="flex justify-end">
            <button type="submit"
                class="button-submit">
                Submit
            </button>
        </div>
    </form>
</div>

@include('admin.layout.footer')
