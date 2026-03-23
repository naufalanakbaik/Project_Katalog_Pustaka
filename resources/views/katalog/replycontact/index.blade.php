@extends('katalog.head-footer')

@section('title', 'Balasan Kontak Anda')

@section('content')
    <div class="max-w-6xl mx-auto mt-10 px-4 mb-10">

        {{-- Header --}}
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-1">
                Riwayat Pesan & Balasan Admin
            </h2>
            <p class="text-gray-500 mt-1">
                Berikut adalah daftar pesan yang telah Anda kirim beserta balasan dari admin.
            </p>
        </div>

        {{-- Jika tidak ada pesan --}}
        @if ($contacts->isEmpty())
            <div class="p-8 text-center bg-gray-50 border border-dashed rounded-xl">
                <p class="text-gray-500">
                    Anda belum memiliki riwayat pesan.
                </p>
            </div>
        @endif

        {{-- Daftar pesan --}}
        <div class="space-y-6">
            @foreach ($contacts as $contact)
                <div class="bg-white border rounded-xl shadow-sm">

                    {{-- Header card --}}
                    <div class="flex items-center justify-between px-6 py-4 border-b bg-gray-50 rounded-t-xl">
                        <div class="text-sm text-gray-500">
                            Pesan dikirim pada
                            <span class="font-medium text-gray-700">
                                {{ $contact->created_at->format('d M Y H:i') }}
                            </span>
                        </div>

                        {{-- Status badge --}}
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

                    {{-- Isi pesan user --}}
                    <div class="px-6 py-5">
                        <p class="text-sm text-gray-500 mb-1">Pesan Anda</p>
                        <p class="text-gray-800 leading-relaxed">
                            {{ $contact->pesan }}
                        </p>
                    </div>

                    {{-- Balasan admin --}}
                    <div class="px-6 pb-6">
                        @if ($contact->reply)
                            <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <p class="text-sm font-semibold text-blue-700 mb-1">
                                    Balasan Admin
                                </p>
                                <p class="text-gray-800 leading-relaxed">
                                    {{ $contact->reply }}
                                </p>
                                <p class="mt-2 text-xs text-gray-500">
                                    Dibalas pada {{ $contact->replied_at->format('d M Y H:i') }}
                                </p>
                            </div>
                        @else
                            <p class="mt-4 text-sm text-gray-400 italic">
                                Admin belum memberikan balasan untuk pesan ini.
                            </p>
                        @endif
                    </div>
                    <div class="px-6 pb-4 text-right">
                        <a href="{{ route('replycontact.show', $contact->id) }}"
                            class="text-sm text-blue-600 hover:underline">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
