<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Notifications\ContactReplied;
use Illuminate\Notifications\DatabaseNotification;
use RealRashid\SweetAlert\Facades\Alert;


class ContactController extends Controller
{
    /* ================= USER ================= */
    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email',
            'pesan' => 'required|string',
        ]);

        Contact::create([
            'user_id' => auth()->id(),
            'nama'    => $request->nama,
            'email'   => $request->email,
            'pesan'   => $request->pesan,
            'status'  => 'belum dibalas',
        ]);

        return back()->with('success', 'Pesan berhasil dikirim ke admin.');
    }

    // Detail pesan kontak (USER)
    public function showUserReply(Contact $contact)
    {
        // keamanan dasar
        if ($contact->user_id !== auth()->id()) {
            abort(403, 'Akses tidak diizinkan');
        }

        return view('katalog.replycontact.show', compact('contact'));
    }

    public function userReplies()
    {
        $contacts = Contact::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('katalog.replycontact.index', compact('contacts'));
    }

    public function readNotification($id)
    {
        $notification = auth()->user()
            ->notifications()
            ->findOrFail($id);

        // Tandai sudah dibaca
        $notification->markAsRead();

        // Ambil ID contact dari data notifikasi
        $contactId = $notification->data['contact_id'] ?? null;

        // Redirect ke halaman DETAIL, bukan index
        if ($contactId) {
            return redirect()->route('replycontact.show', $contactId);
        }

        // Fallback (kalau data rusak)
        return redirect()->route('replycontact.index');
    }



    /* ================= ADMIN ================= */
    public function index(Request $request)
    {
        $query = $request->input('cari');

        if ($query) {
            // metode bagian cari/ search
            $allContact = Contact::when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('nama', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%');
            })->paginate(10);

            // paginate dengan 5 data per halaman
            $allContact->appends(['cari' => $query]);
        } else {

            // jika tidak ada query, tampilkan semua buku
            $allContact = Contact::latest()->paginate(3);
        }

        // kembalikan data penerbit ke view
        return view('admin.contact.index', compact('allContact'));
    }

    public function show(Contact $contact)
    {
        if (! $contact->is_read) {
            $contact->update(['is_read' => true]);
        }

        return view('admin.contact.show', compact('contact'));
    }

    /**
     *  Menghapus data contact dari database
     */
    public function destroy(Contact $contact)
    {
        // Hapus data contact
        $contact->delete();

        // Noitifikasi jika berhasil menghapus data
        Alert::success('Contact berhasil dihapus')->autoClose(4000);

        // Redirect ke halaman index anggota dengan notifikasi
        return redirect()->route('admin.contact.index');
    }

    /**
     *  Membalas data contact dari user
     */
    public function reply(Request $request, Contact $contact)
    {
        $request->validate([
            'reply' => 'required|string'
        ]);

        $contact->update([
            'reply'       => $request->reply,
            'replied_at'  => now(),
            'replied_by'  => auth()->id(),
            'status'      => 'replied',
        ]);

        if ($contact->user) {
            $contact->user->notify(new ContactReplied($contact));
        }

        return redirect()
            ->route('admin.contact.show', $contact->id)
            ->with('success', 'Pesan berhasil dibalas');
    }
}
