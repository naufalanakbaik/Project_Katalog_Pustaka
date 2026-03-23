@extends('publisher.layouts.app')
@section('title', 'Publisher Dashboard')

@section('content')

    <!-- HEADER -->
    <div class="mb-5 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                Publisher Dashboard
            </h1>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                Welcome back,
                <span class="font-medium text-gray-700 dark:text-gray-200">
                    {{ auth()->user()->name }}
                </span>
            </p>
        </div>
    </div>

    {{-- STAT CARDS --}}
    <div class="mb-7 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6">

        {{-- TOTAL JOURNALS --}}
        <div
            class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 p-6 rounded-xl shadow-sm 
            hover:shadow-md transition">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Total Journals
            </p>
            <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mt-2">
                {{ $totalJournals }}
            </h2>
        </div>

        {{-- PENDING --}}
        <div
            class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-900 p-6 rounded-xl shadow-sm">
            <p class="text-sm text-yellow-700 dark:text-yellow-300">
                Pending
            </p>
            <h2 class="text-3xl font-semibold text-yellow-800 dark:text-yellow-200 mt-2">
                {{ $pendingJournals }}
            </h2>
        </div>

        {{-- APPROVED --}}
        <div
            class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-900 p-6 rounded-xl shadow-sm">
            <p class="text-sm text-green-700 dark:text-green-300">
                Approved
            </p>
            <h2 class="text-3xl font-semibold text-green-800 dark:text-green-200 mt-2">
                {{ $approvedJournals }}
            </h2>
        </div>

        {{-- REJECTED --}}
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-900 p-6 rounded-xl shadow-sm">
            <p class="text-sm text-red-700 dark:text-red-300">
                Rejected
            </p>
            <h2 class="text-3xl font-semibold text-red-800 dark:text-red-200 mt-2">
                {{ $rejectedJournals }}
            </h2>
        </div>

        {{-- DOWNLOADS --}}
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-900 p-6 rounded-xl shadow-sm">
            <p class="text-sm text-blue-700 dark:text-blue-300">
                Total Downloads
            </p>
            <h2 class="text-3xl font-semibold text-blue-800 dark:text-blue-200 mt-2">
                {{ $totalDownloads }}
            </h2>
        </div>
    </div>

    {{-- TOP DOWNLOAD TABLE --}}
    <div class="mb-7 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg p-7 shadow-sm">

        <div class="flex items-center justify-between mb-3">
            <h2 class="font-semibold text-gray-800 dark:text-gray-200">
                Top Download Journals
            </h2>
            <span class="text-xs text-gray-400">
                Most downloaded
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                {{-- TABLE HEADER --}}
                <thead class="text-left text-gray-500 dark:text-gray-400 border-b border-gray-300 dark:border-gray-700">
                    <tr>
                        <th class="py-3 px-2 font-medium">#</th>
                        <th class="py-3 font-medium">Journal Title</th>
                        <th class="py-3 font-medium text-right">Downloads</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($topDownloads as $index => $journal)
                        <tr>
                            <td class="px-2 py-3 text-gray-500 dark:text-gray-300">
                                {{ $index + 1 }}
                            </td>
                            <td class="py-3">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="h-8 w-8 flex items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-500 text-xs">
                                        📄
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800 dark:text-gray-200">
                                            {{ $journal->judul }}
                                        </p>
                                        <p class="text-xs text-gray-400">
                                            Journal Article
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 text-right">
                                <span
                                    class="inline-flex items-center gap-1 px-3 py-2 text-xs font-medium rounded-full
                                    bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300">
                                    <span class="material-icons !text-[20px] leading-none">
                                        download
                                    </span>
                                    {{ number_format($journal->downloads) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-6 text-gray-500 dark:text-gray-400">
                                Belum ada data download
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ANALYTICS -->
    <div class="mb-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- CHART CARD -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg p-6 shadow-sm">
            <!-- HEADER -->
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                        Journal Upload Analytics
                    </h2>
                    <p class="text-xs text-gray-400 dark:text-gray-500">
                        Upload activity for the last 12 months
                    </p>
                </div>
                <span class="text-xs px-2 py-1 bg-gray-100 dark:bg-gray-800 rounded-md text-gray-500 dark:text-gray-400">
                    Last 12 months
                </span>
            </div>

            <!-- MINI STATS -->
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                    <p class="text-xs text-gray-400 dark:text-gray-500">Total Upload</p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{ $totalUploads }}
                    </p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                    <p class="text-xs text-gray-400 dark:text-gray-500">This Month</p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{ $monthUploads }}
                    </p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                    <p class="text-xs text-gray-400 dark:text-gray-500">Average</p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{ $avgUploads }}
                    </p>
                </div>
            </div>

            <!-- CHART -->
            <div class="h-[280px]">
                <canvas id="journalChart"></canvas>
            </div>
        </div>

        <!-- QUICK ACTION -->
        <div class="bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg p-6 shadow-sm">
            <h2 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
                Quick Actions
            </h2>
            <div class="space-y-3">
                {{-- UPLOAD JOURNALS --}}
                <a href="{{ route('publisher.journals.create') }}"
                    class="flex items-center gap-3 p-3 rounded-lg border dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition text-sm">
                    <span class="material-icons text-gray-500 dark:text-gray-300 !text-[24px]">
                        upload
                    </span>
                    Upload New Journal
                </a>
                {{-- DAFTAR JOURNALS --}}
                <a href="{{ route('publisher.journals.index') }}"
                    class="flex items-center gap-3 p-3 rounded-lg border dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition text-sm">
                    <span class="material-icons text-gray-500 dark:text-gray-300 !text-[24px]">
                        description
                    </span>
                    View My Journals
                </a>
                {{-- EDIT PROFILE --}}
                <a href="{{ route('publisher.profile.edit') }}"
                    class="flex items-center gap-3 p-3 rounded-lg border dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition text-sm">
                    <span class="material-icons text-gray-500 dark:text-gray-300 !text-[24px]">
                        person
                    </span>
                    Edit Profile
                </a>

                <!-- INFORMATION SECTION -->
                <div class="mt-4 space-y-3">
                    <div
                        class="flex gap-3 p-3 rounded-lg bg-blue-50 dark:bg-blue-900/30 border border-blue-100 dark:border-blue-800">
                        <span class="material-icons text-blue-600 dark:text-blue-400 !text-[20px]">
                            info
                        </span>
                        <p class="text-xs text-blue-700 dark:text-blue-300 leading-relaxed">
                            Keep your profile information up to date so that your published journals can be properly
                            identified by readers and indexed correctly.
                        </p>
                    </div>
                    <div
                        class="flex gap-3 p-3 rounded-lg bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-100 dark:border-yellow-800">
                        <span class="material-icons text-yellow-600 dark:text-yellow-400 !text-[20px]">
                            schedule
                        </span>
                        <p class="text-xs text-yellow-700 dark:text-yellow-300 leading-relaxed">
                            Submitted journals usually require a review process before being approved. Please check your
                            journal status regularly.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- TABLE JOURNALS -->
    <div class="bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg p-7 shadow-sm">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-3">
            <h2 class="font-semibold text-gray-800 dark:text-gray-200">
                Recent Journals
            </h2>
            <a href="{{ route('publisher.journals.index') }}" class="text-sm text-gray-500 hover:text-gray-800 dark:hover:text-gray-200 transition">
                View all
            </a>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full table-fixed text-sm">

                {{-- TABLE HEADER --}}
                <thead
                    class="text-left text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400 border-b border-gray-300 dark:border-gray-700">
                    <tr>
                        <th class="py-3 font-medium w-[80%]">
                            Journal
                        </th>
                        <th class="py-3 font-medium w-[20%]">
                            Status
                        </th>
                        <th class="py-3 font-medium w-[25%]">
                            Date
                        </th>
                    </tr>
                </thead>

                {{-- TABLE BODY --}}
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach ($latestJournals as $journal)
                        <tr>

                            {{-- JOURNAL TITLE --}}
                            <td class="py-3 pr-7">
                                <div class="flex items-center gap-4 min-w-0">
                                    {{-- ICON --}}
                                    <div
                                        class="h-9 w-9 flex items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-800 flex-shrink-0">
                                        <span class="material-icons text-gray-500 !text-[15px]">
                                            description
                                        </span>
                                    </div>

                                    {{-- TITLE --}}
                                    <div>
                                        <p class="font-medium text-gray-800 dark:text-gray-200 leading-snug line-clamp-2">
                                            {{ $journal->judul }}
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">
                                            Journal Article
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- STATUS --}}
                            <td>
                                @if ($journal->status == 'pending')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full
                                        bg-yellow-100 text-yellow-700
                                        dark:bg-yellow-900 dark:text-yellow-300">
                                        Pending
                                    </span>
                                @endif
                                @if ($journal->status == 'approved')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full
                                        bg-green-100 text-green-700
                                        dark:bg-green-900 dark:text-green-300">
                                        Approved
                                    </span>
                                @endif
                                @if ($journal->status == 'rejected')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full
                                        bg-red-100 text-red-700
                                        dark:bg-red-900 dark:text-red-300">
                                        Rejected
                                    </span>
                                @endif
                            </td>

                            {{-- DATE --}}
                            <td class="text-gray-500 dark:text-gray-400">
                                {{ $journal->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Js Dashboard --}}
    <script>
        const ctx = document.getElementById('journalChart').getContext('2d');
        const isDark = document.documentElement.classList.contains('dark');

        /* GRADIENT */
        const gradient = ctx.createLinearGradient(0, 0, 0, 280);
        gradient.addColorStop(0, "rgba(30, 58, 138, 0.35)");
        gradient.addColorStop(1, "rgba(30, 58, 138, 0.02)");

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Journal Uploads',
                    data: @json($totals),
                    borderColor: '#1e3a8a',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#1e3a8a',
                    pointBorderColor: '#fff'
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: isDark ? '#111827' : '#1e293b',
                        titleColor: '#fff',
                        bodyColor: '#e5e7eb',
                        padding: 10,
                        cornerRadius: 6,
                        displayColors: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: isDark ? '#9ca3af' : '#6b7280'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: isDark ?
                                'rgba(255,255,255,0.08)' :
                                'rgba(0,0,0,0.05)'
                        },
                        ticks: {
                            color: isDark ? '#9ca3af' : '#6b7280'
                        }
                    }
                }
            }
        });
    </script>

@endsection
