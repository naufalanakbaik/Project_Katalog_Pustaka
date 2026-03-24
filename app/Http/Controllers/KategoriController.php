<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    public function index (Request $request)
    {
        $query = $request->input('cari');

        if ($query) {
            // metode bagian cari / search
            $allKategori = Kategori::when($query, function($queryBuilder) use($query){
                $queryBuilder->where('nama_kategori', 'like', '%' . $query . '%');
            })->paginate(5);

            // paginate dengan 5 data per halaman
            $allKategori->appends(['cari' => $query]);
        }
        else {
            $allKategori = Kategori::latest()->paginate(5);
        }
        
        // kembalikan data penerbit ke view
        return view('admin.kategori.index', compact('allKategori'));
    }

    public function create()
    {
        // create data di kategori
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        // buat validasi
        $validatedData = $request->validate([
            'nama_kategori' => 'required|max:155',
        ]);

        // simpan data
        Kategori::create($validatedData);

        // Noitifikasi jika berhasil menambah data
        Alert::success('Kategori berhasil ditambahkan')->autoClose(4000);
        // redirect ke index kategori
        return redirect()-> route('admin.kategori.index');
    }

    public function show(Kategori $kategori)
    {
        // melihat/ menampilkan data kategori
        return view('admin.kategori.show', compact('kategori'));

    }

    public function edit(Kategori $kategori)
    {
        // edit/ update data kategori
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
         // buat validasi
        $validatedData = $request->validate([
            'nama_kategori' => 'required | max:255',
        ]);

        // update data
        $kategori -> update($validatedData);
        
        // Noitifikasi jika berhasil edit data
        Alert::success('Kategori berhasil diperbarui')->autoClose(4000);

        // redirect ke index kategori
        return redirect()-> route('admin.kategori.index');
    }

    public function destroy(Kategori $kategori)
    {
        // delete/ hapus data
        $kategori-> delete();

        // notifikasi jika berhasil logout
        Alert::success('Kategori berhasil dihapus')->autoClose(4000);
        // redirect ke index kategori
        return redirect()-> route('admin.kategori.index');
    }
}
