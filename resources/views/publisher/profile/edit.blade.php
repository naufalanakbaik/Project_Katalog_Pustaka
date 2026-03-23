@extends('publisher.layouts.app')
@section('title', 'Edit Profil Publisher')

@section('content')
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                Edit Profil Publisher
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Perbarui informasi profil Anda.
            </p>
        </div>

        <a href="{{ route('publisher.profile.show') }}"
            class="inline-flex items-center text-gray-800 dark:text-gray-200 text-sm font-normal px-2 py-1 hover:text-blue-700 dark:hover:text-blue-400 transition">
            <span
                class="material-icons mr-2 px-1.5 py-1.5 text-white rounded-full border border-blue-700 dark:border-blue-500 
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


    <form action="{{ route('publisher.profile.update') }}" method="POST" enctype="multipart/form-data" 
        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 p-6 rounded-lg shadow space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800
                text-gray-800 dark:text-gray-100 px-3 py-2 text-smfocus:ring-2 focus:ring-blue-500 focus:border-blue-500
                outline-none transition">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800
                text-gray-800 dark:text-gray-100 px-3 py-2 text-smfocus:ring-2 focus:ring-blue-500 focus:border-blue-500
                outline-none transition">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Institusi</label>
            <input type="text" name="institution" value="{{ $user->institution }}" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800
                text-gray-800 dark:text-gray-100 px-3 py-2 text-smfocus:ring-2 focus:ring-blue-500 focus:border-blue-500
                outline-none transition">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bio</label>
            <textarea name="bio" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800
                text-gray-800 dark:text-gray-100 px-3 py-2 text-smfocus:ring-2 focus:ring-blue-500 focus:border-blue-500
                outline-none transition" rows="4">{{ $user->bio }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Foto Profil</label>

            @if ($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}" class="w-20 h-20 rounded-full mb-3">
            @endif

            <input type="file" name="photo" class="w-full cursor-pointer rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800
                text-gray-800 dark:text-gray-100 px-3 py-2 text-smfocus:ring-2 focus:ring-blue-500 focus:border-blue-500
                outline-none transition transition 
                file:cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-blue-700">
        </div>

        <button class="px-5 py-2 text-sm font-normal text-white bg-blue-600 rounded-lg
            hover:bg-blue-700 transition shadow-sm">
            Update Profil
        </button>
    </form>
@endsection
