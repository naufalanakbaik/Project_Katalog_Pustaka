@include('admin.layout.header')
<title>Kategori | Pustaka Katalog</title>

<div class="mb-4">
    <h3 class="text-2xl font-medium text-gray-900 dark:text-gray-100">Daftar Kategori</h3>
    <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
        Daftar kategori untuk mengelompokkan jurnal berdasarkan bidang atau topik tertentu agar pengelolaan dan
        pencarian data lebih mudah.
    </p>
</div>

{{-- Form tambah dan pencarian --}}
<div class="mb-5 bg-white p-5 rounded-lg border border-gray-300 shadow-sm dark:bg-gray-800 dark:border-gray-300">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Tombol Tambah -->
        <a href="{{ route('admin.kategori.create') }}"
            class="inline-flex items-center text-gray-800 text-base font-normal px-2 py-1 hover:text-blue-700 
            dark:text-gray-100 dark:hover:text-blue-400 transition">
            <span
                class="material-icons text-white mr-2 px-1 py-1 border border-blue-700 bg-blue-700 rounded-full hover:bg-white hover:text-blue-600 transition">add</span>
            Tambah Kategori
        </a>

        <!-- Form Pencarian -->
        <form action="{{ route('admin.kategori.index') }}" method="get"
            class="flex items-center gap-2 w-full md:w-auto">
            <input type="text" name="cari" placeholder="Cari Nama Kategori ..."
                class="px-3 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-1 focus:ring-blue-500 w-full md:w-64 dark:bg-gray-700 dark:border-gray-300 dark:text-gray-200 shadow-sm">
            <button type="submit"
                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium px-2.5 py-2 rounded-xl shadow transition">
                <span class="material-icons text-base">search</span>
            </button>
        </form>
    </div>
</div>

{{-- table data --}}
<div class="overflow-x-auto bg-white border border-blue-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-300">
    <table class="w-full text-base">
        <thead class="bg-gray-200 text-sm text-gray-900 border-b border-blue-300
        dark:bg-gray-700 dark:text-gray-200 dark:border-gray-200 tracking-wide">
            <tr>
                <th class="px-2 py-3 text-center font-medium">No.</th>
                <th class="px-5 py-3 text-left font-medium">Nama Kategori</th>
                <th class="px-2 py-3 text-left font-medium">Tanggal Dibuat</th>
                <th class="px-5 py-3 text-center font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-300 dark:divide-gray-600">
            @foreach ($allKategori as $key => $r)
                <tr class="hover:bg-gray-50 text-gray-900 dark:hover:bg-gray-700 dark:text-gray-200 transition-colors">
                    <td class="px-2 py-3 text-center">{{ $key + $allKategori->firstItem() }}</td>
                    <td class="px-5 py-3">{{ $r->nama_kategori }}</td>
                    <td class="px-2 py-3">
                        {{ $r->created_at?->format('d M Y') ?? 'Tidak ada tanggal' }}
                    </td>
                    {{-- Button Aksi --}}
                    <td class="px-5 py-3 text-center" width="250">
                        <form action="{{ route('admin.kategori.destroy', $r->id) }}" method="POST"
                            class="flex items-center justify-center gap-3">

                            {{-- Detail --}}
                            <a href="{{ route('admin.kategori.show', $r->id) }}"
                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-slate-50 border border-slate-200 transition-all duration-200 ease-in-out hover:-translate-y-0.5 hover:shadow-md hover:bg-emerald-50 hover:border-emerald-500 active:scale-95">
                                <img src="{{ asset('img/icon/detail-icon.png') }}" alt="Detail"
                                    class="w-[18px] h-[18px]">
                            </a>

                            {{-- Edit --}}
                            <a href="{{ route('admin.kategori.edit', $r->id) }}"
                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-slate-50 border border-slate-200 transition-all duration-200 ease-in-out hover:-translate-y-0.5 hover:shadow-md hover:bg-indigo-50 hover:border-indigo-500 active:scale-95">
                                <img src="{{ asset('img/icon/edit-icon.png') }}" alt="Edit"
                                    class="w-[18px] h-[18px]">
                            </a>

                            {{-- Hapus --}}
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-slate-50 border border-slate-200 transition-all duration-200 ease-in-out hover:-translate-y-0.5 hover:shadow-md hover:bg-red-50 hover:border-red-500 active:scale-95">
                                <img src="{{ asset('img/icon/delete-icon.png') }}" alt="Hapus"
                                    class="w-[18px] h-[18px]">
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="mt-4">
    {{ $allKategori->links('vendor.pagination.tailwind-darkmode') }}
</div>

@include('admin.layout.footer')
