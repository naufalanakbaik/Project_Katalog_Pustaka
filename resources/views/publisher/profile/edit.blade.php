@extends('publisher.layouts.app')
@section('title', 'Edit Profil Publisher')

@section('content')
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                Edit Profil Publisher
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Update your personal information and profile settings.
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

    {{-- CARD --}}
    <form action="{{ route('publisher.profile.update') }}" method="POST" enctype="multipart/form-data"
        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm">

        @csrf
        <div class="p-6 space-y-6">
            {{-- PROFILE PHOTO --}}
            <div class="flex items-center gap-5">
                <div class="relative">
                    @if ($user->photo)
                        <img id="preview-image" src="{{ asset('storage/' . $user->photo) }}"
                            class="w-20 h-20 rounded-full object-cover border border-gray-300">
                    @else
                        <div id="preview-placeholder"
                            class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xl">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Change avatar
                    </label>
                    <input type="file" name="photo" id="photo-input"
                        class="text-sm text-gray-600 file:cursor-pointer file:mr-4 file:px-3 file:py-1.5 file:rounded-md 
                        file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-blue-700">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Format: JPG, PNG. Maksimal ukuran 2MB.
                    </p>
                </div>
            </div>

            {{-- GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- NAME --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Name
                    </label>
                    <input type="text" name="name" value="{{ $user->name }}"
                        class="w-full rounded-md border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300
                        bg-white dark:bg-gray-800 px-3 py-2 text-sm 
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                {{-- EMAIL --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Email
                    </label>
                    <input type="email" name="email" value="{{ $user->email }}"
                        class="w-full rounded-md border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300
                        bg-white dark:bg-gray-800 px-3 py-2 text-sm 
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                {{-- INSTITUTION --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Institution
                    </label>
                    <input type="text" name="institution" value="{{ $user->institution }}"
                        class="w-full rounded-md border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300
                        bg-white dark:bg-gray-800 px-3 py-2 text-sm 
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                {{-- BIO --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Bio
                    </label>
                    <textarea name="bio" rows="4"
                        class="w-full rounded-md border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300
                        bg-white dark:bg-gray-800 px-3 py-2 text-sm 
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 ">{{ $user->bio }}</textarea>
                </div>
            </div>
        </div>

        {{-- FOOTER --}}
        <div
            class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 rounded-b-xl">
            <a href="{{ route('publisher.profile.show') }}"
                class="px-4 py-2 text-xs font-medium text-gray-700 dark:text-gray-100 border border-gray-400 dark:border-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 tracking-wide">
                Batal
            </a>
            <button type="submit"
                class="px-4 py-2 text-xs font-medium text-white bg-blue-600 border border-blue-800 hover:bg-blue-800 shadow-sm rounded-lg tracking-wide ">
                Simpan
            </button>
        </div>
    </form>

    {{-- JS Foto profil --}}
    <script>
        const input = document.getElementById('photo-input');
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const previewUrl = URL.createObjectURL(file);
                let img = document.getElementById('preview-image');
                // Jika sebelumnya belum ada <img> (masih placeholder)
                if (!img) {
                    const placeholder = document.getElementById('preview-placeholder');
                    img = document.createElement('img');
                    img.id = 'preview-image';
                    img.className = "w-20 h-20 rounded-full object-cover border border-gray-300";
                    placeholder.replaceWith(img);
                }
                img.src = previewUrl;
            }
        });
    </script>

@endsection
