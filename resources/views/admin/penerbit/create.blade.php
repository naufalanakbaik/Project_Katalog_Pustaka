@include('admin.layout.header')
<title>Tambah Penerbit | Pustaka Katalog</title>

<div class="flex items-center justify-between mb-6">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2">Tambah Penerbit</h3>
    <a href="{{ route('admin.penerbit.index') }}"
        class="button-kembali">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<div class="bg-white border border-gray-300 rounded-md shadow-sm w-full max-w-auto p-6">
    <form action="{{ route('admin.penerbit.store') }}" method="post" class="space-y-5">
        @csrf
        <div>
            <label for="nama_penerbit" class="block text-base font-semibold text-gray-800 mb-2">Nama Penerbit :</label>
            <input type="text" name="nama_penerbit" id="nama_penerbit" value="{{ old('nama_penerbit') }}"
                placeholder="Masukkan nama penerbit"
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none
                @error('nama_penerbit') border-red-500 @enderror">

            {{-- Notifikasi error --}}
            @error('nama_penerbit')
                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Submit --}}
        <div class="flex justify-end">
            <button type="submit"
                class="button-submit">
                Submit
            </button>
        </div>
    </form>
</div>


@include('admin.layout.footer')
