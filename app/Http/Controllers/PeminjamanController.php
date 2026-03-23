<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanController extends Controller
{
    // Menampilkan semua data peminjaman
    public function index(Request $request)
    {
        $query = $request->input('cari');

        if ($query) {
            // metode bagian cari/ search
            $allPeminjaman = Peminjaman::when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->whereHas('anggota', function ($q) use ($query) {
                    $q->where('nama_anggota', 'like', '%' . $query . '%');
                });
            })->with('anggota')->paginate(5);

            // paginate dengan 5 data per halaman
            $allPeminjaman->appends(['cari' => $query]);
        } else {
            // jika tidak ada query, tampilkan semua buku
            $allPeminjaman = Peminjaman::latest()->paginate(5);
        }

        // kembalikan data peminjaman ke view
        return view('admin.peminjaman.index', compact('allPeminjaman'));

        // // Menampilkan semua data peminjaman
        // $allPeminjaman = Peminjaman::all();
        // return view('peminjaman.index', compact('allPeminjaman'));
    }

    /**
     * Menampilkan form untuk membuat peminjaman baru
     */
    public function create()
    {
        // Menampilkan form untuk membuat peminjaman baru
        $anggota = Anggota::all();
        $bukus = Buku::all();

        return view('admin.peminjaman.create', compact('anggota', 'bukus'));
    }

    /**
     * Membuat data peminjaman baru dan menyimpannya ke database
     */
    public function store(Request $request)
    {
        // Buat VALIDASI
        $valData = $request->validate([
            'tgl_peminjaman' => 'required|date',
            'anggota_id' => 'required',
            'buku_ids' => 'required|array',
            'buku_ids.*' => 'exists:bukus,id',
        ]);

        // Simpan data peminjaman
        $peminjaman = Peminjaman::create([
            'anggota_id' => $request->anggota_id,
            'tgl_peminjaman' => $request->tgl_peminjaman,
            'status_pengembalian' => 'Dipinjam',
        ]);

        // Menyimpan relasi buku dengan peminjaman
        $peminjaman->buku()->attach($request->buku_ids);

        // Noitifikasi jika berhasil menambah data
        Alert::success('Peminjaman berhasil ditambahkan')->autoClose(3000);

        // Redirect ke halaman index peminjaman
        return redirect()->route('admin.peminjaman.index');
    }

    /**
     * Menampilkan detail peminjaman tertentu
     */
    public function show($id)
    {
        // Melihat/ menampilkan data peminjaman
        $peminjaman = Peminjaman::with('anggota', 'buku')->findOrFail($id);

        // Menampilkan detail peminjaman
        return view('admin.peminjaman.show', compact('peminjaman'));
    }

    /**
     *  Menampilkan form untuk mengedit data peminjaman
     */
    public function edit(Peminjaman $peminjaman)
    {
        // $anggota = Anggota::all();
        // $bukus = Buku::all();

        // return view('peminjaman.edit', compact('anggota', 'bukus'));
    }

    /**
     *  Memperbarui data peminjaman yang sudah ada di database
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        // Validasi input
        $request->validate(['tgl_kembali' => 'date']);

        // Update data peminjaman
        $peminjaman = Peminjaman::find($peminjaman->id);

        // Update tanggal kembali dan status pengembalian
        $peminjaman->update([
            'tgl_kembali' => $request->tgl_kembali,
            'status_pengembalian' => 'Dikembalikan',
        ]);

        // Noitifikasi jika berhasil edit data
        Alert::success('Status berhasil diperbarui')->autoClose(3000);
        
        // Kembali ke halaman index peminjaman
        return redirect()->route('admin.peminjaman.index');
    }

    /**
     *  Menghapus data peminjaman dari database
     */
    public function destroy(Peminjaman $peminjaman)
    {
        // Hapus data peminjaman
        $peminjaman->delete();
        
        // Noitifikasi jika berhasil menambah data
        Alert::success('Peminjaman berhasil dihapus')->autoClose(3000);
        // Kembali ke halaman index peminjaman
        return redirect()->route('admin.peminjaman.index');
    }
}
