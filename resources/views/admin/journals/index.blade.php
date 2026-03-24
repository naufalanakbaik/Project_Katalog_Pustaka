@include('admin.layout.header')
<title>Daftar Jurnal | Pustaka Katalog</title>

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-medium text-gray-900 dark:text-gray-100"> Daftar Jurnal Publisher</h2>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Daftar jurnal yang diunggah publisher
        </p>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="mb-5 rounded-xl border border-green-200 dark:border-green-800 dark:bg-green-900/20 bg-green-50 px-5 py-4 text-sm text-green-700 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($journals as $journal)
            <div class="rounded-xl border border-gray-300 dark:bg-gray-800 bg-white p-5 shadow-sm hover:shadow-md transition">
                <div class="flex items-start justify-between gap-6">
                    {{-- Left content --}}
                    <div class="flex-1">
                        <a href="{{ route('admin.journals.show', $journal->id) }}">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 hover:text-blue-800">
                                {{ $journal->judul }}
                            </h3>
                        </a>

                        <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-gray-500 dark:text-gray-400">
                            <span>
                                Publisher :
                                <span class="font-medium text-gray-700 dark:text-gray-300">
                                    {{ $journal->publisher->name ?? '-' }}
                                </span>
                            </span>
                            <span>•</span>
                            <span>
                                📰 Tahun :
                                <span class="font-medium text-gray-700 dark:text-gray-300">
                                    {{ $journal->tahun_terbit }}
                                </span>
                            </span>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="flex items-center gap-2">
                        @if ($journal->status === 'pending')
                            <span class="h-2.5 w-2.5 rounded-full bg-yellow-400"></span>
                            <span class="text-sm font-medium text-yellow-600">Ditunda</span>
                        @elseif ($journal->status === 'approved')
                            <span class="h-2.5 w-2.5 rounded-full bg-green-500"></span>
                            <span class="text-sm font-medium text-green-600">Disetujui</span>
                        @else
                            <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>
                            <span class="text-sm font-medium text-red-600">Ditolak</span>
                        @endif
                    </div>
                </div>

                {{-- Actions --}}
                <div class="mt-4 flex flex-wrap items-center gap-3">
                    {{-- <a href="{{ route('admin.journals.show', $journal->id) }}"
                        class="inline-flex items-center gap-1 rounded-xl border border-gray-300 bg-gray-100 px-3 py-2 text-xs font-semibold text-gray-900 hover:bg-gray-200 transition uppercase">
                        <img src="{{ asset('img/icon/detail-icon.png') }}" alt="Detail" class="w-4 h-4">
                        Detail
                    </a> --}}

                    @if ($journal->status === 'pending')
                        {{-- Approve Button --}}
                        <form method="POST" action="{{ route('admin.journals.approve', $journal->id) }}">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center gap-1 px-3 py-2 rounded-lg border border-gray-300 text-xs font-normal text-gray-700 hover:bg-green-50 hover:border-green-600 hover:text-green-700 transition">
                                <img src="{{ asset('img/icon/icon-disetujui.png') }}" alt="Approve"
                                    class="w-4 h-4"style="filter: brightness(0) saturate(100%) invert(27%) sepia(9%) saturate(746%) hue-rotate(182deg) brightness(92%) contrast(87%);">
                                Setujui
                            </button>
                        </form>
                        {{-- Reject Button --}}
                        <button onclick="openRejectModal({{ $journal->id }})"
                            class="inline-flex items-center gap-1 px-3 py-2 rounded-lg border border-gray-300 text-xs font-normal text-gray-700 hover:bg-red-50 hover:border-red-600 hover:text-red-700 transition">
                            <img src="{{ asset('img/icon/icon-ditolak.png') }}" alt="Reject"
                                class="w-3.5 h-3.5"style="filter: brightness(0) saturate(100%) invert(27%) sepia(9%) saturate(746%) hue-rotate(182deg) brightness(92%) contrast(87%);">
                            Reject
                        </button>

                        {{-- Modal --}}
                        <div id="rejectModal{{ $journal->id }}"
                            class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm     
                            transition-opacity duration-300">
                            <div class="relative w-full max-w-lg mx-4 rounded-2xl bg-white shadow-2xl ring-1 ring-gray-200 overflow-hidden">
                                {{-- Header --}}
                                <div
                                    class="flex items-center justify-between border-b border-gray-100 px-6 py-4 bg-red-50">
                                    <div>
                                        <h2 class="text-lg font-semibold text-red-700">
                                            Tolak Jurnal
                                        </h2>
                                        <p class="text-xs text-red-600 mt-1">
                                            Berikan alasan yang jelas agar publisher dapat melakukan perbaikan.
                                        </p>
                                    </div>

                                    <button onclick="closeRejectModal({{ $journal->id }})"
                                        class="flex items-center justify-center w-8 h-8 rounded-full font-semibold 
                                        text-gray-500 hover:bg-red-100 hover:text-red-600 transition-colors duration-200">
                                        ✕
                                    </button>
                                </div>

                                {{-- Body --}}
                                <div class="px-6 py-5">
                                    <form method="POST" action="{{ route('admin.journals.reject', $journal->id) }}">
                                        @csrf
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Alasan Penolakan
                                        </label>
                                        <textarea name="rejection_note" rows="4"
                                            class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-red-500 focus:ring-2 focus:ring-red-200 focus:outline-none 
                                            transition resize-none"
                                            placeholder="Contoh: Format file tidak sesuai template yang ditentukan..." required>
                                        </textarea>
                                        {{-- Footer --}}
                                        <div class="mt-6 flex justify-end gap-3">
                                            <button type="button" onclick="closeRejectModal({{ $journal->id }})"
                                                class="rounded-lg border border-gray-300 px-5 py-2 text-sm font-medium 
                                                text-gray-600 hover:bg-gray-100 transition">
                                                Batal
                                            </button>
                                            <button type="submit"
                                                class="rounded-lg bg-red-600 px-5 py-2 text-sm font-semibold 
                                                text-white shadow-md hover:bg-red-700 hover:shadow-lg transition">
                                                Tolak Jurnal
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="rounded-xl border border-dashed border-gray-300 p-8 text-center text-gray-500">
                Belum ada jurnal
            </div>
        @endforelse
    </div>

<script>
    function openRejectModal(id) {
        const modal = document.getElementById(`rejectModal${id}`);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function closeRejectModal(id) {
        const modal = document.getElementById(`rejectModal${id}`);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    // Klik di luar modal untuk menutup
    document.addEventListener('click', function(e) {
        const modals = document.querySelectorAll('[id^="rejectModal"]');
        modals.forEach(modal => {
            if (!modal.contains(e.target) && !e.target.closest('button[onclick^="openRejectModal"]')) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    });
</script>

@include('admin.layout.footer')
