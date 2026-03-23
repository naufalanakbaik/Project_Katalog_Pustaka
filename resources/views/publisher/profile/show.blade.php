@extends('publisher.layouts.app')
@section('title', 'Profil Publisher')

@section('content')
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                Profil Publisher
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Informasi profil Anda.
            </p>
        </div>
    </div>

    {{-- PROFILE CARD --}}
    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700
        rounded-xl shadow-sm p-6">
        <div class="flex items-center gap-6">

            {{-- Avatar --}}
            @if ($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}"
                    class="w-24 h-24 rounded-full object-cover border border-gray-200 dark:border-gray-700">
            @else
                <div
                    class="w-24 h-24 rounded-full bg-gray-100 dark:bg-gray-800
                    flex items-center justify-center
                    border border-gray-200 dark:border-gray-700">
                    <span class="material-icons text-gray-400 !text-[40px]">
                        person
                    </span>

                </div>
            @endif

            {{-- Info --}}
            <div class="flex-1">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                    {{ $user->name }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ $user->email }}
                </p>
                @if ($user->institution)
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $user->institution }}
                    </p>
                @endif
            </div>

            {{-- Edit Button --}}
            <a href="{{ route('publisher.profile.edit') }}"
                class="inline-flex items-center px-4 py-2 text-xs font-medium bg-gray-50 border border-gray-300 text-gray-700
                rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 transition">
                Edit profile
            </a>
        </div>

        {{-- Bio --}}
        <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-5">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                Bio
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                {{ $user->bio ?? 'Belum ada bio.' }}
            </p>
        </div>
    </div>


    {{-- STATISTICS --}}
    <div class="grid md:grid-cols-3 gap-6 mt-6">
        {{-- Total Jurnal --}}
        <div
            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700
            rounded-xl shadow-sm p-6 text-center">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Total Jurnal
            </p>
            <h3 class="text-3xl font-semibold text-gray-800 dark:text-gray-100 mt-1">
                {{ $totalJournals }}
            </h3>
        </div>

        {{-- Approved --}}
        <div
            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700
            rounded-xl shadow-sm p-6 text-center">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Jurnal Approved
            </p>
            <h3 class="text-3xl font-semibold text-green-600 mt-1">
                {{ $approvedJournals }}
            </h3>
        </div>

        {{-- Downloads --}}
        <div
            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700
            rounded-xl shadow-sm p-6 text-center">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Total Download
            </p>
            <h3 class="text-3xl font-semibold text-blue-600 mt-1">
                {{ $totalDownloads }}
            </h3>
        </div>
    </div>
@endsection
