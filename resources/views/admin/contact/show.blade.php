@include('admin.layout.header')
<title>Detail Pesan | Pustaka Katalog</title>

<div class="flex items-center justify-between mb-4">
    <h3 class="text-2xl font-semibold text-gray-900 ml-2">Detail Pesan Masuk</h3>
    <a href="{{ route('admin.contact.index') }}"
        class="inline-flex items-center py-1.5 px-2.5 text-blue-800 rounded-full bg-blue-100 hover:bg-blue-300 hover:text-blue-950 shadow-sm transition">
        <span class="material-icons !text-xl">east</span>
    </a>
</div>

<div class="bg-white border border-gray-300 rounded-md shadow-sm w-full max-w-auto">
    <div class="px-6 py-4 border-b border-gray-300 bg-gray-50 flex items-center justify-between rounded-t-lg">
        <h3 class="text-lg font-semibold text-gray-800">
            Detail Pesan User
        </h3>
        <span
            class="inline-flex items-center gap-2 px-4 py-1.5 text-sm font-medium rounded-xl bg-blue-100 text-blue-700">
            <span class="material-icons">supervised_user_circle</span>
            {{ $contact->nama }}
        </span>
    </div>

    <div class="px-6 py-5">
        <dl class="divide-y divide-gray-200">
            <div class="flex py-3 text-gray-800">
                <dt class="w-48 font-medium">Nama</dt>
                <dd class="flex-1">{{ $contact->nama }}</dd>
            </div>
            <div class="flex py-3 text-gray-800">
                <dt class="w-48 font-medium">Email</dt>
                <dd class="flex-1">{{ $contact->email }}</dd>
            </div>
            <div class="flex py-3 text-gray-800">
                <dt class="w-48 font-medium">Pesan</dt>
                <dd class="flex-1">{{ $contact->pesan }}</dd>
            </div>
        </dl>
    </div>

    {{-- <div class="bg-white p-6 rounded-xl border mb-6">
        <h2 class="font-semibold text-gray-800">Pesan dari User</h2>

        <p class="text-sm text-gray-600 mt-1">
            {{ $contact->nama }} • {{ $contact->email }}
        </p>

        <div class="mt-4 border border-gray-200 bg-blue-50 p-4 rounded-lg">
            {{ $contact->pesan }}
        </div>
    </div> --}}

</div>

@if (!$contact->reply)
    <form action="{{ route('admin.contact.reply', $contact->id) }}" method="POST" class="mt-6">
        @csrf

        <label class="block mb-2 font-semibold text-gray-700">
            Balasan Admin
        </label>

        <textarea name="reply" rows="4" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
            placeholder="Tulis balasan untuk user..." required></textarea>

        <button type="submit" class="mt-3 px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Kirim Balasan
        </button>
    </form>
@else
    <div class="mt-6 p-4 bg-green-50 border border-green-300 rounded-lg">
        <h4 class="font-semibold text-green-700">Balasan Admin</h4>
        <p class="mt-2 text-gray-700">{{ $contact->reply }}</p>
        <p class="mt-2 text-sm text-gray-500">
            Dibalas oleh {{ $contact->admin->name ?? '-' }} •
            {{ $contact->replied_at->format('d M Y H:i') }}
        </p>
    </div>
@endif

@include('admin.layout.footer')
