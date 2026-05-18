@extends('publisher.layouts.app')
@section('title', 'Detail Jurnal')

@section('content')

    <section class="max-w-7xl mx-auto py-3">

        <!-- CARD -->
        <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
            <!-- HEADER -->
            <div class="relative bg-gradient-to-br from-red-600 to-red-800 px-8 py-10 text-white">
                <!-- Label -->
                <span class="absolute top-4 right-4 bg-white/20 text-xs px-3 py-1 rounded-full backdrop-blur">
                    Jurnal Ilmiah
                </span>
                <div class="flex gap-5 items-start">
                    <!-- Icon -->
                    <span class="material-icons text-6xl opacity-90">
                        picture_as_pdf
                    </span>
                    <!-- Title -->
                    <div class="mt-1">
                        <h1 class="text-2xl md:text-3xl font-semibold leading-tight mb-1">
                            {{ $journal->judul }}
                        </h1>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="px-8 py-8">
                <!-- INFO GRID -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Pengarang -->
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                            Pengarang
                        </p>
                        <p class="font-medium text-gray-800 dark:text-gray-200 mt-1">
                            {{ $journal->pengarang }}
                        </p>
                    </div>
                    <!-- Tahun -->
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                            Tahun Terbit
                        </p>
                        <p class="font-medium text-gray-800 dark:text-gray-200 mt-1">
                            {{ $journal->tahun_terbit }}
                        </p>
                    </div>

                    <!-- Format -->
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                            Format
                        </p>
                        <p class="font-medium text-gray-800 dark:text-gray-200 mt-1 flex items-center gap-2">
                            PDF
                        </p>
                    </div>
                </div>

                <!-- ABSTRACT -->
                <div class="mb-10">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-2 mb-4 flex items-center gap-2">
                        <span class="material-icons text-gray-500 dark:text-gray-400">
                            description
                        </span>
                        Abstrak
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-justify">
                        {{ $journal->abstrak }}
                    </p>
                </div>

                <!-- ACTION BUTTON -->
                <div class="flex flex-wrap gap-3 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <!-- Baca -->
                    <a href="{{ asset('storage/' . $journal->file_path) }}" target="_blank"
                        class="inline-flex items-center gap-2 bg-red-600 border border-red-700 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow">
                        <span class="material-icons !text-xl">
                            picture_as_pdf
                        </span>
                        Lihat PDF
                    </a>

                    <!-- Download -->
                    <a href="{{ route('journal.download', $journal->id) }}"
                        class="inline-flex items-center gap-2 border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 dark:text-gray-200 transition">
                        <span class="material-icons !text-xl">
                            file_download
                        </span>
                        Unduh PDF
                    </a>

                    <!-- Back -->
                    <a href="{{ route('publisher.journals.global') }}"
                        class="ml-auto inline-flex items-center text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-600 transition">
                        Kembali ke Katalog
                        <span class="material-icons !text-base mt-1 ml-1">
                            start
                        </span>
                    </a>
                </div>
            </div>
        </div>

    </section>

@endsection
