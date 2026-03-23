@extends('publisher.layouts.app')
@section('title', 'Dokumentasi')

@section('content')
    {{-- Header --}}
    <div class="mb-10">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100">
            Dokumentasi Sistem
        </h1>

        <p class="text-gray-500 dark:text-gray-400 mt-2 max-w-2xl">
            Panduan lengkap penggunaan Repository System untuk mengelola jurnal ilmiah,
            karya akademik, serta proses publikasi dokumen.
        </p>
    </div>


    {{-- Documentation Grid --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Upload Jurnal --}}
        <div
            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:shadow-md transition">

            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                Upload Jurnal
            </h3>

            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                Pelajari cara mengunggah jurnal ilmiah atau karya akademik ke sistem repository.
            </p>

            <ul class="text-sm text-gray-600 dark:text-gray-300 space-y-2 list-disc ml-5">
                <li>Mengisi judul jurnal</li>
                <li>Menambahkan pengarang</li>
                <li>Menulis abstrak</li>
                <li>Mengunggah file PDF</li>
            </ul>

        </div>


        {{-- Status Jurnal --}}
        <div
            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:shadow-md transition">

            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                Status Publikasi
            </h3>

            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                Sistem memiliki beberapa status untuk setiap jurnal yang diunggah.
            </p>

            <ul class="text-sm text-gray-600 dark:text-gray-300 space-y-2 list-disc ml-5">
                <li>Pending (menunggu review)</li>
                <li>Approved (telah dipublikasikan)</li>
                <li>Rejected (ditolak)</li>
            </ul>

        </div>


        {{-- Manajemen Profil --}}
        <div
            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:shadow-md transition">

            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                Manajemen Profil
            </h3>

            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                Anda dapat mengubah informasi profil pada halaman akun.
            </p>

            <ul class="text-sm text-gray-600 dark:text-gray-300 space-y-2 list-disc ml-5">
                <li>Mengubah nama</li>
                <li>Menambahkan institusi</li>
                <li>Menambahkan foto profil</li>
            </ul>

        </div>

    </div>
@endsection