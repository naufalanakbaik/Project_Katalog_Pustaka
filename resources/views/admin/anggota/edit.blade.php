@include('admin.layout.header')
<title>Edit Anggota | Pustaka Katalog</title>

<div class="flex items-center justify-between mb-3">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2">Edit Anggota Pustaka</h3>
    <a href="{{ route('admin.anggota.index') }}"
        class="button-kembali">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<div class="bg-white border border-gray-300 rounded-md shadow-sm w-full max-w-auto p-6">
    {{-- Form untuk mengedit anggota --}}
    <form action="{{ route('admin.anggota.update', $anggota->id) }}" method="post" class="space-y-5">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="" class="block text-base font-medium text-gray-700 mb-2">Nama Anggota :</label>
            <input type="text" name="nama_anggota" id="" value="{{ $anggota->nama_anggota }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">
        </div>
        <div class="mb-4">
            <label for="" class="block text-base font-medium text-gray-700 mb-2">Alamat Anggota :</label>
            <input type="text" name="alamat" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800" value="{{ $anggota->alamat }}">
        </div>
        <div class="mb-4">
            <label for="" class="block text-base font-medium text-gray-700 mb-2">Nomor Telpon :</label>
            <input type="text" name="no_telpon" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800" value="{{ $anggota->no_telpon }}">
        </div>

        {{-- Tombol Update --}}
        <div class="flex justify-end">
            <button type="submit"
                class="button-submit">
                Update
            </button>
    </form>
</div>

@include('admin.layout.footer')
