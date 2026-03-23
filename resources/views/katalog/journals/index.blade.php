@extends('katalog.head-footer')
@section('title', 'Katalog Jurnal')

@section('content')

    {{-- Header Section --}}
    <section class="relative py-20 text-white bg-cover bg-center"
        style="background-image: url('{{ asset('img/pp.png') }}'); height: 75vh;">
        <!-- Efek filter kehitaman -->
        <div class="absolute inset-0 bg-black/70"></div>

        <!-- Content -->
        <div
            class="relative container max-w-6xl mx-auto h-full flex flex-col items-center justify-center text-center px-4 text-white">
            <h2 class="text-3xl md:text-5xl font-semibold drop-shadow-lg">
                Selamat Datang di Website
            </h2>

            <h2 class="text-white text-2xl md:text-4xl font-semibold mt-4 tracking-tight">
                Katalog Pustaka
            </h2>

            <p class="text-base md:text-lg text-white max-w-3xl mx-auto mt-4 drop-shadow-lg">
                Jelajahi koleksi jurnal dan buku terbaik untuk memperluas wawasan dan pengetahuan Anda.
            </p>
        </div>
    </section>


    {{-- Filter & Search Section --}}
    <section class="container max-w-6xl mx-auto -mt-12 px-4 relative z-10">
        <form method="GET" action="{{ route('journals.index') }}"
            class="bg-white shadow-md rounded-2xl p-6 border border-gray-100 grid grid-cols-1 md:grid-cols-4 gap-4 items-center">

            {{-- Tahun --}}
            <x-filter-dropdown name="tahun" label="Semua Tahun" :options="$tahunList->map(fn($t) => (object) ['id' => $t, 'name' => $t])" :selectedLabel="request('tahun')" />

            {{-- Publisher --}}
            <x-filter-dropdown name="publisher" label="Semua Publisher" :options="$publishers" :selectedLabel="request('publisher') ? $publishers->firstWhere('id', request('publisher'))?->name : null" />

            {{-- Search --}}
            <div class="md:col-span-2 flex">
                <input type="text" name="search" class="flex-1 p-3 border rounded-l-lg focus:outline-none"
                    placeholder="Cari judul, pengarang, abstrak..." value="{{ request('search') }}">

                <button type="submit"
                    class="bg-blue-700 hover:bg-blue-800
                        text-white font-semibold px-5 rounded-r-lg shadow-sm transition flex items-center justify-center">
                    <span class="material-icons text-base">search</span>
                </button>
            </div>
        </form>
    </section>

    {{-- Katalog daftar junral --}}
    <section class="container max-w-6xl mx-auto py-12 px-4">
        {{-- <h3 class="text-3xl font-semibold text-gray-800 mb-8 text-center">
            Katalog Jurnal Ilmiah
        </h3> --}}

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @forelse ($journals as $journal)
                <div
                    class="bg-white shadow-md hover:shadow-lg transition rounded-2xl overflow-hidden flex flex-col group border border-gray-100">

                    {{-- Header PDF --}}
                    <div class="relative h-44 bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center">

                        <span class="material-icons text-white text-6xl opacity-90">
                            picture_as_pdf
                        </span>

                        {{-- Badge --}}
                        <span
                            class="absolute top-3 left-3 bg-white/90 text-red-600 text-xs font-semibold px-3 py-1 rounded-lg shadow">
                            Jurnal Ilmiah
                        </span>
                    </div>

                    {{-- Info Jurnal --}}
                    <div class="p-5 flex flex-col justify-between flex-1">
                        <div>
                            <h3
                                class="text-lg font-semibold text-red-700 group-hover:text-red-900 transition mb-1 line-clamp-2">
                                {{ $journal->judul }}
                            </h3>

                            <p class="text-gray-600 text-sm">
                                <strong>Pengarang:</strong> {{ $journal->pengarang }}
                            </p>

                            <p class="text-gray-500 text-sm mt-2 line-clamp-3">
                                {{ $journal->abstrak }}
                            </p>
                        </div>

                        <div class="mt-4 text-xs text-gray-500 flex items-center justify-between">
                            <span>📅 Tahun terbit : {{ $journal->tahun_terbit }}</span>
                            <span>📄 PDF🔻</span>
                        </div>
                    </div>

                    {{-- Action --}}
                    <div class="border-t border-gray-100 p-4 flex gap-2">
                        <a href="{{ route('journals.show', $journal->id) }}"
                            class="flex-1 text-center rounded-lg border border-red-600 text-red-600 px-3 py-2 text-sm font-semibold hover:bg-red-50 transition">
                            Detail
                        </a>

                        <a href="{{ asset('storage/' . $journal->file_path) }}" target="_blank"
                            class="flex-1 text-center rounded-lg bg-red-600 text-white px-3 py-2 text-sm font-semibold hover:bg-red-700 transition">
                            Buka PDF
                        </a>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">
                    Belum ada jurnal yang tersedia.
                </p>
            @endforelse
        </div>
    </section>

@endsection
