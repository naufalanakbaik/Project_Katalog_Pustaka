@extends('katalog.head-footer')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 text-white bg-cover bg-center"
        style="background-image: url('{{ asset('img/pp.png') }}'); height: 75vh;">
        <!-- Efek filter kehitaman -->
        <div class="absolute inset-0 bg-black/70"></div>

        <div class="relative container max-w-6xl mx-auto h-full flex flex-col items-center justify-center text-center px-4 text-white">
            <h2 class="text-3xl md:text-5xl font-semibold drop-shadow-lg">
                Selamat Datang di Website
            </h2>

            <h2 class="text-white text-2xl md:text-4xl font-semibold mt-4 tracking-tight">
                Katalog Pustaka
            </h2>

            <p class="text-base md:text-lg text-white max-w-3xl mx-auto mt-4 drop-shadow-md">
                Jelajahi koleksi jurnal dan buku terbaik untuk memperluas wawasan dan pengetahuan Anda.
            </p>
        </div>
    </section>

    {{-- <section class="container max-w-6xl mx-auto -mt-12 px-4 relative z-10">
        <form action="{{ route('homepage') }}" method="get"
            class="bg-white shadow-md rounded-2xl p-6 border border-gray-100 grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
            <!-- Kategori -->
            <div x-data="{ open: false, selected: '{{ request('kategori') ? $kategori->firstWhere('id', request('kategori'))->nama_kategori ?? 'Semua Kategori' : 'Semua Kategori' }}' }" class="relative w-full md:w-64">
                <!-- Tombol dropdown -->
                <button type="button" @click="open = !open"
                    class="w-full flex justify-between items-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-700 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500">
                    <span x-text="selected"></span>
                    <svg class="h-4 w-4 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open }"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <!-- Dropdown list -->
                <div x-show="open" x-cloak @click.away="open = false" x-transition
                    class="absolute z-10 mt-1 w-full rounded-md border border-gray-200 bg-white shadow-lg">
                    <ul class="max-h-60 overflow-auto py-1 text-gray-700">
                        <!-- Default option -->
                        <li @click="selected = 'Semua Kategori'; open = false; $refs.hiddenKategori.value=''"
                            class="cursor-pointer px-4 py-2 hover:bg-gray-100"
                            :class="{ 'bg-gray-100 font-semibold': selected === 'Semua Kategori' }">
                            Semua Kategori
                        </li>
                        <!-- Loop kategori dari Laravel -->
                        @foreach ($kategori as $k)
                            <li @click="selected = '{{ $k->nama_kategori }}'; open = false; $refs.hiddenKategori.value='{{ $k->id }}'"
                                class="cursor-pointer px-4 py-2 hover:bg-gray-100"
                                :class="{ 'bg-gray-100 font-semibold': selected === '{{ $k->nama_kategori }}' }">
                                {{ $k->nama_kategori }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Hidden input agar value tetap terkirim ke backend -->
                <input type="hidden" name="kategori" x-ref="hiddenKategori" value="{{ request('kategori') }}">
            </div>

            <!-- Penerbit -->
            <div x-data="{ open: false, selected: '{{ request('penerbit') ? $penerbit->firstWhere('id', request('penerbit'))->nama_penerbit ?? 'Semua Penerbit' : 'Semua Penerbit' }}' }" class="relative w-full md:w-64">
                <!-- Tombol dropdown -->
                <button type="button" @click="open = !open"
                    class="w-full flex justify-between items-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-700 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500">
                    <span x-text="selected"></span>
                    <svg class="h-4 w-4 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open }"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <!-- Dropdown list -->
                <div x-show="open" x-cloak @click.away="open = false" x-transition
                    class="absolute z-10 mt-1 w-full rounded-md border border-gray-200 bg-white shadow-lg">
                    <ul class="max-h-60 overflow-auto py-1 text-gray-700">
                        <!-- Default option -->
                        <li @click="selected = 'Semua Penerbit'; open = false; $refs.hiddenPenerbit.value=''"
                            class="cursor-pointer px-4 py-2 hover:bg-gray-100"
                            :class="{ 'bg-gray-100 font-semibold': selected === 'Semua Penerbit' }">
                            Semua Penerbit
                        </li>
                        <!-- Loop penerbit dari Laravel -->
                        @foreach ($penerbit as $p)
                            <li @click="selected = '{{ $p->nama_penerbit }}'; open = false; $refs.hiddenPenerbit.value='{{ $p->id }}'"
                                class="cursor-pointer px-4 py-2 hover:bg-gray-100"
                                :class="{ 'bg-gray-100 font-semibold': selected === '{{ $p->nama_penerbit }}' }">
                                {{ $p->nama_penerbit }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Hidden input agar value tetap terkirim ke backend -->
                <input type="hidden" name="penerbit" x-ref="hiddenPenerbit" value="{{ request('penerbit') }}">
            </div>

            <!-- Search -->
            <div class="md:col-span-2 flex">
                <input type="text" name="search" class="flex-1 p-3 border rounded-l-lg focus:outline-none"
                    placeholder="Cari Nama Buku, Pengarang, Penerbit ..." value="{{ request('search') }}">
                <button type="submit"
                    class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800
                        text-white font-semibold px-5 rounded-r-lg shadow-sm transition flex items-center justify-center">
                    <span class="material-icons text-base">search</span>
                </button>
            </div>
        </form>
    </section> --}}

    <!-- Filter & Search Section -->
    <section class="container max-w-6xl mx-auto -mt-12 px-4 relative z-10">
        <form action="{{ route('homepage') }}" method="get"
            class="bg-white shadow-md rounded-2xl p-6 border border-gray-100 grid grid-cols-1 md:grid-cols-4 gap-4 items-center">

            {{-- Kategori --}}
            <x-filter-dropdown name="kategori" label="Semua Kategori" :options="$kategori" valueKey="id"
                labelKey="nama_kategori" :selectedLabel="request('kategori')
                    ? $kategori->firstWhere('id', request('kategori'))?->nama_kategori
                    : null" />

            {{-- Penerbit --}}
            <x-filter-dropdown name="penerbit" label="Semua Penerbit" :options="$penerbit" valueKey="id"
                labelKey="nama_penerbit" :selectedLabel="request('penerbit')
                    ? $penerbit->firstWhere('id', request('penerbit'))?->nama_penerbit
                    : null" />

            {{-- Search --}}
            <div class="md:col-span-2 flex">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari Nama Buku, Pengarang, Penerbit ..."
                    class="flex-1 p-3 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                <button type="submit"
                    class="bg-blue-700 hover:bg-blue-800
                text-white font-semibold px-5 rounded-r-lg shadow-sm transition flex items-center justify-center">
                    <span class="material-icons text-base">search</span>
                </button>
            </div>
        </form>
    </section>

    <!-- Catalog Section -->
    <section class="container max-w-6xl mx-auto py-12 px-4">
        {{-- <h3 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Koleksi Buku</h3> --}}

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($buku as $b)
                <div
                    class="bg-white shadow-md hover:shadow-2xl transition rounded-2xl overflow-hidden flex flex-col group border border-gray-100">

                    <!-- Cover -->
                    <div class="relative">
                        @if ($b->cover)
                            <img src="{{ asset('storage/' . $b->cover) }}" alt="Cover Buku"
                                class="w-full h-56 object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <img src="{{ asset('img/default_cover.jpg') }}" alt="Cover Buku"
                                class="w-full h-56 object-cover group-hover:scale-105 transition duration-500">
                        @endif

                        <!-- Badge kategori -->
                        <span
                            class="absolute top-3 left-3 bg-blue-600 text-white text-xs font-normal px-3 py-1 rounded-lg shadow-md">
                            {{ $b->kategori->nama_kategori }}
                        </span>

                        <form action="{{ route('buku.favorit', $b->id) }}" method="POST" class="absolute top-2 right-2">
                            @csrf
                            <button type="submit"
                                class="flex items-center justify-center w-10 h-10 rounded-full bg-white border border-gray-200 shadow-sm transition-all duration-200 hover:bg-blue-50 hover:shadow-md active:scale-95 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-1">
                                @if (auth()->user()->favoritBuku->contains($b->id))
                                    <span class="material-icons text-blue-600">
                                        bookmark_added
                                    </span>
                                @else
                                    <span class="material-icons text-gray-600">
                                        bookmark
                                    </span>
                                @endif
                            </button>
                        </form>

                    </div>

                    <!-- Info Buku -->
                    <div class="p-5 flex flex-col justify-between flex-1">
                        <div>
                            <h3 class="text-lg font-semibold text-blue-700 group-hover:text-blue-900 transition mb-1">
                                <a href="{{ route('detail-buku', $b->id) }}">{{ $b->judul }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm">Pengarang : {{ $b->pengarang }}</p>
                            <p class="text-gray-600 text-sm">Penerbit : {{ $b->penerbit->nama_penerbit }}</p>
                            <p class="text-gray-600 text-sm">Kategori : {{ $b->kategori->nama_kategori }}</p>
                        </div>
                        <p class="text-gray-500 text-xs mt-3">📅 Tahun : {{ $b->tahun_terbit }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $buku->links() }}
        </div>
    </section>
@endsection
