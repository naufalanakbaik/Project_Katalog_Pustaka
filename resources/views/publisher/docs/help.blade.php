@extends('publisher.layouts.app')
@section('title', 'Pusat Bantuan')

@section('content')
    {{-- Header --}}
    <div class="mb-10">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-100">
            Pusat Bantuan
        </h1>
        <p class="text-gray-500 dark:text-gray-400 mt-2">
            Temukan jawaban dari pertanyaan umum terkait penggunaan Repository System.
        </p>
    </div>

    {{-- FAQ Section --}}
    <div class="space-y-5">
        {{-- Item --}}
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-6">
            <h3 class="font-semibold text-gray-800 dark:text-gray-100 mb-2">
                Bagaimana cara mengupload jurnal?
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                Untuk mengupload jurnal, buka menu <span class="font-medium">Upload Jurnal</span> pada dashboard.
                Isi seluruh informasi jurnal seperti judul, pengarang, abstrak, dan unggah file PDF.
                Setelah itu klik tombol <span class="font-medium">Upload</span>.
            </p>
        </div>

        {{-- Item --}}
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-6">
            <h3 class="font-semibold text-gray-800 dark:text-gray-100 mb-2">
                Mengapa jurnal saya belum dipublikasikan?
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                Setiap jurnal yang diupload akan melalui proses review oleh admin atau editor.
                Selama proses ini status jurnal akan berada pada kondisi <b class="font-semibold">Pending</b>.
                Setelah disetujui maka status akan berubah menjadi <b class="font-semibold">Approved</b>.
            </p>
        </div>

        {{-- Item --}}
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-6">
            <h3 class="font-semibold text-gray-800 dark:text-gray-100 mb-2">
                Apakah saya dapat mengedit jurnal yang sudah diupload?
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                Ya. Anda dapat mengedit jurnal melalui menu <b class="font-semibold">Kelola Jurnal</b>.
                Namun jurnal yang sudah dipublikasikan biasanya tidak dapat diubah kecuali oleh admin.
            </p>
        </div>
    </div>

    {{-- Contact Section --}}
    <div class="mt-12 text-center border-t border-gray-200 dark:border-gray-700 pt-8">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Tidak menemukan jawaban yang Anda cari?
        </p>
        <a href="#" class="inline-block mt-3 text-blue-600 dark:text-blue-400 hover:underline">
            Hubungi Administrator
        </a>
    </div>
@endsection
