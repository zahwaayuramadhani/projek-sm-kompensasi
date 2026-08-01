<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash; 

class DataMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        
        $perPage = $request->get('per_page', 10);

        $mahasiswa = Mahasiswa::with(['prodi', 'user'])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nama', 'like', '%' . $keyword . '%')
                    ->orWhere('npm', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')
                    ->orWhere('kelas', 'like', '%' . $keyword . '%');
                })
                ->orWhereHas('prodi', function ($q) use ($keyword) {
                    $q->where('nama_prodi', 'like', '%' . $keyword . '%');
                })
                ->orWhereHas('user', function ($q) use ($keyword) {
                    $q->where('username', 'like', '%' . $keyword . '%');
                });
            })
            ->paginate($perPage) 
            ->withQueryString(); 

        return view('data_mhs.index', compact('mahasiswa'));
    }

    public function create()
    {
        $prodi = Prodi::all();
        return view('data_mhs.create', compact('prodi'));
    }

    public function store(Request $request)
    {
        $request->merge(['username' => $request->npm]);

        $request->validate([
            'nama'     => 'required|string|max:255',
            'npm'      => 'required|unique:mahasiswa,npm',
            'id_prodi' => 'required|exists:prodi,id_prodi',
            'kelas'    => 'required',
            'email'    => 'required|email|unique:mahasiswa,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:3|confirmed', 
        ]);

        DB::beginTransaction();

        try {
            $user = new User();
            $user->username = $request->username; 
            $user->password = Hash::make($request->password); 
            $user->level    = 2; 
            $user->save();

            $mahasiswa = new Mahasiswa();
            $mahasiswa->nama     = $request->nama;
            $mahasiswa->npm      = $request->npm;
            $mahasiswa->id_prodi = $request->id_prodi;
            $mahasiswa->kelas    = $request->kelas;
            $mahasiswa->email    = $request->email;
            $mahasiswa->id_user  = $user->id;
            $mahasiswa->save();

            DB::commit();

            return redirect()->route('data_mhs.index')->with('success', 'Mahasiswa dan Akun berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $prodi = Prodi::all();
        return view('data_mhs.edit', compact('mahasiswa', 'prodi'));
    }

    public function update(Request $request, string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = $mahasiswa->user; 

        $request->merge(['username' => $request->npm]);

        $request->validate([
            'nama'     => 'required|string|max:255',
            'npm'      => 'required|unique:mahasiswa,npm,' . $id . ',id_mahasiswa',
            'id_prodi' => 'required|exists:prodi,id_prodi',
            'kelas'    => 'required',
            'email'    => 'required|email|unique:mahasiswa,email,' . $id . ',id_mahasiswa',
            'username' => 'required|unique:users,username,' . $user->id,
            'password' => 'nullable|min:3|confirmed', 
        ]);

        DB::beginTransaction();

        try {
            $user->username = $request->username;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            $mahasiswa->nama     = $request->nama;
            $mahasiswa->npm      = $request->npm;
            $mahasiswa->id_prodi = $request->id_prodi;
            $mahasiswa->kelas    = $request->kelas;
            $mahasiswa->email    = $request->email;
            $mahasiswa->save();

            DB::commit();

            return redirect()->route('data_mhs.index')->with('success', 'Data Mahasiswa berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = $mahasiswa->user;

        DB::beginTransaction();

        try {
            // Hapus data mahasiswa
            $mahasiswa->delete();

            // Hapus data user terkait
            if ($user) {
                $user->delete();
            }

            DB::commit();

            return redirect()->route('data_mhs.index')->with('success', 'Data Mahasiswa dan Akun berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}