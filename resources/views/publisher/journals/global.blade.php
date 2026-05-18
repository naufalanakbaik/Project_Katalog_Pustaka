@extends('publisher.layouts.app')
@section('title', 'Katalog Jurnal Global')


@section('content')
    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
            Katalog Jurnal Global
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Jelajahi seluruh jurnal ilmiah yang tersedia di repository.
        </p>
    </div>

    {{-- Grid Jurnal --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($journals as $journal)
            <div class="bg-white dark:bg-gray-800 shadow hover:shadow-lg transition rounded-xl overflow-hidden flex flex-col border border-gray-100 dark:border-gray-700 group">
                {{-- Header PDF --}}
                <div class="relative h-40 bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center">
                    <span class="material-icons text-white text-5xl opacity-90">
                        picture_as_pdf
                    </span>
                    <span class="absolute top-3 left-3 bg-white/90 text-red-600 text-xs font-semibold px-2 py-1 rounded-md">
                        Jurnal
                    </span>
                </div>

                {{-- Konten --}}
                <div class="p-5 flex flex-col flex-1">
                    <h3 class="text-lg font-semibold text-red-700 group-hover:text-red-900 mb-1 line-clamp-2">
                        {{ $journal->judul }}
                    </h3>
                    <p class="text-sm text-gray-500 ">
                        <strong class="font-semibold">Pengarang:</strong> {{ $journal->pengarang }}
                    </p>
                    <p class="text-sm text-gray-500 mt-2 line-clamp-3">
                        {{ $journal->abstrak }}
                    </p>
                    <div class="mt-auto pt-4 text-xs text-gray-500 flex items-center gap-4">
                        <span class="flex items-center gap-1.5">
                            <span class="material-icons !text-[15px]">calendar_month</span>
                            {{ $journal->tahun_terbit }}
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="material-icons !text-[16px]">account_box</span>
                            {{ $journal->publisher->name ?? 'Unknown' }}
                        </span>
                    </div>
                </div>

                {{-- Action --}}
                <div class="border-t border-gray-100 dark:border-gray-700 p-4 flex gap-2">
                    <a href="{{ route('publisher.journals.show', $journal->id) }}"
                        class="flex-1 text-center rounded-lg border border-red-600 text-red-600 px-3 py-2 text-sm font-semibold hover:bg-red-50 dark:hover:bg-gray-700 transition">
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
                Belum ada jurnal tersedia.
            </p>
        @endforelse
    </div>

@endsection
