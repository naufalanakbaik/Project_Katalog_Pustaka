@extends('katalog.head-footer')
@section('title', 'Detail Buku')

@section('content')
    {{-- section detail buku --}}
    <section class="container max-w-6xl mx-auto pb-6 px-4 flex-grow">
        <div class="bg-white border border-gray-100 shadow-lg mt-8 rounded-lg p-12 grid grid-cols-1 md:grid-cols-2 gap-10 items-start">

            {{-- Cover Buku --}}
            <div class="flex justify-center">
                @if ($buku->cover)
                    <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover Buku"
                        class="w-72 h-auto object-cover rounded-lg shadow-sm border">
                @else
                    <img src="{{ asset('img/default_cover.jpg') }}" alt="Cover Buku"
                        class="w-72 h-auto object-cover rounded-lg shadow-sm border">
                @endif
            </div>

            {{-- Detail Buku --}}
            <div class="space-y-5">
                {{-- Judul --}}
                <h2 class="text-3xl font-semibold text-blue-800">
                    {{ $buku->judul }}
                </h2>

                {{-- Info Buku --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-6 text-gray-700 text-sm">
                    <p><span class="font-semibold text-gray-900">Pengarang :</span> {{ $buku->pengarang }}</p>
                    <p><span class="font-semibold text-gray-900">Penerbit :</span> {{ $buku->penerbit->nama_penerbit }}</p>
                    <p><span class="font-semibold text-gray-900">Tahun Terbit :</span> {{ $buku->tahun_terbit }}</p>
                    <p><span class="font-semibold text-gray-900">Ketegori :</span> {{ $buku->kategori->nama_kategori }}</p>
                </div>

                {{-- Deskripsi --}}
                <div
                    class="bg-gray-50 border border-gray-100 rounded-lg p-5 text-sm text-gray-700 leading-relaxed text-justify shadow-inner">
                    {!! $buku->deskripsi ?: '<span class="italic text-gray-400">Deskripsi/ sinopsis belum tersedia.</span>' !!}
                </div>

                {{-- Tombol --}}
                <div class="pt-4">
                    <a href="{{ route('homepage') }}"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-3 py-2 rounded-lg font-medium shadow-lg hover:from-blue-700 hover:to-blue-800 transition">
                        {{-- <span>Kembali ke Homepage</span> --}}
                        <span class="material-icons text-sm">east</span>
                    </a>
                </div>

            </div>
        </div>
    </section>
    
@endsection
