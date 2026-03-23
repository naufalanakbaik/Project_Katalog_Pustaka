<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Tampilkan daftar akun user
     */
    public function index(Request $request)
    {
        // $query = $request->input('cari');

        // if ($query) {
        //     // metode bagian cari/ search
        //     $allUsers = User::when($query, function ($queryBuilder) use ($query) {
        //         $queryBuilder->where('name', 'like', '%' . $query . '%')
        //             ->orWhere('email', 'like', '%' . $query . '%')
        //             ->orWhere('role', 'like', '%' . $query . '%');
        //     })->paginate(5);

        //     // paginate dengan 5 data per halaman
        //     $allUsers->appends(['cari' => $query]);
        // } else {
        //     // jika tidak ada query, tampilkan semua buku
        //     $allUsers = User::latest()->paginate(5);
        // }

        // // kembalikan data peminjaman ke view
        // return view('admin.users.index', compact('allUsers'));

        $allUsers = User::query()

            // SEARCH (nama / email)
            ->when($request->cari, function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {
                    $sub->where('name', 'like', '%' . $request->cari . '%')
                        ->orWhere('email', 'like', '%' . $request->cari . '%');
                });
            })

            // FILTER ROLE (admin / user)
            ->when($request->role, function ($q) use ($request) {
                $q->where('role', $request->role);
            })

            ->latest()
            ->paginate(5);

        // Agar pagination tidak menghilangkan filter
        $allUsers->appends($request->all());

        return view('admin.users.index', compact('allUsers'));
    }

    /**
     * Form tambah user baru.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Simpan user baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            // 'role' => 'required|in:admin,user',
            'role' => 'required|in:admin,user,publisher',

        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Noitifikasi jika berhasil menambah data
        Alert::success('Akun berhasil ditambahkan')->autoClose(4000);
        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        // melihat/ menampilkan data akun
        return view('admin.users.show', compact('user'));
    }

    /**
     * Form edit user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update data user.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            // 'role' => 'required|in:admin,user',
            'role' => 'required|in:admin,user,publisher',

        ]);

        $data = $request->only(['name', 'email', 'role']);
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        // Update data akun
        $user->update($data);

        // Noitifikasi jika berhasil menambah data
        Alert::success('Akun berhasil diperbarui')->autoClose(4000);

        // Redirect ke halaman index anggota
        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Hapus user.
     */
    public function destroy(User $user)
    {
        // Hapus data akun
        $user->delete();

        // Noitifikasi jika berhasil menambah data
        Alert::success('Data akun berhasil dihapus')->autoClose(4000);

        // Redirect ke halaman index anggota
        return redirect()->route('admin.users.index');
    }
}
