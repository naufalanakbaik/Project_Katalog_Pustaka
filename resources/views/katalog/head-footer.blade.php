<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <!-- Material Icon -->
    <title>@yield('title', 'Beranda') | Katalog Pustaka</title>
    <!-- Logo Web -->
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/logo-katalog_pustaka.png') }}">
    <!-- Material Icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons" />
    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs" defer></script>
    {{-- Style X-Cloak untuk menyembunyikan elemen saat menggunakan Alpine.js --}}
    <style>
        html {
            overflow-x: hidden;
        }

        /* hidden select option kategori & penerbit */
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="flex flex-col min-h-[100svh]">

{{-- (Layout Reflow akibat Scroll Restoration) Mencegah browser mengembalikan posisi scroll saat reload atau berpindah halaman--}}
<script>
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }
</script>

    {{-- Header Bar --}}
    <div class="w-full bg-gray-50 border-b border-gray-200 text-xs text-gray-600">
        <div class="max-w-6xl mx-auto px-4 py-2 flex justify-between items-center">
            <!-- Kiri -->
            <div class="flex items-center gap-2">
                <span class="material-icons !text-[20px] text-gray-500">info</span>
                <span>
                    Selamat datang di <span class="font-medium text-gray-800">Katalog Pustaka</span>
                </span>
            </div>

            <!-- Kanan -->
            <div class="flex items-center gap-4">
                @auth
                    <span class="hidden sm:block">
                        {{ Auth::user()->name }}
                    </span>
                    <span class="text-gray-400">|</span>
                    <span class="text-gray-500">
                        {{ now()->format('d M Y') }}
                    </span>
                @endauth
            </div>

        </div>
    </div>

    {{-- Header Navbar --}}
    <nav class="sticky top-0 z-50 bg-white backdrop-blur-md text-gray-700 shadow-sm">

        <div class="max-w-6xl mx-auto flex justify-between items-center h-16 px-4">
            <!-- Logo -->
            <a href="{{ route('homepage') }}" class="flex items-center space-x-2">
                <img src="{{ asset('img/katalog-pustaka2.png') }}" alt="Logo" class="h-9 w-auto object-contain" />
            </a>

            <!-- Menu Desktop -->
            <div class="hidden md:flex space-x-8 items-center text-[15px]">
                <a href="{{ route('homepage') }}"
                    class="{{ request()->routeIs('homepage') ? 'text-blue-800 font-normal' : 'text-gray-900 hover:text-blue-800 font-normal transition' }}">
                    Beranda
                </a>
                <a href="{{ route('journals.index') }}"
                    class="{{ request()->routeIs('journals.index') ? 'text-blue-800 font-normal' : 'text-gray-900 hover:text-blue-800 font-normal transition' }}">
                    Jurnal
                </a>

                <a href="{{ route('about') }}"
                    class="{{ request()->routeIs('about') ? 'text-blue-800 font-normal' : 'text-gray-900 hover:text-blue-800 font-normal transition' }}">
                    Tentang
                </a>

                <a href="{{ route('contact') }}"
                    class="{{ request()->routeIs('contact') ? 'text-blue-800 font-normal' : 'text-gray-900 hover:text-blue-800 font-normal transition' }}">
                    Kontak
                </a>

                <a href="{{ route('buku.favorit.index') }}"
                    class="{{ request()->routeIs('buku.favorit.index') ? 'text-blue-800 font-normal' : 'text-gray-900 hover:text-blue-800 font-normal transition' }}">
                    Favorit
                </a>

                <!-- Notification Bell -->
                @auth
                    <div class="relative">
                        <!-- Icon Bell -->
                        <button id="notifBtn" class="relative focus:outline-none mt-1.5">
                            <span class="material-icons !text-[21px] text-gray-500 hover:text-blue-700 transition">
                                notifications
                            </span>

                            <!-- Badge -->
                            @if (auth()->user()->unreadNotifications->count())
                                <span
                                    class="absolute -top-1 -right-1 bg-red-600 text-white text-[11px] min-w-[18px] h-[18px] px-1 flex items-center justify-center rounded-full font-medium leading-none">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>
                        <!-- Dropdown Notifikasi -->
                        <div id="notifDropdown"
                            class="hidden absolute right-2 mt-2 w-80 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden z-50">

                            <div class="px-4 py-2 font-semibold text-gray-700 border-b bg-gray-50">
                                Notifikasi
                            </div>

                            @forelse(auth()->user()->unreadNotifications as $notif)
                                <a href="{{ route('notification.read', $notif->id) }}"
                                    class="flex justify-center items-center gap-3 px-4 py-4 text-sm text-gray-700 hover:bg-gray-100 transition">
                                    <div class="leading-snug text-left">
                                        <!-- Pesan utama -->
                                        <div class="font-medium text-gray-800">
                                            {{ $notif->data['message'] }}
                                        </div>
                                        <!-- Pesan singkat / preview -->
                                        <div class="text-xs text-gray-500 mt-0.5">
                                            {{ $notif->data['preview'] ?? 'Admin telah membalas pesan Anda.' }}
                                        </div>
                                        <!-- Waktu -->
                                        <div class="text-[10px] text-gray-400 mt-1">
                                            {{ $notif->created_at->format('d M Y H:i') }}-
                                            {{ $notif->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="px-4 py-4 text-sm text-gray-500 text-center">
                                    Tidak ada notifikasi baru
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endauth

                <!-- Dropdown Menu -->
                <div class="relative">
                    <button id="menuDropdownBtn"
                        class="flex items-center text-gray-600 hover:text-blue-600 transition-colors duration-200">
                        <span class="material-icons text-lg">arrow_drop_down</span>
                    </button>

                    <div id="menuDropdown"
                        class="absolute right-0 mt-2 w-60 bg-white rounded-xl shadow-2xl border border-gray-100 hidden overflow-hidden z-50">

                        <!-- User Info -->
                        <div class="px-5 py-4 bg-gray-300 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <div
                                    class="h-9 w-9 rounded-full bg-pink-500 text-white flex items-center justify-center
                                        font-medium text-xs ring-2 ring-pink-300 shadow-sm">
                                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <span class="block font-semibold text-gray-900 text-sm truncate">
                                        {{ Auth::user()->name }}
                                    </span>
                                    <span class="block text-xs text-blue-800">
                                        {{ Auth::user()->email }}
                                    </span>
                                    {{-- <span class="block text-xs text-blue-800">
                                        {{ Auth::user()->role === 'admin' ? 'Administrator' : 'User' }}
                                    </span> --}}
                                </div>
                            </div>
                        </div>
                        <!-- Menu -->
                        <div class="py-1">

                            <a href="{{ route('replycontact.index') }}"
                                class="group flex items-center gap-3 px-7 py-3 text-gray-700 hover:bg-blue-50 transition-all">
                                <span class="material-icons text-sm text-gray-500 group-hover:text-blue-700 transition">
                                    outgoing_mail
                                </span>
                                <span class="text-sm">Balasan Kontak</span>
                            </a>

                            <a href="{{ route('profile.edit') }}"
                                class="group flex items-center gap-3 px-7 py-3 text-gray-700 hover:bg-blue-50 transition-all">
                                <span class="material-icons text-sm text-gray-500 group-hover:text-blue-700 transition">
                                    manage_accounts
                                </span>
                                <span class="text-sm">Profile Saya</span>
                            </a>

                            <!-- Divider -->
                            <div class="my-1 border-t border-gray-100"></div>

                            <!-- Fullscreen -->
                            <button id="fullscreenBtn"
                                class="group w-full flex items-center gap-3 px-7 py-2.5 text-gray-700 hover:bg-blue-50 transition-all">
                                <span id="fullscreenIcon"
                                    class="material-icons text-sm text-gray-600 group-hover:text-blue-700 transition">
                                    fullscreen
                                </span>
                                <span id="fullscreenText" class="text-sm">Fullscreen</span>
                            </button>

                        </div>
                        <!-- Logout -->
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center px-5 py-3 bg-red-50 text-red-600 hover:bg-red-100 transition border-t border-gray-100">
                                <span class="material-icons mr-1 !text-[20px]">logout</span>
                                <span class="text-xs font-semibold uppercase tracking-wide">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- Hamburger Button (Mobile) -->
            <button id="menuBtn" class="md:hidden">
                <span class="material-icons text-gray-800 mt-1">menu</span>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-200 shadow-lg">
            <div class="flex flex-col space-y-2 p-4">
                <a href="{{ route('homepage') }}"
                    class="block px-3 py-2 rounded-md text-gray-800 hover:bg-blue-50 hover:text-blue-700 font-normal">
                    Beranda
                </a>
                <a href="{{ route('about') }}"
                    class="block px-3 py-2 rounded-md text-gray-800 hover:bg-blue-50 hover:text-blue-700 font-normal">
                    Tentang
                </a>
                <a href="{{ route('contact') }}"
                    class="block px-3 py-2 rounded-md text-gray-800 hover:bg-blue-50 hover:text-blue-700 font-normal">
                    Kontak
                </a>
                <a href="{{ route('buku.favorit.index') }}"
                    class="block px-3 py-2 rounded-md text-gray-800 hover:bg-blue-50 hover:text-blue-700 font-normal">
                    Buku Favorit
                </a>
                <a href="{{ route('replycontact.index') }}"
                    class="block px-3 py-2 rounded-md text-gray-800 hover:bg-blue-50 hover:text-blue-700 font-normal">
                    Balasan Kontak
                </a>
                <a href="{{ route('profile.edit') }}"
                    class="block px-3 py-2 rounded-md text-gray-800 hover:bg-blue-50 hover:text-blue-700 font-normal">
                    Profil
                </a>
                <button id="fullscreenBtnMobile"
                    class="flex items-center px-3 py-2 rounded-md text-gray-800 hover:bg-blue-50 hover:text-blue-700 transition">
                    Fullscreen
                </button>
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit"
                        class="w-full text-left block px-3 py-2 rounded-md text-gray-800 hover:bg-red-50 hover:text-red-700 font-normal">Logout</button>
                </form>

            </div>
        </div>

    </nav>

    {{-- Content Section --}}
    <main class="flex-1 bg-gray-50">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-blue-600 text-white py-8">
        <div class="max-w-6xl mx-auto px-4">
            <!-- Social Icons -->
            <div class="flex justify-center flex-wrap gap-5 mb-4">
                <a href="https://instagram.com/naufalzhdd" target="_blank"
                    class="w-10 h-10 flex items-center justify-center rounded-full
                        bg-white/10 hover:bg-white/20 hover:scale-110 transition">
                    <img src="{{ asset('img/img-footer/icon-instagram.png') }}" alt="Instagram"
                        class="w-7 h-7 invert brightness-200">
                </a>

                <a href="https://github.com/naufalanakbaik" target="_blank"
                    class="w-10 h-10 flex items-center justify-center rounded-full
                        bg-white/10 hover:bg-white/20 hover:scale-110 transition">
                    <img src="{{ asset('img/img-footer/icon-github.png') }}" alt="GitHub"
                        class="w-7 h-7 invert brightness-200">
                </a>

                <a href="mailto:nauflzhd14@gmail.com"
                    class="w-10 h-10 flex items-center justify-center rounded-full
                        bg-white/10 hover:bg-white/20 hover:scale-110 transition">
                    <img src="{{ asset('img/img-footer/icon-email.png') }}" alt="Email"
                        class="w-7 h-7 invert brightness-200">
                </a>

                <a href="/" target="_blank"
                    class="w-10 h-10 flex items-center justify-center rounded-full
                        bg-white/10 hover:bg-white/20 hover:scale-110 transition">
                    <img src="{{ asset('img/img-footer/icon-whatsapp.png') }}" alt="WhatsApp"
                        class="w-7 h-7 invert brightness-200">
                </a>
            </div>

            <!-- Copyright -->
            <p class="text-center text-medium opacity-90">
                &copy; {{ date('Y') }} Naufal Zuhdi Official
            </p>
        </div>
    </footer>

</body>

{{-- Javascript Section --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {

        /* =======================
            DROPDOWN USER MENU
        ======================= */
        const menuDropdownBtn = document.getElementById('menuDropdownBtn');
        const menuDropdown = document.getElementById('menuDropdown');

        if (menuDropdownBtn && menuDropdown) {
            menuDropdownBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                menuDropdown.classList.toggle('hidden');
            });

            window.addEventListener('click', (e) => {
                if (!menuDropdownBtn.contains(e.target) && !menuDropdown.contains(e.target)) {
                    menuDropdown.classList.add('hidden');
                }
            });
        }

        /* =======================
            DROPDOWN NOTIFIKASI
        ======================= */
        const notifBtn = document.getElementById('notifBtn');
        const notifDropdown = document.getElementById('notifDropdown');

        if (notifBtn && notifDropdown) {
            notifBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                notifDropdown.classList.toggle('hidden');
            });

            window.addEventListener('click', (e) => {
                if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
                    notifDropdown.classList.add('hidden');
                }
            });
        }

        /* =======================
            FULLSCREEN TOGGLE
        ======================= */
        const fullscreenBtn = document.getElementById('fullscreenBtn');
        const fullscreenIcon = document.getElementById('fullscreenIcon');
        const fullscreenText = document.getElementById('fullscreenText');

        if (fullscreenBtn) {
            fullscreenBtn.addEventListener('click', () => {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen();
                } else {
                    document.exitFullscreen();
                }
            });

            document.addEventListener('fullscreenchange', () => {
                if (document.fullscreenElement) {
                    fullscreenIcon.textContent = 'fullscreen_exit';
                    fullscreenText.textContent = 'Exit Fullscreen';
                } else {
                    fullscreenIcon.textContent = 'fullscreen';
                    fullscreenText.textContent = 'Fullscreen';
                }
            });
        }

        /* =======================
            MOBILE MENU
        ======================= */
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>

</html>
