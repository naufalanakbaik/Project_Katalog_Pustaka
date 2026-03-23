<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthManualController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function loginProses(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email harus benar.',
                'password.required' => 'Password wajib diisi.',
            ]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Noitifikasi jika berhasil login
            Alert::toast('Selamat anda berhasil login', 'success')->autoClose(2000);
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'publisher') {
                return redirect()->route('publisher.dashboard');
            }

            // default user biasa
            return redirect()->route('homepage');
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        Alert::toast('Email atau password salah', 'error')->autoClose(4000);
        return back();
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerProses(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user', // PENTING
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Noitifikasi jika berhasil logout
        // Alert::toast('Selamat anda berhasil logout', 'success')->autoClose(2000);
        return redirect()->route('login');
    }
}
