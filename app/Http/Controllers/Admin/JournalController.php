<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    /**
     * List semua jurnal (admin)
     */
    public function index()
    {
        $journals = Journal::with('publisher')
            ->latest()
            ->get();
        return view('admin.journals.index', compact('journals'));
    }

    /**
     * Detail jurnal
     */
    public function show(Journal $journal)
    {
        return view('admin.journals.show', compact('journal'));
    }

    /**
     * Approve jurnal
     */
    public function approve(Journal $journal)
    {
        if ($journal->status !== 'pending') {
            return back()->with('error', 'Jurnal sudah divalidasi.');
        }

        $journal->update([
            'status'       => 'approved',
            'approved_by'  => Auth::id(),
            'approved_at'  => now(),
            'rejection_note' => null,
        ]);
        return back()->with('success', 'Jurnal berhasil disetujui.');
    }

    /**
     * Reject jurnal
     */
    public function reject(Request $request, Journal $journal)
    {
        $request->validate([
            'rejection_note' => 'required|string'
        ]);

        if ($journal->status !== 'pending') {
            return back()->with('error', 'Jurnal sudah divalidasi.');
        }

        $journal->update([
            'status'         => 'rejected',
            'approved_by'    => Auth::id(),
            'approved_at'    => now(),
            'rejection_note' => $request->rejection_note,
        ]);
        return back()->with('success', 'Jurnal ditolak.');
    }
}