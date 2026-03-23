<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Journal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'jmlKategori' => Kategori::count(),
            'jmlPenerbit' => Penerbit::count(),
            'jmlSemuaBuku' => Buku::count(),
            'jmlAnggota' => Anggota::count(),
        ];

        // ============ Kategori dengan jumlah buku ============
        $kategori = Kategori::withCount('bukus')->get();
        $namaKategori = $kategori->pluck('nama_kategori')->toArray();
        $jumlahBuku = $kategori->pluck('bukus_count')->toArray();

        // ============ Penerbit dengan jumlah buku ============
        $penerbit = Penerbit::withCount('bukus')->get();
        $namaPenerbit = $penerbit->pluck('nama_penerbit')->toArray();
        $jumlahBukuPenerbit = $penerbit->pluck('bukus_count')->toArray();

        // =========================
        // STATISTIK JURNAL (1 QUERY AGREGASI)
        // =========================
        $statJurnal = Journal::selectRaw("
            COUNT(*) as total,
            SUM(status = 'pending') as pending,
            SUM(status = 'approved') as approved,
            SUM(status = 'rejected') as rejected
        ")->first();

        // =========================
        // Approval Rate
        // =========================
        $approvalRate = $statJurnal->total > 0
            ? round(($statJurnal->approved / $statJurnal->total) * 100, 1)
            : 0;

        // =========================
        // Jurnal Disetujui Bulan Ini
        // =========================
        $approvedThisMonth = Journal::where('status', 'approved')
            ->whereMonth('approved_at', Carbon::now()->month)
            ->whereYear('approved_at', Carbon::now()->year)
            ->count();

        // =========================
        // Total Jurnal Bulan Ini (Semua Status)
        // =========================
        $journalThisMonth = Journal::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // =========================
        // Publisher Aktif
        // =========================
        $publisherAktif = Journal::distinct('user_id')->count('user_id');

        // ============================
        // DATA GRAFIK 6 BULAN TERAKHIR
        // ============================
        $months = collect();
        $journalCounts = collect();

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);

            $count = Journal::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $months->push($date->format('M'));
            $journalCounts->push($count);
        }

        // ============================
        // STATUS JURNAL
        // ============================
        $statusLabels = ['Approved', 'Rejected', 'Pending'];

        $statusCounts = [
            Journal::where('status', 'approved')->count(),
            Journal::where('status', 'rejected')->count(),
            Journal::where('status', 'pending')->count(),
        ];

        // ============================
        // JURNAL PER PUBLISHER
        // ============================
        $publisherStats = User::withCount('journals')
            ->whereHas('journals')
            ->get();

        $publisherNames = $publisherStats->pluck('name');
        $publisherJournalCounts = $publisherStats->pluck('journals_count');

        // ============================
        // JURNAL PER Bulan (Tahun Terpilih)
        // ============================
        $year = request('year', now()->year);

        $journalPerMonth = Journal::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', $year)
            ->where('status', 'approved') // penting!
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $months = [];
        $totals = [];

        for ($i = 1; $i <= 12; $i++) {
            $found = $journalPerMonth->firstWhere('month', $i);
            $months[] = date('F', mktime(0, 0, 0, $i, 1));
            $totals[] = $found ? $found->total : 0;
        }

        return view('admin.dashboard-statistik', compact(
            'data',
            'namaKategori',
            'jumlahBuku',
            'namaPenerbit',
            'jumlahBukuPenerbit',
            'statJurnal',
            'approvalRate',
            'approvedThisMonth',
            'journalThisMonth',
            'publisherAktif',
            // 'months',
            'journalCounts',
            'statusLabels',
            'statusCounts',
            'publisherNames',
            'publisherJournalCounts',
            'months',
            'totals',
            'year',
        ));
    }
}
