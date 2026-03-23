<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JournalController extends Controller
{
    /**
     * Tampilkan semua jurnal milik publisher
     */
    public function index()
    {
        $journals = Journal::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('publisher.journals.index', compact('journals'));
    }

    /**
     * Form upload jurnal
     */
    public function create()
    {
        return view('publisher.journals.create');
    }

    /**
     * Simpan jurnal baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'pengarang'    => 'required|string',
            'abstrak'      => 'nullable|string',
            'tahun_terbit' => 'required|digits:4',
            'file_pdf'     => 'required|mimes:pdf|max:5120',
        ]);

        $filePath = $request->file('file_pdf')
            ->store('journals', 'public');

        Journal::create([
            'judul'        => $request->judul,
            'pengarang'    => $request->pengarang,
            'abstrak'      => $request->abstrak,
            'tahun_terbit' => $request->tahun_terbit,
            'file_path'    => $filePath,
            'user_id'      => Auth::id(),
            'status'       => 'pending',
        ]);

        return redirect()
            ->route('publisher.journals.index')
            ->with('success', 'Jurnal berhasil diunggah dan menunggu validasi admin.');
    }

    /**
     * Form edit jurnal
     */
    public function edit(Journal $journal)
    {
        $this->authorizeJournal($journal);

        return view('publisher.journals.edit', compact('journal'));
    }

    /**
     * Update jurnal
     */
    public function update(Request $request, Journal $journal)
    {
        $this->authorizeJournal($journal);

        if ($journal->status !== 'pending') {
            return redirect()
                ->route('publisher.journals.edit', $journal)
                ->with('error', 'Jurnal yang sudah disetujui / ditolak tidak bisa diubah.');
        }

        $request->validate([
            'judul'        => 'required|string|max:255',
            'pengarang'    => 'required|string',
            'abstrak'      => 'nullable|string',
            'tahun_terbit' => 'required|digits:4',
            'file_pdf'     => 'nullable|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('file_pdf')) {
            Storage::disk('public')->delete($journal->file_path);

            $journal->file_path = $request->file('file_pdf')
                ->store('journals', 'public');
        }

        $journal->update($request->only([
            'judul',
            'pengarang',
            'abstrak',
            'tahun_terbit'
        ]));

        return redirect()
            ->route('publisher.journals.index')
            ->with('success', 'Jurnal berhasil diperbarui.');
    }

    /**
     * Tampilkan detail jurnal
     */
    public function show(Journal $journal)
    {
        $journal->load('publisher', 'approver');

        return view('publisher.journals.show', compact('journal'));
    }

    /**
     * Hapus jurnal
     */
    public function destroy(Journal $journal)
    {
        $this->authorizeJournal($journal);

        if ($journal->status !== 'pending') {
            return redirect()
                ->route('publisher.journals.index')
                ->with('error', 'Jurnal yang sudah disetujui / ditolak tidak bisa dihapus.');
        }

        // Pastikan file_path ada & file memang tersimpan
        if ($journal->file_path && Storage::disk('public')->exists($journal->file_path)) {
            Storage::disk('public')->delete($journal->file_path);
        }

        $journal->delete();

        return back()->with('success', 'Jurnal dan file PDF berhasil dihapus.');
    }

    /**
     * Cegah publisher mengakses jurnal orang lain
     */
    private function authorizeJournal(Journal $journal)
    {
        if ($journal->user_id !== Auth::id()) {
            abort(403);
        }
    }

    /**
     * Tampilkan semua jurnal yang sudah disetujui (global)
     */
    public function global()
    {
        $journals = Journal::with('publisher')
            ->where('status', 'approved') // hanya jurnal yang disetujui
            ->latest()
            ->get();

        return view('publisher.journals.global', compact('journals'));
    }
}
