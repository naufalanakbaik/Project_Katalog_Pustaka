@extends('katalog.head-footer')
@section('title', 'Favorite Saya')

@section('content')
<div class="max-w-6xl mx-auto mt-8 px-4 mb-10">

    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
        Buku Favorit Saya
    </h2>

    @if ($bukuFavorit->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($bukuFavorit as $buku)
                <div
                    class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm transition-all duration-200
                        hover:shadow-md hover:-translate-y-1">

                    <!-- Cover Buku -->
                    <div class="h-48 bg-gray-100 flex items-center justify-center">
                        @if ($buku->cover)
                            <img src="{{ asset('storage/' . $buku->cover) }}"
                                alt="{{ $buku->judul }}"
                                class="h-full w-full object-cover">
                        @else
                            <span class="material-icons text-gray-400 text-6xl">
                                menu_book
                            </span>
                        @endif
                    </div>

                    <!-- Konten -->
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-800 line-clamp-2">
                            {{ $buku->judul }}
                        </h3>

                        <p class="text-sm text-gray-600 mt-1">
                            Pengarang : {{ $buku->pengarang }}
                        </p>
                        <p class="text-sm text-gray-600">
                            Penerbit : {{ $buku->penerbit->nama_penerbit }}
                        </p>
                        <p class="text-sm text-gray-600">
                            Kategori : {{ $buku->kategori->nama_kategori }}
                        </p>

                        <p class="text-xs text-gray-500 mt-2">
                            📅 Tahun : {{ $buku->tahun_terbit }}
                        </p>

                        <!-- Aksi -->
                        <div class="flex items-center justify-between mt-4">
                            <a href="{{ route('detail-buku', $buku->id) }}"
                                class="text-sm text-blue-600 hover:underline">
                                Lihat Detail
                            </a>

                            <span class="flex items-center text-red-500 text-sm">
                                <span class="material-icons text-base mr-1">
                                    favorite
                                </span>
                                Favorit
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $bukuFavorit->links() }}
        </div>
    @else
        <div class="text-center py-20 text-gray-500">
            <span class="material-icons text-6xl mb-4 block">
                sentiment_dissatisfied
            </span>
            <p>Belum ada buku favorit.</p>
        </div>
    @endif

</div>
@endsection
