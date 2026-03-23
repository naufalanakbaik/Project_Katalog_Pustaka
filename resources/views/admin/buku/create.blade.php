@include('admin.layout.header')
<title>Tambah Buku | Pustaka Katalog</title>

<div class="flex items-center justify-between mb-4">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2">Tambah Buku</h3>
    <a href="{{ route('admin.buku.index') }}" class="button-kembali">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<div class="bg-white border border-gray-300 rounded-md shadow-sm w-full max-w-auto p-6">
    <form action="{{ route('admin.buku.store') }}" method="post" enctype="multipart/form-data" class="space-y-5">
        @csrf
        <div class="mb-3">
            <label for="" class="block text-base font-semibold text-gray-800 mb-2">
                Judul Buku :
            </label>
            <input type="text" name="judul" id="" placeholder="Masukkan judul buku"
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none"
                required>
        </div>
        <div class="mb-3">
            <label for="" class="block text-base font-semibold text-gray-800 mb-2">Pengarang :</label>
            <input type="text" name="pengarang" id="" placeholder="Masukkan nama pengarang"
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none"
                required>
        </div>
        <div class="mb-3">
            <label for="" class="block text-base font-semibold text-gray-800 mb-2">Tahun Terbit :</label>
            <input type="text" name="tahun_terbit" id="" placeholder="Masukkan tahun terbit"
                class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none"
                required>
        </div>

        <div class="mb-3">
            <label for="penerbit" class="block text-base font-semibold text-gray-800 mb-2">Penerbit :</label>
            <div class="relative">
                <select name="penerbit_id" id="penerbit"
                    class="w-full appearance-none px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none pr-10">
                    <option value="" disabled selected>Pilih Penerbit</option>
                    @foreach ($penerbit as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_penerbit }}</option>
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
            <label for="kategori" class="block text-base font-semibold text-gray-800 mb-2">Kategori :</label>
            <div class="relative">
                <select name="kategori_id" id="kategori"
                    class="w-full appearance-none px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none pr-10">
                    <option value="" disabled selected>Pilih Kategori</option>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
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
            <label for="deskripsi" class="block text-base font-semibold text-gray-800 mb-2">
                Deskripsi/ Sinopsis :
            </label>

            <textarea name="deskripsi" id="deskripsi" rows="5"
                class="w-full appearance-none px-3 py-2 border rounded-md shadow-sm
                focus:ring-1 focus:ring-blue-500 focus:outline-none resize-none"
                placeholder="Masukkan deskripsi buku...">{{ old('deskripsi', $buku->deskripsi ?? '') }}</textarea>
        </div>

        {{-- Input gambar file-cover --}}
        <div class="mb-3">
            <label for="file_cover" class="block text-base font-semibold text-gray-800 mb-2">
                Gambar Sampul :
            </label>

            <div class="flex items-center justify-center w-full">
                <label for="file_cover"
                    class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-md cursor-pointer bg-gray-50 hover:bg-gray-100 transition relative overflow-hidden">
                    <div id="upload_placeholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                        <!-- Icon upload -->
                        <span class="material-icons text-gray-400 text-5xl mb-3">photo_camera</span>

                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau
                            drag & drop</p>
                        <p class="text-xs text-gray-400">PNG, JPG (max. 10MB)</p>
                    </div>
                    <input id="file_cover" type="file" name="file_cover" accept="image/*" class="hidden" />
                </label>
            </div>

            <!-- Preview Gambar -->
            <div id="preview_container" class="mt-3 hidden">
                <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                <img id="preview_image" src="" alt="Preview" class="max-h-48 rounded-md border mb-3" />
                <div class="flex gap-3">
                    <label for="file_cover"
                        class="px-3 py-2 bg-gradient-to-br from-blue-50 to-indigo-100
                                hover:from-blue-100 hover:to-indigo-200 text-blue-700 text-sm font-medium rounded-md transition">
                        Ganti
                    </label>
                    <button type="button" id="removeBtn"
                        class="px-3 py-2 bg-gradient-to-br from-blue-50 to-indigo-100
                                hover:from-blue-100 hover:to-indigo-200 text-red-700 text-sm font-medium rounded-md transition">
                        Hapus
                    </button>
                </div>
            </div>
        </div>

        {{-- button submit --}}
        <div class="flex justify-end">
            <button type="submit" class="button-submit">
                Submit
            </button>
        </div>
    </form>
</div>

<script>
    const fileInput = document.getElementById('file_cover');
    const previewContainer = document.getElementById('preview_container');
    const previewImage = document.getElementById('preview_image');
    const uploadPlaceholder = document.getElementById('upload_placeholder');
    const removeBtn = document.getElementById('removeBtn');


    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
                uploadPlaceholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            previewImage.src = "";
            previewContainer.classList.add('hidden');
            uploadPlaceholder.classList.remove('hidden');
        }
    });


    removeBtn.addEventListener('click', function() {
        fileInput.value = "";
        previewImage.src = "";
        previewContainer.classList.add('hidden');
        uploadPlaceholder.classList.remove('hidden');
    });
</script>

@include('admin.layout.footer')
