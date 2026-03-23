@include('admin.layout.header')
<title>Penerbit | Pustaka Katalog</title>

<div class="mb-4">
    <h3 class="text-2xl font-medium text-gray-900">Daftar Penerbit</h3>
    <p class="mt-0.5 text-sm text-gray-500">
        Daftar penerbit untuk mengelompokkan jurnal berdasarkan penerbitnya agar pengelolaan dan pencarian data lebih mudah.
    </p>
</div>

{{-- Form tambah dan pencarian --}}
<div class="mb-5 bg-white p-5 rounded-lg border border-gray-300 shadow-sm">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Tombol Tambah -->
        <a href="{{ route('admin.penerbit.create') }}"
            class="inline-flex items-center text-gray-800 text-base font-normal px-2 py-1 hover:text-blue-700 transition">
            <span class="material-icons text-white mr-2 px-1 py-1 border border-blue-700 bg-blue-700 rounded-full hover:bg-white hover:text-blue-600 transition">add</span>
            Tambah Penerbit
        </a>

        <!-- Form Pencarian -->
        <form action="{{ route('admin.penerbit.index') }}" method="get" class="flex items-center gap-2 w-full md:w-auto">
            <input type="text" name="cari" placeholder="Cari Nama Penerbit ..."
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-64 shadow-sm">
            <button type="submit"
                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium px-2.5 py-2 rounded-xl shadow transition">
                <span class="material-icons text-base">search</span>
            </button>
        </form>
    </div>
</div>

{{-- table data --}}
<div class="overflow-x-auto border border-gray-300 rounded-md shadow-sm bg-white">
    <table class="w-full text-base">
        <thead class="bg-gray-200 text-sm text-gray-900 border-b border-gray-300 tracking-wide">
            <tr>
                <th class="px-2 py-3 text-center font-medium">No.</th>
                <th class="px-5 py-3 text-left font-medium">Nama Penerbit</th>
                <th class="px-2 py-3 text-left font-medium">Tanggal Dibuat</th>
                <th class="px-5 py-3 text-center font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-300">
            @foreach ($allPenerbit as $key => $r)
                <tr class="hover:bg-gray-50">
                    <td class="px-2 py-3 text-center">{{ $key + $allPenerbit->firstItem() }}</td>
                    <td class="px-5 py-3">{{ $r->nama_penerbit }}</td>
                    <td class="px-2 py-3">{{ $r->created_at->format('d M Y') }}</td>
                    <td class="px-2 py-3 text-center" width="250">
                        <form action="{{ route('admin.penerbit.destroy', $r->id) }}" method="POST"
                            class="inline-flex gap-3 items-center justify-center">

                            {{-- Detail --}}
                            <a href="{{ route('admin.penerbit.show', $r->id) }}" class="w-9 h-9 flex items-center justify-center rounded-lg bg-slate-50 border border-slate-200 transition-all duration-200 ease-in-out hover:-translate-y-0.5 hover:shadow-md hover:bg-emerald-50 hover:border-emerald-500 active:scale-95">
                                <img src="{{ asset('img/icon/detail-icon.png') }}" alt="Detail"
                                    class="w-[18px] h-[18px]">
                            </a>

                            {{-- Edit --}}
                            <a href="{{ route('admin.penerbit.edit', $r->id) }}" class="w-9 h-9 flex items-center justify-center rounded-lg bg-slate-50 border border-slate-200 transition-all duration-200 ease-in-out hover:-translate-y-0.5 hover:shadow-md hover:bg-indigo-50 hover:border-indigo-500 active:scale-95">
                                <img src="{{ asset('img/icon/edit-icon.png') }}" alt="Edit"
                                    class="w-[18px] h-[18px]">
                            </a>

                            {{-- Delete --}}
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus penerbit ini ?')"
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

<div class="mt-3">
    {{ $allPenerbit->links('vendor.pagination.tailwind') }}
</div>

@include('admin.layout.footer')
