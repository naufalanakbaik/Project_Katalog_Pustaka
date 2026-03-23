@include('admin.layout.header')
<title>Detail Jurnal | Pustaka Katalog</title>

    {{-- Header --}}
    <div class="mb-8">
        <h2 class="text-2xl font-medium text-gray-900">Detail Jurnal</h2>
        <p class="mt-1 text-sm text-gray-500">
            Informasi lengkap jurnal yang diunggah publisher
        </p>
    </div>

    <div class="rounded-xl border border-gray-300 bg-white shadow-sm">
        {{-- Top Section --}}
        <div class="border-b border-gray-100 p-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900">
                        {{ $journal->judul }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        oleh {{ $journal->pengarang }}
                    </p>
                </div>

                {{-- Status Badge --}}
                @if ($journal->status === 'pending')
                    <span
                        class="inline-flex items-center rounded-full bg-yellow-100 px-4 py-1.5 text-xs font-semibold text-yellow-700">
                        Pending
                    </span>
                @elseif($journal->status === 'approved')
                    <span
                        class="inline-flex items-center rounded-full bg-green-100 px-4 py-1.5 text-xs font-semibold text-green-700">
                        Approved
                    </span>
                @else
                    <span
                        class="inline-flex items-center rounded-full bg-red-100 px-4 py-1.5 text-xs font-semibold text-red-700">
                        Rejected
                    </span>
                @endif
            </div>
        </div>

        {{-- Metadata --}}
        <div class="grid grid-cols-1 gap-4 border-b border-gray-100 p-6 sm:grid-cols-3">
            <div>
                <p class="text-xs uppercase tracking-wide text-gray-500">Publisher</p>
                <p class="mt-1 text-sm font-medium text-gray-800">
                    {{ $journal->publisher->name ?? '-' }}
                </p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wide text-gray-500">Tahun Terbit</p>
                <p class="mt-1 text-sm font-medium text-gray-800">
                    {{ $journal->tahun_terbit }}
                </p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wide text-gray-500">Pengarang</p>
                <p class="mt-1 text-sm font-medium text-gray-800">
                    {{ $journal->pengarang }}
                </p>
            </div>
        </div>

        {{-- Abstrak --}}
        <div class="p-6">
            <h4 class="mb-2 text-sm font-semibold text-gray-800 uppercase tracking-wide">
                Abstrak
            </h4>
            <p class="text-sm leading-relaxed text-gray-700">
                {{ $journal->abstrak }}
            </p>
        </div>

        {{-- Rejection Note --}}
        @if ($journal->status === 'rejected' && $journal->rejection_note)
            <div class="mx-6 mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="mb-1 font-semibold">Alasan Penolakan</p>
                <p>{{ $journal->rejection_note }}</p>
            </div>
        @endif

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-gray-100 bg-gray-50 px-6 py-4">

            <div class="flex flex-wrap items-center gap-3">
                {{-- Lihat PDF --}}
                <a href="{{ asset('storage/' . $journal->file_path) }}" target="_blank"
                    class="inline-flex items-center gap-1 rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white
                hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">
                    <span class="material-icons !text-base">picture_as_pdf</span>
                    Lihat PDF
                </a>

                {{-- Kembali --}}
                <a href="{{ route('admin.journals.index') }}"
                    class="inline-flex items-center gap-1 rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700
                hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition">
                Kembali
                </a>
            </div>
        </div>

    </div>

@include('admin.layout.footer')
