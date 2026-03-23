<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AnggotaController extends Controller
{
    /**
     * Menampilkan semua data anggota
     */
    public function index(Request $request)
    {
        $query = $request->input('cari');

        if ($query) {
            // metode bagian cari/ search
            $allAnggota = Anggota::when($query, function($queryBuilder) use($query){
                $queryBuilder->where('nama_anggota', 'like', '%' . $query . '%')
                ->orWhere('no_telpon', 'like', '%' . $query . '%');;
            })->paginate(5);
            
            // paginate dengan 5 data per halaman
            $allAnggota->appends(['cari' => $query]);
        }
        else {
            // jika tidak ada query, tampilkan semua buku
            $allAnggota = Anggota::latest()->paginate(5);
        }
        
        // kembalikan data anggota ke view
        return view('admin.anggota.index', compact('allAnggota'));

        // $allAnggota = Anggota::all();
        // return view('anggota.index', compact('allAnggota'));
    }

    /**
     * Menampilkan form untuk membuat anggota baru
     */
    public function create()
    {
        return view('admin.anggota.create');
    }

    /**
     * Membuat data anggota baru dan menyimpannya ke database
     */
    public function store(Request $request)
    {
        // Buat VALIDASI
        $valData = $request->validate([
            'nama_anggota' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
        ]);

        // Simpan data anggota ke database
        Anggota::create($valData);

        // Noitifikasi jika berhasil menambah data
        Alert::success('Anggota berhasil ditambahkan')->autoClose(4000);

        // Redirect ke halaman index anggota
        return redirect()->route('admin.anggota.index');
    }

    /**
     * Menampilkan detail anggota tertentu
     */
    public function show(Anggota $anggota)
    {
        // Melihat/ menampilkan data anggota
        return view('admin.anggota.show', compact('anggota'));
    }

    /**
     * Menampilkan form untuk mengedit data anggota
     */
    public function edit(Anggota $anggota)
    {
        // Edit/ update data anggota
        return view('admin.anggota.edit', compact('anggota'));
    }

    /**
     * Memperbarui data anggota yang sudah ada di database
     */
    public function update(Request $request, Anggota $anggota)
    {
        // Buat validasi
        $valData = $request->validate([
            'nama_anggota' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
        ]);

        // Update data anggota
        $anggota->update($valData);

        // Noitifikasi jika berhasil menperbarui data
        Alert::success('Anggota berhasil diperbarui')->autoClose(4000);

        // Redirect ke halaman index anggota
        return redirect()->route('admin.anggota.index');
    }

    /**
     *  Menghapus data anggota dari database
     */
    public function destroy(Anggota $anggota)
    {
        // Hapus data anggota
        $anggota->delete();

        // Noitifikasi jika berhasil menghapus data
        Alert::success('Anggota berhasil dihapus')->autoClose(4000);

        // Redirect ke halaman index anggota dengan notifikasi
        return redirect()->route('admin.anggota.index');
    }
}
