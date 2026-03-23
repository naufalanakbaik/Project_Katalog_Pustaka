@include('admin.layout.header')
<title>Tambah Peminjaman | Pustaka Katalog</title>

<div class="flex items-center justify-between">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2">Tambah Peminjaman</h3>
    <a href="{{ route('admin.peminjaman.index') }}"
        class="button-kembali">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<form action="{{ route('admin.peminjaman.store') }}" method="post" class="bg-white p-4 space-y-4">
    @csrf
    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
        Isi dengan benar
    </h3>
    <!-- Tanggal Peminjaman -->
    <div>
        <label for="tgl_peminjaman" class="block text-gray-700 font-semibold mb-2">
            📅 Tanggal Peminjaman
        </label>
        <input type="date" name="tgl_peminjaman" id="tgl_peminjaman"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm cursor-pointer
                    focus:ring-2 focus:ring-blue-500 focus:outline-none"
            value="{{ date('Y-m-d') }}">
    </div>

    <!-- Pilih Anggota -->
    <div>
        <label for="anggota_id" class="block text-gray-700 font-semibold mb-2">
            Pilih Anggota
        </label>

        <div class="relative">
            <select name="anggota_id" id="anggota_id"
                class="w-full appearance-none px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none pr-10
                @error('anggota_id') border-red-500 @enderror">
                <option value="" disabled selected>Pilih Anggota</option>
                @foreach ($anggota as $a)
                    <option value="{{ $a->id }}">{{ $a->nama_anggota }}</option>
                @endforeach
            </select>

            <!-- Custom arrow -->
            <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </span>

            {{-- Notifikasi error --}}
            @error('anggota_id')
                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <!-- Katalog Buku -->
    <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
            Katalog Buku
        </h3>
        <div class="overflow-y-scroll h-72 border border-gray-300 rounded-xl p-4 bg-gray-50">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                @foreach ($bukus as $buku)
                    <label
                        class="flex flex-col items-center p-4 bg-white border border-gray-200 rounded-xl shadow-sm cursor-pointer hover:shadow-md hover:border-blue-400 transition">
                        @if ($buku->cover)
                            <img src="{{ asset('storage') . '/' . $buku->cover }}" alt="Cover"
                                class="w-24 h-28 object-cover mb-3 rounded-md">
                        @else
                            <img src="{{ asset('img/default_cover.jpg') }}" alt="Cover"
                                class="w-24 h-28 object-cover mb-3 rounded-md">
                        @endif

                        <div class="flex items-center space-x-2">
                            <input type="checkbox" name="buku_ids[]" value="{{ $buku->id }}"
                                class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                            <span class="text-sm font-medium text-gray-700 text-center line-clamp-2">
                                {{ $buku->judul }}
                            </span>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Submit -->
    <div class="text-right">
        <button type="submit"
            class="button-submit">
            Submit
        </button>
    </div>
</form>


@include('admin.layout.footer')
