<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Total jurnal yang diupload oleh publisher
        $totalJournals = Journal::where('user_id', $userId)->count();

        // Total jurnal berdasarkan status pending
        $pendingJournals = Journal::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();

        // Total jurnal berdasarkan status approved
        $approvedJournals = Journal::where('user_id', $userId)
            ->where('status', 'approved')
            ->count();

        // Total jurnal berdasarkan status rejected
        $rejectedJournals = Journal::where('user_id', $userId)
            ->where('status', 'rejected')
            ->count();

        // Total jurnal berdasarkan jumlah download
        $totalDownloads = Journal::where('user_id', $userId)
            ->sum('downloads');

        /*|--------------------------------------------------------------------------
        | CHART DATA (UPLOAD PER MONTH)
        |----------------------------------------------------------------------------*/
        $journalsPerMonth = Journal::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('count(*) as total')
        )
            ->where('user_id', $userId)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $months = [];
        $totals = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('M');
            $totals[] = $journalsPerMonth[$i] ?? 0;
        }

        /*|--------------------------------------------------------------------------
        | STATISTICS FOR MINI STATS
        |----------------------------------------------------------------------------*/
        $totalUploads = array_sum($totals);
        $monthUploads = $totals[now()->month - 1] ?? 0;
        $avgUploads = count($totals) ? round($totalUploads / count($totals)) : 0;

        /*|--------------------------------------------------------------------------
        | TABLE DATA - LATEST JOURNALS
        |----------------------------------------------------------------------------*/
        $latestJournals = Journal::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        /*|--------------------------------------------------------------------------
        | TABLE DATA - TOP DOWNLOADS
        |----------------------------------------------------------------------------*/
        $topDownloads = Journal::where('user_id', $userId)
            ->orderBy('downloads', 'desc')
            ->limit(5)
            ->get();

        // Kirim semua data ke view
        return view('publisher.dashboard', compact(
            'totalJournals',
            'pendingJournals',
            'approvedJournals',
            'rejectedJournals',
            'totalDownloads',

            'months',
            'totals',

            'totalUploads',
            'monthUploads',
            'avgUploads',

            'latestJournals',
            'topDownloads'
        ));
    }

    // public function notifications()
    // {
    //     $notifications = auth()->user()->notifications()->latest()->paginate(10);

    //     return view('publisher.notifications.index', compact('notifications'));
    // }
    // public function markAsRead($id)
    // {
    //     $notification = auth()->user()
    //         ->notifications()
    //         ->where('id', $id)
    //         ->first();

    //     if ($notification) {
    //         $notification->markAsRead();
    //     }

    //     return back();
    // }
    // public function markAllRead()
    // {
    //     auth()->user()->unreadNotifications->markAsRead();

    //     return back();
    // }

}