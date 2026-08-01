<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class DataProdiController extends Controller
{
    public function index()
    {
        $prodi = Prodi::all();
        return view('data_prodi.index', compact('prodi'));
    }

    public function create()
    {
        return view('data_prodi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_prodi' => 'required|unique:prodi,kode_prodi',
            'nama_prodi' => 'required',
            'kuota_prodi' => 'required|integer',
        ]);

        $prodi = new Prodi();

        $prodi->kode_prodi = $request->kode_prodi;
        $prodi->nama_prodi = $request->nama_prodi;
        $prodi->kuota_prodi = $request->kuota_prodi;
        $prodi->save();

        return redirect()->route('data_prodi.index')->with('success', 'Program Studi berhasil ditambahkan.');
    }

    public function edit($id){
        $prodi = Prodi::findOrFail($id);
        return view('data_prodi.edit', compact('prodi'));
    }

    public function update(Request $request, $id)
    {
        $prodi = Prodi::findOrFail($id);

        $request->validate([
            // Validasi unique agar mengabaikan id prodi ini sendiri saat dicek ketersediaannya
            'kode_prodi' => 'required|unique:prodi,kode_prodi,' . $id . ',id_prodi',
            'nama_prodi' => 'required',
            'kuota_prodi' => 'required|integer',
        ]);

        $prodi->kode_prodi = $request->kode_prodi;
        $prodi->nama_prodi = $request->nama_prodi;
        $prodi->kuota_prodi = $request->kuota_prodi;
        $prodi->save();

        return redirect()->route('data_prodi.index')->with('success', 'Program Studi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        return redirect()->route('data_prodi.index')->with('success', 'Program Studi berhasil dihapus.');
    }

    // public function show($id)
    // {
    //     // $prodi = Prodi::findOrFail($id);
    //     // return view('data_prodi.show', compact('prodi'));
    // }
}

