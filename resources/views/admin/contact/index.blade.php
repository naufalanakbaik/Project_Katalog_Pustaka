@include('admin.layout.header')
<title>Pesan | Pustaka Katalog</title>

<div class="mb-4">
    <h3 class="text-2xl font-medium text-gray-900">Daftar Pesan Masuk</h3>
    <p class="mt-0.5 text-sm text-gray-500">
        Daftar pesan masuk yang diterima oleh administrator.
    </p>
</div>

{{-- Form pencarian --}}
<div class="mb-6 bg-white p-5 rounded-lg border border-gray-300 shadow-sm">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <form action="{{ route('admin.contact.index') }}" method="get" class="flex items-center gap-3 w-full md:w-auto">
            <input type="text" name="cari" placeholder="Cari Nama/ Email..."
                class="w-full md:w-64 px-4 py-2.5 text-sm border border-gray-300 rounded-lg
                    focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition">
            <button type="submit"
                class="inline-flex items-center justify-center px-3 py-2.5
                    rounded-xl bg-blue-600 hover:bg-blue-700 text-white shadow-sm transition">
                <span class="material-icons text-[20px]">search</span>
            </button>
        </form>
    </div>
</div>

{{-- Table data --}}
<div class="overflow-x-auto border border-gray-300 rounded-lg shadow-sm bg-white">
    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-sm text-gray-900 border-b border-gray-300 tracking-wide">
            <tr>
                <th class="px-3 py-3 text-center font-semibold">No.</th>
                <th class="px-4 py-3 text-left font-semibold">Nama</th>
                <th class="px-2 py-3 text-left font-semibold">Email</th>
                <th class="px-2 py-3 text-left font-semibold">Status Baca</th>
                <th class="px-2 py-3 text-left font-semibold">Status Balasan</th>
                <th class="px-2 py-3 text-center font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 text-gray-700">
            @foreach ($allContact as $key => $c)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-3 py-3 text-center font-medium text-gray-800">
                        {{ $key + $allContact->firstItem() }}
                    </td>

                    <td class="px-4 py-3 font-medium text-gray-700">
                        {{ $c->nama }}
                    </td>

                    <td class="px-2 py-3 text-gray-600">
                        {{ $c->email }}
                    </td>

                    <td class="px-2 py-3">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                            {{ $c->is_read ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $c->is_read ? 'Sudah Dibaca' : 'Belum Dibaca' }}
                        </span>
                    </td>

                    <td class="px-2 py-3">
                        @if ($c->status === 'replied')
                            <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                Sudah Dibalas
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold text-gray-600 bg-gray-200 rounded-full">
                                Belum Dibalas
                            </span>
                        @endif

                    </td>

                    <td class="px-2 py-3 text-center" width="230">
                        <form action="{{ route('admin.contact.destroy', $c->id) }}" method="POST"
                            class="inline-flex gap-3 items-center justify-center">
                            <a href="{{ route('admin.contact.show', $c->id) }}"
                                class="inline-flex items-center gap-1 px-3 py-2 rounded-lg border border-gray-300 text-xs font-normal text-gray-700 hover:bg-blue-50 hover:border-blue-500 hover:text-blue-700 transition">
                                <img src="{{ asset('img/icon/detail-icon.png') }}" alt="Detail" class="w-4 h-4">
                                Detail
                            </a>

                            {{-- Button Delete --}}
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus pesan ini ?')"
                                class="inline-flex items-center gap-1 px-3 py-2 rounded-lg border border-gray-300 text-xs font-normal text-gray-700 hover:bg-red-50 hover:border-red-500 hover:text-red-700 transition">
                                <img src="{{ asset('img/icon/delete-icon.png') }}" alt="Hapus" class="w-4 h-4">
                                Hapus
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
    {{ $allContact->links('vendor.pagination.tailwind') }}
</div>

@include('admin.layout.footer')
