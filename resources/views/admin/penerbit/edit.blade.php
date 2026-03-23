@include('admin.layout.header')
<title>Edit Penerbit | Pustaka Katalog</title>

<div class="flex items-center justify-between mb-6">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2">Edit penerbit</h3>
    <a href="{{ route('admin.penerbit.index') }}"
        class="button-kembali">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<div class="bg-white border border-gray-300 rounded-md shadow-sm w-full max-w-auto p-6">
    <form action="{{ route('admin.penerbit.update', $penerbit->id) }}" method="post" class="space-y-5">
        @csrf
        @method('PUT')
        <div>
            <label for="nama_penerbit" class="block text-base font-medium text-gray-700 mb-2">Nama Penerbit :</label>
            <input type="text" name="nama_penerbit" id="nama_penerbit" value="{{ $penerbit->nama_penerbit }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">
        </div>
        <div class="flex justify-end">
            <button type="submit"
                class="button-submit">
                Update
            </button>
        </div>
    </form>
</div>

@include('admin.layout.footer')
