@extends('katalog.head-footer')
@section('title', 'Tentang')

@section('content')
    <div class="bg-white">

        <!-- Hero Section -->
        <section class="relative bg-blue-50 py-20">
            <div class="container mx-auto text-center px-6">
                <h1 class="text-5xl font-semibold text-blue-800 mb-8">Tentang Katalog Pustaka</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Menjelajahi koleksi buku terbaik dengan mudah dan cepat, untuk memperluas wawasan dan pengetahuan Anda.
                </p>
            </div>
        </section>

        <!-- HERO -->
        <section class="max-w-6xl mx-auto px-6 py-16">
            <div class="relative overflow-hidden rounded-2xl shadow-lg">
                <!-- SLIDER TRACK -->
                <div id="sliderTrack" class="flex transition-transform duration-700 ease-in-out">
                    <img src="{{ asset('img/img-katalog/slide1.jpeg') }}"
                        class="w-full h-[320px] md:h-[420px] object-cover flex-shrink-0">
                    <img src="{{ asset('img/img-katalog/slide2.jpeg') }}"
                        class="w-full h-[320px] md:h-[420px] object-cover flex-shrink-0">
                    <img src="{{ asset('img/img-katalog/slide3.jpeg') }}"
                        class="w-full h-[320px] md:h-[420px] object-cover flex-shrink-0">
                    <img src="{{ asset('img/img-katalog/slide4.jpeg') }}"
                        class="w-full h-[320px] md:h-[420px] object-cover flex-shrink-0">
                    <img src="{{ asset('img/img-katalog/slide5.jpeg') }}"
                        class="w-full h-[320px] md:h-[420px] object-cover flex-shrink-0">
                </div>

                <!-- OVERLAY TEXT -->
                <div class="absolute inset-0 bg-black/40 flex items-center justify-center text-center px-6">
                    <div>
                        <h1 class="text-3xl md:text-5xl font-bold text-white">
                            Tentang Kami
                        </h1>
                        <p class="mt-4 text-gray-200 max-w-2xl mx-auto">
                            Tempat belajar dan berkembang di dunia web development modern
                        </p>
                    </div>
                </div>

                <!-- DOTS -->
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-3">
                    <button class="dot w-2.5 h-2.5 rounded-full bg-white/60"></button>
                    <button class="dot w-2.5 h-2.5 rounded-full bg-white/40"></button>
                    <button class="dot w-2.5 h-2.5 rounded-full bg-white/40"></button>
                    <button class="dot w-2.5 h-2.5 rounded-full bg-white/40"></button>
                    <button class="dot w-2.5 h-2.5 rounded-full bg-white/40"></button>
                </div>
            </div>
        </section>

        <!-- VALUES -->
        <section class="bg-blue-50 py-20">
            <div class="max-w-6xl mx-auto px-6">
                <h2 class="text-2xl font-semibold text-gray-900 text-center">
                    Nilai yang Kami Pegang
                </h2>

                <div class="mt-10 grid md:grid-cols-3 gap-8">
                    <!-- Aksesibilitas -->
                    <div class="bg-white p-6 rounded-xl border border-gray-100">
                        <h3 class="font-semibold text-gray-900">Aksesibilitas Informasi</h3>
                        <p class="mt-2 text-gray-600 text-sm leading-relaxed">
                            Web Katalog Pustaka dirancang untuk memudahkan sivitas akademika
                            dalam menemukan dan mengakses informasi koleksi buku, laporan
                            tugas akhir, jurnal, dan materi pendukung pembelajaran secara
                            cepat, terstruktur, dan dapat diakses kapan saja.
                        </p>
                    </div>

                    <!-- Akurasi Data -->
                    <div class="bg-white p-6 rounded-xl border border-gray-100">
                        <h3 class="font-semibold text-gray-900">Akurasi dan Keteraturan Data</h3>
                        <p class="mt-2 text-gray-600 text-sm leading-relaxed">
                            Setiap data pustaka dikelola secara sistematis dan terverifikasi,
                            mencakup informasi judul, penulis, tahun terbit, serta kategori
                            koleksi, sehingga meminimalkan kesalahan data dan meningkatkan
                            keandalan sistem sebagai sumber referensi akademik.
                        </p>
                    </div>

                    <!-- Dukungan Akademik -->
                    <div class="bg-white p-6 rounded-xl border border-gray-100">
                        <h3 class="font-semibold text-gray-900">Dukungan Kegiatan Akademik</h3>
                        <p class="mt-2 text-gray-600 text-sm leading-relaxed">
                            Sistem ini dikembangkan sebagai sarana pendukung kegiatan belajar
                            mengajar dan penelitian, dengan menyediakan katalog pustaka digital
                            yang relevan dan terintegrasi untuk membantu mahasiswa dan dosen
                            dalam memperoleh referensi yang dibutuhkan.
                        </p>
                    </div>
                </div>
            </div>

        </section>

    </div>

    <script>
        const track = document.getElementById('sliderTrack');
        const dots = document.querySelectorAll('.dot');
        let index = 0;
        const total = dots.length;

        function updateSlider() {
            track.style.transform = `translateX(-${index * 100}%)`;
            dots.forEach((dot, i) => {
                dot.classList.toggle('bg-white/60', i === index);
                dot.classList.toggle('bg-white/40', i !== index);
            });
        }

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                index = i;
                updateSlider();
            });
        });

        setInterval(() => {
            index = (index + 1) % total;
            updateSlider();
        }, 5000);
    </script>

@endsection
