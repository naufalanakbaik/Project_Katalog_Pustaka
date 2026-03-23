<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('cari');

        if ($query) {
            // metode bagian cari
            $allBuku = Buku::when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('judul', 'like', '%' . $query . '%')
                    ->orWhere('pengarang', 'like', '%' . $query . '%')
                    ->orWhere('tahun_terbit', 'like', '%' . $query . '%');
            })->paginate(5);

            // paginate dengan 5 data per halaman
            $allBuku->appends(['cari' => $query]);
        } else {
            // jika tidak ada query, tampilkan semua buku
            $allBuku = Buku::latest()->paginate(5);
        }

        // kembalikan data penerbit ke view
        return view('admin.buku.index', compact('allBuku'));
    }

    public function create()
    {
        // create data di buku
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();
        return view('admin.buku.create', compact('penerbit', 'kategori'));
    }

    // menyimpan data buku
    public function store(Request $request)
    {
        // buat validasi
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'pengarang' => 'required|max:255',
            'tahun_terbit' => 'required|integer:4',
            'kategori_id' => 'required',
            'penerbit_id' => 'required',
            'deskripsi' => 'nullable|string',
            'file_cover' => 'nullable|image|mimes:jpeg,jpg,png|max:10240', // max 10 MB

        ]);

        // upload file cover buku
        if ($request->hasFile('file_cover')) {
            $validatedData['cover'] = $request->file('file_cover')->store('cover', 'public');
        }

        // hapus file cover array validasi
        unset($validatedData['file_cover']);

        // simpan data
        Buku::create($validatedData);

        // Noitifikasi jika berhasil menambah data
        Alert::success('Buku berhasil ditambahkan')->autoClose(4000);

        // redirect ke index buku
        return redirect()->route('admin.buku.index');
    }

    // menampilkan data berdasrakan request
    public function show(Buku $buku)
    {
        // melihat/ menampilkan data buku
        return view('admin.buku.show', compact('buku'));
    }

    // menampilkan form edit buku
    public function edit(Buku $buku)
    {
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();

        // edit/ update data buku
        return view('admin.buku.edit', compact('buku', 'penerbit', 'kategori'));
    }

    // menyimpan data yang sudah diperbarui
    public function update(Request $request, Buku $buku)
    {
        // buat validasi
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'pengarang' => 'required|max:100',
            'tahun_terbit' => 'required|integer:4',
            'kategori_id' => 'required',
            'penerbit_id' => 'required',
            'deskripsi' => 'nullable|string',
            'file_cover' => 'nullable|image|mimes:jpeg,jpg,png|max:10240', // max 10 MB
        ]);

        // upload file cover
        if ($request->hasFile('file_cover')) {
            $validatedData['cover'] = $request->file('file_cover')->store('cover', 'public');

            if ($request->cover_lama) {
                Storage::delete('public/' . $request->cover_lama);
            }
        }

        //hapus file_cover dari array validasi
        unset($validatedData['file_cover']);

        // update data
        $buku->update($validatedData);

        // Noitifikasi jika berhasil edit data
        Alert::success('Buku berhasil diperbarui')->autoClose(4000);

        // redirect ke index buku
        return redirect()->route('admin.buku.index');
    }

    // public function destroy(Buku $buku)
    // {
    //     if ($buku->cover && Storage::exists('public/' . $buku->cover)) {
    //         Storage::delete('public/' . $buku->cover);
    //     }
    //     // proses delete/ hapus data
    //     $buku->delete();

    //     // Noitifikasi jika berhasil menghapus data
    //     Alert::success('Buku berhasil dihapus')->autoClose(4000);

    //     // redirect ke index buku
    //     return redirect()->route('admin.buku.index');
    // }

    public function destroy(Buku $buku)
    {
        try {
            // Coba hapus data buku dulu
            $buku->delete();

            // Jika berhasil, baru hapus cover
            if ($buku->cover && Storage::exists('public/' . $buku->cover)) {
                Storage::delete('public/' . $buku->cover);
            }

            Alert::success('Buku berhasil dihapus')->autoClose(4000);
            return redirect()->route('admin.buku.index');
        } catch (QueryException $e) {

            Alert::error(
                'Buku tidak dapat dihapus karena masih terkikat dengan data peminjaman'
            )->autoClose(5000);

            return redirect()->route('admin.buku.index');
        }
    }
}
