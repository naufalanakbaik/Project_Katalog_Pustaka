<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PenerbitController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('cari');

        if ($query) {
            // metode bagian cari/ search
            $allPenerbit = Penerbit::when($query, function($queryBuilder) use($query){
                $queryBuilder->where('nama_penerbit', 'like', '%' . $query . '%');
            })->paginate(5);

            // paginate dengan 5 data per halaman
            $allPenerbit->appends(['cari' => $query]);
        }
        else {
            // jika tidak ada query, tampilkan semua buku
            $allPenerbit = Penerbit::latest()->paginate(5);
        }
        
        // kembalikan data penerbit ke view
        return view('admin.penerbit.index', compact('allPenerbit'));
    }

    public function create()
    {
        // create data di penerbit
        return view('admin.penerbit.create');
    }

    public function store(Request $request)
    {
        // buat validasi
        $validatedData = $request->validate([
            'nama_penerbit' => 'required|max:155',
        ]);

        // simpan data
        Penerbit::create($validatedData);

        // Noitifikasi jika berhasil menambah data
        Alert::success('Penerbit berhasil ditambahkan')->autoClose(4000);
        // redirect ke index penerbit
        return redirect()-> route('admin.penerbit.index');
    }

    public function show(Penerbit $penerbit)
    {
        // melihat/ menampilkan data penerbit
        return view('admin.penerbit.show', compact('penerbit'));
    }

    public function edit(Penerbit $penerbit)
    {
        // edit/ update data penerbit
        return view('admin.penerbit.edit', compact('penerbit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penerbit $penerbit)
    {
         // buat validasi
        $validatedData = $request->validate([
            'nama_penerbit' => 'required | max:255',
        ]);

        // update data
        $penerbit -> update($validatedData);

        // Noitifikasi jika berhasil edit data
        Alert::success('Penerbit berhasil diperbarui')->autoClose(4000);
        // redirect ke index penerbit
        return redirect()-> route('admin.penerbit.index');
    }

    public function destroy(Penerbit $penerbit)
    {
        // delete/ hapus data
        $penerbit-> delete();

        // Noitifikasi jika berhasil edit data
        Alert::success('Buku berhasil dihapus')->autoClose(4000);
        // redirect ke index penerbit
        return redirect()-> route('admin.penerbit.index');
    }
}
