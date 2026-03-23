<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Contact;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Journal;
use App\Models\User;

use Illuminate\Http\Request;

class FBukuController extends Controller
{
    public function index()
    {
        $query = Buku::query();

        // FILTER KATEGORI
        if (request()->filled('kategori')) {
            $query->where('kategori_id', request('kategori'));
        }

        // FILTER PENERBIT
        if (request()->filled('penerbit')) {
            $query->where('penerbit_id', request('penerbit'));
        }

        // SEARCH
        if (request()->filled('search')) {
            $search = request('search');

            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('pengarang', 'like', "%{$search}%");
            });
        }

        $buku = $query->paginate(6)->withQueryString();

        return view('katalog.index', [
            'buku' => $buku,
            'kategori' => Kategori::all(),
            'penerbit' => Penerbit::all(),
        ]);
    }

    public function detail_buku(Buku $buku)
    {
        return view('katalog.detail-buku', compact('buku'));
    }

    public function about()
    {
        return view('katalog.about');
    }

    public function contact()
    {
        $contacts = Contact::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('katalog.contact', compact('contacts'));
    }

    // Toggle/ icon favorit buku
    public function toggleFavorit(Buku $buku)
    {
        auth()->user()->favoritBuku()->toggle($buku->id);

        return back();
    }

    // Menampilkan daftar buku favorit
    public function bukuFavorit()
    {
        $bukuFavorit = auth()->user()
            ->favoritBuku()
            ->with(['kategori', 'penerbit'])
            ->orderByPivot('created_at', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('katalog.buku-favorit', compact('bukuFavorit'));
    }

    // Katalog Jurnal dengan filter dan search
    public function journals(Request $request)
    {
        $query = Journal::where('status', 'approved');

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                    ->orWhere('pengarang', 'like', '%' . $request->search . '%')
                    ->orWhere('abstrak', 'like', '%' . $request->search . '%');
            });
        }

        // Tahun terbit
        if ($request->filled('tahun')) {
            $query->where('tahun_terbit', $request->tahun);
        }

        // Publisher
        if ($request->filled('publisher')) {
            $query->where('user_id', $request->publisher);
        }

        $journals = $query->latest()->get();

        // Data filter Tahun terbit
        $tahunList = Journal::where('status', 'approved')
            ->select('tahun_terbit')
            ->distinct()
            ->orderByDesc('tahun_terbit')
            ->pluck('tahun_terbit');

        // Data filter Publisher
        $publishers = User::whereHas('journals', function ($q) {
            $q->where('status', 'approved');
        })->get();

        return view('katalog.journals.index', compact(
            'journals',
            'tahunList',
            'publishers'
        ));
    }

    // Menampilkan halaman detail jurnal
    public function showJournal(Journal $journal)
    {
        if ($journal->status !== 'approved') {
            abort(404);
        }
        return view('katalog.journals.show', compact('journal'));
    }

    // Proses Download file jurnal
    public function downloadJournal(Journal $journal)
    {
        // tambah jumlah download
        $journal->increment('downloads');

        // lokasi file
        $path = storage_path('app/public/' . $journal->file_path);

        // kirim file ke user
        return response()->download($path);
    }
}
