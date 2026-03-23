@extends('katalog.head-footer')

@section('title', 'Detail Pesan Kontak')

@section('content')
    <div class="max-w-6xl mx-auto mt-10 px-4 mb-10">

        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">
                    Detail Pesan & Balasan
                </h2>
                <p class="text-gray-500 mt-1">
                    Detail pesan yang Anda kirim kepada admin.
                </p>
            </div>

            <a href="{{ route('replycontact.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-blue-600 rounded-lg  transition-all duration-200 group">

                <span
                    class="material-icons text-base transition-transform duration-200 group-hover:-translate-x-1">
                    arrow_back
                </span>

                Kembali ke daftar pesan
            </a>
        </div>

        <div class="bg-white border rounded-xl shadow-sm overflow-hidden">

            {{-- Header Card --}}
            <div class="flex items-center justify-between px-6 py-4 bg-gray-50 border-b">
                <div class="text-sm text-gray-500">
                    Dikirim pada
                    <span class="font-medium text-gray-700">
                        {{ $contact->created_at->format('d M Y H:i') }}
                    </span>
                </div>

                @if ($contact->reply)
                    <span class="px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                        Sudah Dibalas
                    </span>
                @else
                    <span class="px-3 py-1 text-xs font-semibold text-gray-600 bg-gray-200 rounded-full">
                        Menunggu Balasan
                    </span>
                @endif
            </div>

            {{-- Pesan User --}}
            <div class="px-6 py-5">
                <p class="text-sm text-gray-600 mb-2">
                    Pesan Anda
                </p>

                <div class="p-4 bg-gray-50 border rounded-lg text-gray-800 leading-relaxed">
                    {{ $contact->pesan }}
                </div>
            </div>

            {{-- Balasan Admin --}}
            <div class="px-6 py-5 border-t bg-gray-50">
                <p class="text-sm text-blue-700 mb-2">
                    Balasan Admin
                </p>
                @if ($contact->reply)
                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-gray-800 leading-relaxed">
                            {{ $contact->reply }}
                        </p>

                        @if ($contact->replied_at)
                            <p class="mt-2 text-xs text-gray-500">
                                Dibalas pada {{ $contact->replied_at->format('d M Y H:i') }}
                            </p>
                        @endif
                    </div>
                @else
                    <p class="mt-4 text-sm text-gray-400 italic">
                        Admin belum memberikan balasan untuk pesan ini.
                    </p>
                @endif
            </div>

        </div>
    </div>
@endsection
