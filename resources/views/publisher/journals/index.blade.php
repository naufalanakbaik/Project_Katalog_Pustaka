@extends('publisher.layouts.app')
@section('title', 'Jurnal Saya')

@section('content')

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                Daftar Jurnal
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Kelola dan pantau status jurnal yang telah Anda upload.
            </p>
        </div>
        <a href="{{ route('publisher.journals.create') }}"
            class="inline-flex items-center text-blue-700 dark:text-gray-200 text-sm font-normal px-2 py-1 
            hover:text-blue-400 dark:hover:text-blue-400 transition">
            <span
                class="material-icons mr-2 px-2 py-2 text-white rounded-xl border border-blue-700 dark:border-blue-600 
                bg-blue-700 dark:bg-blue-600 hover:bg-white hover:text-blue-600 dark:hover:bg-gray-800
                dark:hover:text-blue-400 !text-[20px] transition">
                upload
            </span>
            Upload Jurnal Baru
        </a>
    </div>

    {{-- ALERT --}}
    @if (session('error'))
        <div
            class="mb-4 rounded-lg border border-red-200 bg-red-50 dark:bg-red-900/30 px-4 py-3 text-sm text-red-700 dark:text-red-300">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div
            class="mb-4 rounded-lg border border-green-200 bg-green-50 dark:bg-green-900/30 px-4 py-3 text-sm text-green-700 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-800 text-gray-800 border-b border-gray-300 dark:border-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-4 font-medium text-left">No</th>
                    <th class="px-6 py-4 font-medium text-left">Judul</th>
                    <th class="px-6 py-4 font-medium text-center">Waktu</th>
                    <th class="px-6 py-4 font-medium text-center">Status</th>
                    <th class="px-6 py-4 font-medium text-center">Aksi</th>
                    <th class="px-6 py-4 font-medium text-center">Alasan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                @forelse ($journals as $journal)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/60 transition">
                        {{-- No --}}
                        <td class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                            {{ $loop->iteration }}
                        </td>
                        {{-- Judul --}}
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 dark:text-gray-200 truncate max-w-[420px]">
                                {{ $journal->judul }}
                            </p>
                        </td>
                        {{-- Waktu --}}
                        <td class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            {{ $journal->created_at->format('d M Y H:i') }}
                        </td>
                        {{-- Status --}}
                        <td class="px-6 py-4 text-center">
                            <span
                                class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                @if ($journal->status === 'approved') bg-green-100 text-green-700 dark:bg-green-900/40
                                dark:text-green-300
                                @elseif ($journal->status === 'pending')
                                bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-300
                                @elseif ($journal->status === 'rejected')
                                bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300
                                @else
                                bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-300 @endif">
                                {{ ucfirst($journal->status) }}
                            </span>
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-6 h-full">
                                {{-- Edit --}}
                                <a href="{{ route('publisher.journals.edit', $journal->id) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium transition">
                                    Edit
                                </a>
                                {{-- Hapus --}}
                                <form action="{{ route('publisher.journals.destroy', $journal->id) }}" method="POST"
                                    class="m-0" onsubmit="return confirm('Yakin ingin menghapus jurnal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>

                        {{-- Alasan --}}
                        <td class="px-6 py-4 text-center">
                            @if ($journal->status === 'rejected')
                                <button onclick="openRejectModal(`{{ addslashes($journal->rejection_note) }}`)"
                                    class="text-xs font-medium text-blue-600 dark:text-blue-400 hover:underline">
                                    Lihat Alasan
                                </button>
                            @elseif ($journal->status === 'approved')
                                <span
                                    class="inline-flex rounded-full bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300
                                    px-3 py-1 text-xs font-semibold">
                                    Disetujui
                                </span>
                            @elseif ($journal->status === 'pending')
                                <span
                                    class="inline-flex rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-300
                                    px-3 py-1 text-xs font-semibold">
                                    Menunggu
                                </span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-14 text-left items-start justify-center text-gray-400 dark:text-gray-500">
                            <p class="text-gray-400 dark:text-gray-500 text-sm">
                                Belum ada jurnal yang diupload.
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Alasan Penolakan --}}
    <div id="rejectModal" class="fixed inset-0 z-50 hidden items-center justify-center">
        {{-- Efek overlay --}}
        <div id="rejectOverlay"
            class="absolute inset-0 bg-black/50 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        </div>

        {{-- Modal Box --}}
        <div id="rejectContent"
            class="relative w-full max-w-md bg-white dark:bg-gray-900 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 transform scale-95 opacity-0 transition-all duration-300">
            {{-- Header --}}
            <div class="flex items-center gap-4 px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                {{-- Icon --}}
                <div
                    class="flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-br from-red-500 to-red-600 shadow-md">
                    <span class="material-icons text-white !text-[20px]">
                        report_problem
                    </span>
                </div>

                <div class="flex-1">
                    <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-100">
                        Dokumen Ditolak
                    </h3>

                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Alasan mengapa dokumen tidak dapat dipublikasikan.
                    </p>
                </div>

                {{-- Close --}}
                <button onclick="closeRejectModal()"
                    class="p-1 rounded-lg text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800
                    hover:text-gray-600 dark:hover:text-gray-300 transition">
                    <span class="material-icons !text-[23px]">close</span>
                </button>
            </div>

            {{-- Content --}}
            <div id="rejectText"
                class="px-5 py-4 text-sm text-gray-700 dark:text-gray-300 leading-relaxed max-h-64 overflow-y-auto">
            </div>

            {{-- Footer --}}
            <div class="flex justify-end px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                <button onclick="closeRejectModal()"
                    class="text-xs font-medium text-red-600 dark:text-red-400 hover:underline transition">
                    Mengerti
                </button>
            </div>
        </div>
    </div>

@endsection

<script>
    function openRejectModal(note) {
        const modal = document.getElementById('rejectModal');
        const overlay = document.getElementById('rejectOverlay');
        const content = document.getElementById('rejectContent');
        const text = document.getElementById('rejectText');

        text.innerText = note;

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        setTimeout(() => {
            overlay.classList.remove('opacity-0');
            content.classList.remove('opacity-0', 'scale-95');
            content.classList.add('opacity-100', 'scale-100');
        }, 10);
    }

    function closeRejectModal() {
        const modal = document.getElementById('rejectModal');
        const overlay = document.getElementById('rejectOverlay');
        const content = document.getElementById('rejectContent');

        overlay.classList.add('opacity-0');
        content.classList.add('opacity-0', 'scale-95');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 200);
    }

    document.getElementById('rejectOverlay').addEventListener('click', closeRejectModal);

    document.addEventListener('keydown', function(e) {
        if (e.key === "Escape") {
            closeRejectModal();
        }
    });
</script>
