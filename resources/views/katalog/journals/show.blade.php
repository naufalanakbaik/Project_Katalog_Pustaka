@extends('katalog.head-footer')
@section('title', 'Detail Jurnal')

@section('content')

    <section class="container max-w-6xl mx-auto py-12 px-4">

        {{-- Card Utama --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">

            {{-- Header --}}
            <div class="relative bg-gradient-to-br from-red-600 to-red-800 px-8 py-10 text-white">
                <span class="absolute top-4 right-4 bg-white/20 text-xs px-3 py-1 rounded-full">
                    Jurnal Ilmiah
                </span>

                <div class="flex items-start gap-5">
                    <span class="material-icons text-6xl opacity-90">
                        picture_as_pdf
                    </span>

                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold leading-tight mb-2">
                            {{ $journal->judul }}
                        </h1>
                        <p class="text-sm text-red-100">
                            {{ $journal->pengarang }} · {{ $journal->tahun_terbit }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Konten --}}
            <div class="px-8 py-8">

                {{-- Informasi Singkat --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Pengarang</p>
                        <p class="font-medium text-gray-800">{{ $journal->pengarang }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Tahun Terbit</p>
                        <p class="font-medium text-gray-800">{{ $journal->tahun_terbit }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">Format</p>
                        <p class="font-medium text-gray-800">PDF</p>
                    </div>
                </div>

                {{-- Abstrak --}}
                <div class="mb-10">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">
                        Abstrak
                    </h3>
                    <p class="text-gray-700 leading-relaxed text-justify">
                        {{ $journal->abstrak }}
                    </p>
                </div>

                {{-- Aksi --}}
                <div class="flex flex-wrap gap-3 border-t pt-6">

                    <a href="{{ asset('storage/' . $journal->file_path) }}" target="_blank"
                        class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-6 py-3 text-sm font-semibold text-white hover:bg-red-700 transition shadow">
                        <span class="material-icons text-base">picture_as_pdf</span>
                        Baca PDF
                    </a>

                    <a href="{{ route('journal.download', $journal->id) }}"
                        class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-100 transition">
                        <span class="material-icons text-base">download</span>
                        Download PDF
                    </a>

                    <a href="{{ route('journals.index') }}"
                        class="ml-auto inline-flex items-center text-sm text-blue-600 hover:underline">
                        Kembali ke Katalog
                    </a>

                </div>
            </div>
        </div>

    </section>

@endsection
