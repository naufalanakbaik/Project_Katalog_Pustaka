<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        // statistik jurnal milik publisher
        $totalJournals = $user->journals()->count();

        $approvedJournals = $user->journals()
            ->where('status', 'approved')
            ->count();

        $totalDownloads = $user->journals()
            ->sum('downloads');

        return view('publisher.profile.show', compact(
            'user',
            'totalJournals',
            'approvedJournals',
            'totalDownloads'
        ));
    }

    // tampilkan form edit profile
    public function edit()
    {
        $user = Auth::user();
        return view('katalog.profile.edit', compact('user'));
    }

    // proses update profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password) ?: $user->password,
        ]);

        return redirect()->route('profile.edit')
            ->with('success', 'Profile berhasil diperbarui');
    }
}
