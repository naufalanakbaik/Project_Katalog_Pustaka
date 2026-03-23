@extends('katalog.head-footer')
@section('title', 'Kontak')

@section('content')
    <div class="bg-white">

        <!-- HERO -->
        <section class="relative bg-blue-50 py-20">
            <div class="container mx-auto text-center px-6">
                <h1 class="text-5xl font-semibold text-blue-800 mb-8">
                    Siap Menghubungi Kami?
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Punya pertanyaan, saran, atau ingin bekerja sama?
                    Kami siap membantu dan merespons pesan Anda secepat mungkin.
                </p>
            </div>
        </section>

        <!-- CONTACT CONTENT -->
        <section class="max-w-6xl mx-auto px-6 py-20">
            <div class="grid md:grid-cols-2 gap-14">

                <!-- FORM -->
                <div class="bg-white border border-gray-400 rounded-2xl p-8 shadow-sm">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Kirim Pesan
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Isi formulir di bawah ini dan kami akan menghubungi Anda kembali.
                    </p>

                    {{-- Alert sukses --}}
                    @if (session('success'))
                        <div class="mt-4 bg-green-100 text-green-700 px-4 py-2 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="mt-8 space-y-5">
                        @csrf
                        <!-- Nama -->
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">
                                Nama
                            </label>
                            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap"
                                class="w-full rounded-lg border border-gray-200 px-4 py-2.5
                                    focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>
                        <!-- Email -->
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">
                                Email
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="email@gmail.com"
                                class="w-full rounded-lg border border-gray-200 px-4 py-2.5
                                    focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>
                        <!-- Pesan -->
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">
                                Pesan
                            </label>
                            <textarea name="pesan" rows="5" placeholder="Tulis pesan kamu di sini..."
                                class="w-full rounded-lg border border-gray-200 px-4 py-2.5
                                    focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>{{ old('pesan') }}</textarea>
                        </div>
                        {{-- Button kirim pesan --}}
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-2.5 rounded-lg
                                hover:bg-blue-700 transition font-normal">
                            Kirim Pesan
                        </button>
                    </form>
                </div>

                <!-- CONTACT INFO -->
                <div class="flex flex-col justify-center">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Informasi Kontak
                    </h2>

                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Kami selalu terbuka untuk pertanyaan, saran, maupun kerja sama.
                        Selain melalui formulir kontak, Anda dapat menghubungi kami melalui
                        berbagai saluran resmi berikut untuk mendapatkan respon yang lebih cepat
                        dan akurat.
                    </p>

                    <ul class="mt-8 space-y-5 text-gray-700">
                        <li class="flex items-center gap-4">
                            <span class="material-icons text-blue-600">email</span>
                            katalogpustaka14@gmail.com
                        </li>
                        <li class="flex items-center gap-4">
                            <span class="material-icons text-blue-600">phone</span>
                            +62 812-3456-7890
                        </li>
                        <li class="flex items-center gap-4">
                            <span class="material-icons text-blue-600">location_on</span>
                            Indonesia, Sumatra Selatan, Kota Palembang
                        </li>
                        <p class="font-medium text-gray-800">Jam Operasional</p>
                        <li class="flex items-center gap-4">
                            <span class="material-icons text-blue-600">timer</span>
                            Senin – Jumat: 08.00 – 20.00 WIB<br>
                            Sabtu & Minggu: Tutup
                        </li>
                    </ul>

                    <!-- Catatan -->
                    <div class="border border-gray-200 rounded-xl p-5 mt-8 bg-blue-50">
                        <p class="justify-center text-base text-gray-600">
                            Catatan: Mohon sertakan identitas dan keperluan Anda secara jelas
                            saat menghubungi kami agar proses tindak lanjut dapat dilakukan
                            dengan lebih efektif.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- WHY CONTACT -->
        <section class="bg-blue-50 py-20">
            <div class="max-w-6xl mx-auto px-6 ">
                <h2 class="text-2xl font-semibold text-gray-900 text-center">
                    Mengapa Menghubungi Kami?
                </h2>

                <div class="mt-10 grid md:grid-cols-3 gap-8">
                    <!-- Bantuan Akses Informasi -->
                    <div class="bg-white p-6 rounded-xl border border-gray-100">
                        <h3 class="font-semibold text-gray-900">
                            Bantuan Akses Informasi
                        </h3>
                        <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                            Kami siap membantu pengguna dalam menemukan koleksi pustaka,
                            memahami informasi katalog, serta mengatasi kendala akses
                            terhadap buku, jurnal, dan dokumen akademik yang tersedia.
                        </p>
                    </div>

                    <!-- Pengelolaan dan Pembaruan Data -->
                    <div class="bg-white p-6 rounded-xl border border-gray-100">
                        <h3 class="font-semibold text-gray-900">
                            Pengelolaan dan Pembaruan Koleksi
                        </h3>
                        <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                            Melalui halaman kontak, pengguna dapat menyampaikan saran,
                            koreksi data, atau permintaan penambahan koleksi pustaka
                            guna menjaga kelengkapan dan keakuratan informasi dalam sistem.
                        </p>
                    </div>

                    <!-- Dukungan Akademik & Kolaborasi -->
                    <div class="bg-white p-6 rounded-xl border border-gray-100">
                        <h3 class="font-semibold text-gray-900">
                            Dukungan Akademik dan Kolaborasi
                        </h3>
                        <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                            Kami terbuka terhadap kerja sama dengan mahasiswa, dosen,
                            maupun pihak terkait dalam pengembangan dan pemanfaatan
                            Web Katalog Pustaka sebagai sarana pendukung kegiatan akademik.
                        </p>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
