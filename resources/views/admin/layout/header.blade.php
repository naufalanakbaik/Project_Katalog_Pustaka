<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    {{-- chart js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- web icon --}}
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/logo-katalog_pustaka.png') }}">

    {{-- material icon --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons" />

    {{-- alpine.js dropdown sidebar --}}
    <script src="https://unpkg.com/alpinejs" defer></script>

    {{-- Style CSS Sidebar --}}
    <style>
        /* dropdown sidebar */
        [x-cloak] {
            display: none !important;
        }

        #sidebar {
            transition: width 0.25s ease;
        }

        #sidebar.minimized {
            overflow: visible;
        }

        /* sembunyikan text menu */
        #sidebar.minimized .menu-text {
            opacity: 0;
            visibility: hidden;
            width: 0;
        }

        /* sembunyikan submenu */
        #sidebar.minimized .submenu {
            display: none !important;
        }

        /* pusatkan icon saat minimize */
        #sidebar.minimized a,
        #sidebar.minimized .menu-item {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        /* icon tetap stabil */
        #sidebar img,
        #sidebar .material-icons {
            flex-shrink: 0;
        }

        #sidebar a {
            transition:
                background-color .15s ease,
                color .15s ease,
                transform .12s ease;
        }

        /* hover effect lebih smooth */
        #sidebar a:hover {
            transform: translateX(2px);
        }

        /* saat minimized jangan geser */
        #sidebar.minimized a:hover {
            transform: none;
        }

        .submenu {
            transition:
                opacity .15s ease,
                transform .15s ease;
        }

        .submenu.popover {
            position: absolute !important;
            left: 100% !important;
            top: 0 !important;
            margin-left: 10px !important;
            width: 220px;
            background: white;
            border-radius: 10px;
            padding: 8px;
            box-shadow:
                0 8px 20px rgba(0, 0, 0, 0.06),
                0 2px 6px rgba(0, 0, 0, 0.05);
            z-index: 9999;
            animation: sidebarPopover .15s ease;
        }

        @keyframes sidebarPopover {
            from {
                opacity: 0;
                transform: translateX(-5px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>

<body class="bg-gray-200">
    <div class="flex h-screen">
        <aside id="sidebar"
            class="fixed top-0 left-0 h-screen w-64 bg-white 
            flex flex-col border-r border-gray-200 transition-all duration-300 overflow-hidden">

            {{-- Head admin  Tombol Minimize --}}
            <div class="p-4 flex justify-center items-center bg-white text-gray-900 border-b border-gray-200">
                <span id="sidebar-title" class="text-base text-gray-900 font-medium mr-3">Halaman Admin</span>
                <button id="toggleSidebar"
                    class="flex items-center justify-center w-10 h-10 rounded-2xl hover:text-blue-400 transition-colors">
                    <span id="toggleIcon" class="material-icons text-gray-900 !text-[20px] hover:text-blue-700">
                        keyboard_arrow_left
                    </span>
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto">
                <ul class="space-y-1 p-5 ">

                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center py-[0.430rem] px-4 rounded-lg transition
                            {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700 text-white' : 'hover:bg-gray-100 text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/dashboard.png') }}"
                                class="w-5 h-5
                                {{ request()->routeIs('admin.dashboard') ? 'brightness-0 invert' : '' }}"
                                alt="Dashboard Icon">
                            <span class="ml-2 menu-text">Dashboard</span>
                        </a>
                    </li>

                    <!-- Jurnal -->
                    <li>
                        <a href="{{ route('admin.journals.index') }}"
                            class="flex items-center py-[0.430rem] px-4 rounded-lg transition
                            {{ request()->routeIs('admin.journals.index') || request()->routeIs('admin.journals.show')
                                ? 'bg-blue-700 text-white'
                                : 'hover:bg-gray-100 text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/journals.png') }}"
                                class="w-5 h-5
                                {{ request()->routeIs('admin.journals.index') || request()->routeIs('admin.journals.show')
                                    ? 'brightness-0 invert'
                                    : '' }}"
                                alt="Journals Icon">
                            <span class="ml-2 menu-text">Journals</span>
                        </a>
                    </li>

                    {{-- Kategori --}}
                    @php
                        $isKategoriActive = request()->routeIs('admin.kategori.*');
                    @endphp
                    <li>
                        <a href="{{ route('admin.kategori.index') }}"
                            class="flex items-center py-[0.430rem] px-4 rounded-lg transition
                            {{ $isKategoriActive ? 'bg-blue-700 text-white' : 'hover:bg-gray-100 text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/kategori.png') }}"
                                class="w-5 h-5 {{ $isKategoriActive ? 'brightness-0 invert' : '' }}"
                                alt="Kategori Icon">
                            <span class="ml-2 menu-text">Kategori</span>
                        </a>
                    </li>

                    <!-- Penerbit -->
                    @php
                        $isPenerbitActive = request()->routeIs('admin.penerbit.*');
                    @endphp
                    <li>
                        <a href="{{ route('admin.penerbit.index') }}"
                            class="flex items-center py-[0.430rem] px-4 rounded-lg transition
                            {{ $isPenerbitActive ? 'bg-blue-700 text-white' : 'hover:bg-gray-100 text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/penerbit.png') }}"
                                class="w-5 h-5
                                {{ $isPenerbitActive ? 'brightness-0 invert' : '' }}"
                                alt="Penerbit Icon">
                            <span class="ml-2 menu-text">Penerbit</span>
                        </a>
                    </li>

                    <!-- Buku -->
                    @php
                        $isBukuActive = request()->routeIs('admin.buku.*');
                    @endphp
                    <li>
                        <a href="{{ route('admin.buku.index') }}"
                            class="flex items-center py-[0.430rem] px-4 rounded-lg transition
                            {{ $isBukuActive ? 'bg-blue-700 text-white' : 'hover:bg-gray-100 text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/buku.png') }}"
                                class="w-5 h-5
                                {{ $isBukuActive ? 'brightness-0 invert' : '' }}"
                                alt="Buku Icon">
                            <span class="ml-2 menu-text">Buku</span>
                        </a>
                    </li>

                    <!-- Peminjaman -->
                    @php
                        $isPeminjamanActive = request()->routeIs('admin.peminjaman.*');
                    @endphp
                    <li>
                        <a href="{{ route('admin.peminjaman.index') }}"
                            class="flex items-center py-[0.430rem] px-4 rounded-lg transition
                            {{ $isPeminjamanActive ? 'bg-blue-700 text-white' : 'hover:bg-gray-100 text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/peminjaman.png') }}"
                                class="w-5 h-5
                                {{ $isPeminjamanActive ? 'brightness-0 invert' : '' }}"
                                alt="Peminjaman Icon">
                            <span class="ml-2 menu-text">Peminjaman</span>
                        </a>
                    </li>

                    <!-- Akun -->
                    @php
                        $isAkunActive = request()->routeIs('admin.users.*');
                    @endphp
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                            class="flex items-center py-[0.430rem] px-4 rounded-lg transition
                            {{ $isAkunActive ? 'bg-blue-700 text-white' : 'hover:bg-gray-100 text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/akun.png') }}"
                                class="w-5 h-5
                                {{ $isAkunActive ? 'brightness-0 invert' : '' }}"
                                alt="Akun Icon">
                            <span class="ml-2 menu-text">Akun</span>
                        </a>
                    </li>

                    <!-- Anggota -->
                    @php
                        $isAnggotaActive = request()->routeIs('admin.anggota.*');
                    @endphp
                    <li>
                        <a href="{{ route('admin.anggota.index') }}"
                            class="flex items-center py-[0.430rem] px-4 rounded-lg transition
                            {{ $isAnggotaActive ? 'bg-blue-700 text-white' : 'hover:bg-gray-100 text-gray-900' }}">
                            <img src="{{ asset('img/icon-sidebar/anggota.png') }}"
                                class="w-5 h-5
                                {{ $isAnggotaActive ? 'brightness-0 invert' : '' }}"
                                alt="Anggota Icon">
                            <span class="ml-2 menu-text">Anggota</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Footer Sidebar -->
            <div class="border-t border-gray-200 p-4">
                <div class="flex items-center gap-2.5 ">
                    <div class="w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="material-icons text-gray-600 text-[20px]">
                            person
                        </span>
                    </div>

                    <div class="menu-text">
                        <p class="text-sm font-medium text-gray-800">
                            {{ Auth::user()->name ?? 'Admin' }}
                        </p>
                        <p class="text-xs text-gray-500">
                            Administrator
                        </p>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Header katalog dan logout --}}
        <div id="mainContent" class="flex-1 flex flex-col ml-64 transition-all duration-300">
            <header class=" bg-white shadow flex items-center justify-between p-4">

                {{-- Head Right Logo --}}
                <img src="{{ asset('img/katalog-pustaka2.png') }}" alt="Logo Katalog Pustaka" class="h-10 w-auto ml-3">

                {{-- Head Left --}}
                <div class="flex items-center space-x-4 mr-2">

                    {{-- Notifikasi --}}
                    <div class="relative">
                        {{-- ICON --}}
                        <button id="notifBtn"
                            class="relative flex items-center justify-center w-10 h-10 rounded-full hover:bg-blue-50 transition focus:outline-none">

                            {{-- <span class="material-icons text-gray-700 !text-[22px]">
                                notifications
                            </span> --}}
                            <img src="{{ asset('img/icon/notif-icon.png') }}" alt="Notifikasi"
                                class="w-[22px] h-[22px] object-contain">

                            @if ($unreadMessages > 0)
                                <span
                                    class="absolute -top-0 -right-0 min-w-[18px] h-[18px] bg-red-600 text-white
                                text-[10px] font-semibold flex items-center justify-center rounded-full">
                                    {{ $unreadMessages }}
                                </span>
                            @endif
                        </button>

                        {{-- DROPDOWN LIST PESAN MASUK --}}
                        <div id="notifDropdown"
                            class="hidden absolute right-0 mt-2 w-80 bg-white border border-gray-200
                                rounded-xl shadow-lg z-50 overflow-hidden">

                            {{-- HEADER --}}
                            <div class="flex items-center px-4 py-3 border-b border-gray-100">
                                <img src="{{ asset('img/icon-dropdown/contact.png') }}" alt="Pesan Masuk"
                                    class="w-6 h-6 mr-2 object-contain">

                                <span class="text-sm font-semibold text-gray-800 tracking-wide">
                                    Pesan Masuk
                                </span>
                            </div>

                            {{-- LIST PESAN MASUK --}}
                            <div class="max-h-72 overflow-y-auto">
                                @forelse ($latestMessages as $msg)
                                    <a href="{{ route('admin.contact.show', $msg->id) }}"
                                        class="block px-4 py-3 hover:bg-blue-50 transition">

                                        <div class="flex justify-between items-start">
                                            <p class="text-sm font-medium text-gray-800">
                                                {{ $msg->nama }}
                                            </p>
                                            @if (!$msg->is_read)
                                                <span class="w-2 h-2 bg-blue-600 rounded-full mt-1"></span>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-800 truncate mt-1">
                                            {{ $msg->email }}
                                        </p>
                                        <p class="text-xs text-gray-600 truncate mt-1">
                                            {{ Str::limit($msg->pesan, 50) }}
                                        </p>
                                        <p class="text-[10px] text-gray-400 mt-1">
                                            {{ $msg->created_at->format('d M Y H:i') }} -
                                            {{ $msg->created_at->diffForHumans() }}
                                        </p>
                                    </a>
                                @empty
                                    <p class="px-4 py-6 text-center text-sm text-gray-500">
                                        Tidak ada pesan masuk
                                    </p>
                                @endforelse
                            </div>
                            {{-- FOOTER --}}
                            <div class="border-t border-gray-100">
                                <a href="{{ route('admin.contact.index') }}"
                                    class="block text-center text-sm text-blue-600 py-3 hover:bg-blue-50 transition">
                                    Lihat Semua Pesan
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Dropdown Menu --}}
                    <div class="relative">
                        <button id="profileBtn" class="flex items-center focus:outline-none">
                            <img src="{{ asset('img/icon/profile-blue-icon.png') }}" alt="Profil"
                                class="w-9 h-9 rounded-full border border-gray-200">
                            <span class="ml-3 text-gray-800 font-normal text-sm">{{ Auth::user()->name }}</span>
                            <span id="profileIcon"
                                class="material-icons mt-0.5 ml-2 transform transition-transform duration-200 text-gray-600 menu-text !text-[19px]">arrow_drop_down</span>
                        </button>

                        {{-- Dropdown profil --}}
                        <div id="profileDropdown"
                            class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-sm hidden overflow-hidden z-50">
                            {{-- HEADER --}}
                            <div class="flex items-center justify-center px-4 py-3 border-b border-gray-200">
                                <span class="text-sm font-semibold text-gray-800 tracking-wide">
                                    Menu
                                </span>
                            </div>

                            {{-- Kotak pesan masuk --}}
                            @if (auth()->check() && auth()->user()->role === 'admin')
                                <a href="{{ route('admin.contact.index') }}"
                                    class="flex items-center px-5 py-2.5 text-sm text-gray-700 hover:bg-blue-50 transition">
                                    <img src="{{ asset('img/icon-dropdown/next.png') }}" alt="Pesan Masuk"
                                        class="w-5 h-5 mr-2 object-contain">
                                    <span class="font-normal text-gray-800">Kontak Pesan Masuk</span>
                                </a>
                            @endif

                            {{-- Jurnal Masuk --}}
                            @if (auth()->check() && auth()->user()->role === 'admin')
                                <a href="{{ route('admin.journals.index') }}"
                                    class="flex items-center px-5 py-2.5 text-sm text-gray-700 hover:bg-blue-50 transition">
                                    <img src="{{ asset('img/icon-dropdown/journals.png') }}" alt="Jurnal Masuk"
                                        class="w-5 h-5 mr-2 object-contain">
                                    <span class="font-normal text-gray-800">Jurnal Masuk</span>
                                </a>
                            @endif

                            {{-- Edit Profil --}}
                            @if (Auth::check())
                                <a href="{{ route('admin.users.edit', Auth::id()) }}"
                                    class="flex items-center px-5 py-2.5 text-sm text-gray-700 hover:bg-blue-50 transition">
                                    <img src="{{ asset('img/icon-dropdown/akun.png') }}" alt="Jurnal Masuk"
                                        class="w-5 h-5 mr-2 object-contain">
                                    <span class="font-normal text-gray-800">Edit Profil Saya</span> </a>
                            @endif

                            {{-- Fullscreen --}}
                            <button id="fullscreenBtn"
                                class="w-full flex items-center px-5 py-2.5 text-sm text-gray-700 hover:bg-blue-50 transition text-left"
                                title="Full Screen">
                                <span id="fullscreenIcon"
                                    class="material-icons !text-2xl mr-2 text-gray-800">fullscreen</span>
                                <span id="fullscreenText"
                                    class="font-normal text-gray-800 tracking-wide">Fullscreen</span>
                            </button>

                            {{-- Logout --}}
                            @if (Auth::check())
                                <div class="border-t border-gray-200"></div> {{-- garis pemisah atas logout --}}
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center px-4 py-3 text-xs text-gray-700 hover:bg-red-50 transition justify-center">
                                        <span class="material-icons mr-1 !text-[20px] text-red-600">logout</span>
                                        <span class="font-medium tracking-wide text-red-600 uppercase">Logout</span>
                                    </button>
                                </form>
                            @endif

                        </div>

                    </div>

                </div>

            </header>

            <!-- Script dropdown profile dan notifikasi dan fullscreen -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {

                    /* =========================
                        DROPDOWN PROFILE
                    ========================== */
                    const profileBtn = document.getElementById("profileBtn");
                    const profileDropdown = document.getElementById("profileDropdown");
                    const profileIcon = document.getElementById("profileIcon");

                    if (profileBtn && profileDropdown) {
                        profileBtn.addEventListener("click", function(e) {
                            e.stopPropagation();

                            const isHidden = profileDropdown.classList.toggle("hidden");

                            // efek rotate icon
                            if (profileIcon) {
                                profileIcon.classList.toggle("rotate-180", !isHidden);
                            }
                        });
                    }

                    /* =========================
                        DROPDOWN NOTIFIKASI
                    ========================== */
                    const notifBtn = document.getElementById("notifBtn");
                    const notifDropdown = document.getElementById("notifDropdown");

                    if (notifBtn && notifDropdown) {
                        notifBtn.addEventListener("click", function(e) {
                            e.stopPropagation();
                            notifDropdown.classList.toggle("hidden");
                        });
                    }

                    /* =========================
                        CLICK OUTSIDE (TUTUP SEMUA DROPDOWN)
                    ========================== */
                    document.addEventListener("click", function(e) {

                        if (profileBtn && profileDropdown) {
                            if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                                profileDropdown.classList.add("hidden");
                            }
                        }

                        if (notifBtn && notifDropdown) {
                            if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
                                notifDropdown.classList.add("hidden");
                            }
                        }
                    });

                    /* =========================
                        FULLSCREEN
                    ========================== */
                    const fullscreenBtn = document.getElementById("fullscreenBtn");
                    const fullscreenIcon = document.getElementById("fullscreenIcon");
                    const fullscreenText = document.getElementById("fullscreenText");

                    if (fullscreenBtn) {
                        fullscreenBtn.addEventListener("click", function() {
                            if (!document.fullscreenElement) {
                                document.documentElement.requestFullscreen?.();
                            } else {
                                document.exitFullscreen?.();
                            }
                        });
                    }

                    document.addEventListener("fullscreenchange", function() {
                        if (!fullscreenIcon || !fullscreenText) return;

                        if (document.fullscreenElement) {
                            fullscreenIcon.textContent = "fullscreen_exit";
                            fullscreenText.textContent = "Exit Fullscreen";
                        } else {
                            fullscreenIcon.textContent = "fullscreen";
                            fullscreenText.textContent = "Fullscreen";
                        }
                    });

                });
            </script>

            <!-- Script toogle minimize side bar -->
            <script>
                document.addEventListener("DOMContentLoaded", () => {

                    const toggleBtn = document.getElementById("toggleSidebar");
                    const sidebar = document.getElementById("sidebar");
                    const sidebarTitle = document.getElementById("sidebar-title");
                    const menuTexts = document.querySelectorAll(".menu-text");
                    const mainContent = document.getElementById("mainContent");
                    const toggleIcon = document.getElementById("toggleIcon");

                    if (!toggleBtn || !sidebar) return;

                    function setSidebar(minimized) {

                        if (minimized) {

                            sidebar.classList.remove("w-64");
                            sidebar.classList.add("w-20", "minimized");

                            mainContent?.classList.remove("ml-64");
                            mainContent?.classList.add("ml-20");

                            sidebarTitle?.classList.add("hidden");

                            menuTexts.forEach(text => {
                                text.classList.add("hidden");
                            });

                            if (toggleIcon) {
                                toggleIcon.innerText = "keyboard_arrow_right";
                            }

                            localStorage.setItem("sidebarMinimized", "1");

                        } else {

                            sidebar.classList.remove("w-20", "minimized");
                            sidebar.classList.add("w-64");

                            mainContent?.classList.remove("ml-20");
                            mainContent?.classList.add("ml-64");

                            sidebarTitle?.classList.remove("hidden");

                            menuTexts.forEach(text => {
                                text.classList.remove("hidden");
                            });

                            if (toggleIcon) {
                                toggleIcon.innerText = "keyboard_arrow_left";
                            }

                            localStorage.setItem("sidebarMinimized", "0");
                        }
                    }

                    const savedState = localStorage.getItem("sidebarMinimized") === "1";
                    setSidebar(savedState);

                    toggleBtn.addEventListener("click", () => {

                        const isMinimized = sidebar.classList.contains("minimized");
                        setSidebar(!isMinimized);
                    });
                });
            </script>

            {{-- main-content --}}
            <main class="flex-1 p-4">
                <div class="bg-white rounded-lg shadow-sm p-6 h-full">
