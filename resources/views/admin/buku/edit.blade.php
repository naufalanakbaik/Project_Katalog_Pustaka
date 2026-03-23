@include('admin.layout.header')
<title>Edit Buku | Pustaka Katalog</title>

<div class="flex items-center justify-between mb-4">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2">Edit Buku</h3>
    <a href="{{ route('admin.buku.index') }}" class="button-kembali">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<div class="bg-white border border-gray-300 rounded-md shadow-sm w-full max-w-auto p-6">
    <form action="{{ route('admin.buku.update', $buku->id) }}" method="post" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="" class="block text-base font-medium text-gray-700 mb-2">Judul Buku :</label>
            <input type="text" name="judul" id="" value="{{ $buku->judul }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">
        </div>
        <div class="mb-3">
            <label for="" class="block text-base font-medium text-gray-700 mb-2">Pengarang :</label>
            <input type="text" name="pengarang" id="" value="{{ $buku->pengarang }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">
        </div>
        <div class="mb-3">
            <label for="" class="block text-base font-medium text-gray-700 mb-2">Tahun Terbit :</label>
            <input type="text" name="tahun_terbit" id="" value="{{ $buku->tahun_terbit }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800">
        </div>
        <div class="mb-3">
            <label for="" class="block text-base font-medium text-gray-700 mb-2">Penerbit :</label>
            <div class="relative">
                <select name="penerbit_id"
                    class="w-full appearance-none px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none pr-10">
                    @foreach ($penerbit as $p)
                        <option value="{{ $p->id }}" {{ $p->id == $buku->penerbit_id ? 'selected' : '' }}>
                            {{ $p->nama_penerbit }}</option>
                    @endforeach
                </select>
                <!-- Custom arrow -->
                <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
            </div>
        </div>
        <div class="mb-3">
            <label for="" class="block text-base font-medium text-gray-700 mb-2">Kategori :</label>
            <div class="relative">
                <select name="kategori_id"
                    class="w-full appearance-none px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none pr-10">
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id }}" {{ $k->id == $buku->kategori_id ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
                <!-- Custom arrow -->
                <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label for="deskripsi" class="block text-base font-medium text-gray-700 mb-2">
                Deskripsi/ Sinopsis :
            </label>

            <textarea name="deskripsi" id="deskripsi" rows="5"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800 resize-none"
                placeholder="Masukkan deskripsi buku...">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
        </div>

        {{-- Gambar cover --}}
        <div class="mb-6">
            <label class="block text-base font-medium text-gray-700 mb-2">Gambar Sampul :</label>
            <div class="flex items-center gap-4">
                <img id="previewCover" src="{{ $buku->cover ? asset('storage/' . $buku->cover) : '' }}"
                    alt="Preview Cover" class="w-28 h-36 object-cover rounded-md border border-gray-200">
                <div class="flex-1">
                    <input type="file" name="file_cover" id="fileCoverInput"
                        class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition" />
                    <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG • Max 10MB</p>
                </div>
            </div>
            <input type="hidden" name="cover_lama" value="{{ $buku->cover }}">
        </div>

        {{-- Tombol Update --}}
        <div class="flex justify-end">
            <button type="submit" class="button-submit">
                Update
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('fileCoverInput').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById('previewCover').src = URL.createObjectURL(file);
        }
    });
</script>

@include('admin.layout.footer')
