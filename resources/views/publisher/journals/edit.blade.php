@extends('publisher.layouts.app')
@section('title', 'Edit Jurnal')

@section('content')
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                Edit Jurnal / Karya Ilmiah
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Perbarui informasi jurnal yang telah Anda upload ke sistem repositori.
            </p>
        </div>

        <a href="{{ route('publisher.journals.index') }}" class="inline-flex items-center text-gray-800 dark:text-gray-200 text-sm font-normal px-2 py-1 hover:text-blue-700 dark:hover:text-blue-400 transition">    
            <span class="material-icons mr-2 px-1.5 py-1.5 text-white rounded-full border border-blue-700 dark:border-blue-500 
            bg-blue-700 dark:bg-blue-600 hover:bg-white hover:text-blue-600 dark:hover:bg-gray-800
            dark:hover:text-blue-400 !text-[20px] transition">east</span>
        </a>
    </div>

    {{-- Alert --}}
    @if (session('error'))
        <div
            class="mb-5 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-800 dark:bg-red-900/30 dark:text-red-300">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div
            class="mb-5 rounded-lg border border-green-300 bg-green-50 px-4 py-3 text-sm text-green-700 dark:border-green-800 dark:bg-green-900/30 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('publisher.journals.update', $journal->id) }}" enctype="multipart/form-data"
        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 p-6 rounded-lg shadow space-y-5">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Judul Jurnal
            </label>
            <input type="text" name="judul" value="{{ old('judul', $journal->judul) }}"
                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800
                text-gray-800 dark:text-gray-100 px-3 py-2 text-smfocus:ring-2 focus:ring-blue-500 focus:border-blue-500
                outline-none transition" required>
        </div>

        {{-- Pengarang --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Pengarang
            </label>
            <input type="text" name="pengarang" value="{{ old('pengarang', $journal->pengarang) }}"
                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800
                text-gray-800 dark:text-gray-100 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                outline-none transition"
                required>
        </div>

        {{-- Tahun Terbit --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Tahun Terbit
            </label>
            <input type="number" name="tahun_terbit" min="1900" max="{{ date('Y') }}"
                value="{{ old('tahun_terbit', $journal->tahun_terbit) }}"
                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800
                text-gray-800 dark:text-gray-100 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                outline-none transition"
                required>
        </div>

        {{-- Abstrak --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Abstrak
            </label>
            <textarea name="abstrak" rows="4"
                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800
                text-gray-800 dark:text-gray-100 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                outline-none transition"
                required>{{ old('abstrak', $journal->abstrak) }}</textarea>
        </div>

        {{-- File PDF --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                File PDF (Opsional)
            </label>

            <input type="file" name="file_pdf" accept="application/pdf"
                class="w-full cursor-pointer rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800
                text-gray-800 dark:text-gray-100 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition 
                file:cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-blue-700">

            @if ($journal->file_path)
                <p class="text-xs text-gray-500 mt-2">
                    File saat ini:
                    <a href="{{ asset('storage/' . $journal->file_path) }}" target="_blank"
                        class="text-blue-600 hover:underline">
                        Lihat PDF
                    </a>
                </p>
            @endif
        </div>

        {{-- Button --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('publisher.journals.index') }}"
                class="px-4 py-2 text-sm font-medium
                text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600
                rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 tracking-wide transition shadow-sm">
                Batal
            </a>

            <button type="submit"
                class="px-5 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg
                hover:bg-blue-800 tracking-normal transition shadow-sm">
                Update Jurnal
            </button>
        </div>
    </form>
@endsection
