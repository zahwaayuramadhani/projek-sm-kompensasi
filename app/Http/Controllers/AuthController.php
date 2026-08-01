<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
    $prodi = DB::table('prodi')->get();
    return view('auth.register', compact('prodi')); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        $kredensial = $request->only('username', 'password');

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user) {
                return redirect()->intended('/');
            }

            return redirect()->intended('login');
        } else {
            return back()->withErrors([
                'username' => 'Username atau password salah',
            ]);
        }
    }

    public function register(Request $request)
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
    ], [
        'nama.required'      => 'Nama lengkap wajib diisi.',
        'npm.required'       => 'NPM wajib diisi.',
        'npm.unique'         => 'NPM ini sudah terdaftar.',
        'id_prodi.required'  => 'Program studi wajib dipilih.',
        'id_prodi.exists'    => 'Program studi tidak valid.',
        'kelas.required'     => 'Kelas wajib dipilih.',
        'email.required'     => 'Email wajib diisi.',
        'email.email'        => 'Format email tidak valid.',
        'email.unique'       => 'Email sudah digunakan.',
        'username.required'  => 'Username tidak boleh kosong.',
        'username.unique'    => 'Username/NPM sudah terdaftar.',
        'password.required'  => 'Password tidak boleh kosong.',
        'password.min'       => 'Password minimal 3 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ]);

    DB::beginTransaction();

    try {
        // Simpan ke tabel users
        $user = new User();
        $user->username = $request->username; 
        $user->password = Hash::make($request->password); 
        $user->level    = 2; // Default level 2 untuk Mahasiswa
        $user->save();

        // Simpan ke tabel mahasiswa
        $mahasiswa = new Mahasiswa();
        $mahasiswa->nama     = $request->nama;
        $mahasiswa->npm      = $request->npm;
        $mahasiswa->id_prodi = $request->id_prodi;
        $mahasiswa->kelas    = $request->kelas;
        $mahasiswa->email    = $request->email;
        $mahasiswa->id_user  = $user->id; // Mengambil ID dari user yang baru dibuat
        $mahasiswa->save();

        DB::commit();

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silahkan login menggunakan NPM dan Password Anda.');

    } catch (\Exception $e) {
        DB::rollBack();
        
        return redirect()->back()
            ->withInput()
            ->withErrors(['error' => 'Gagal melakukan pendaftaran: ' . $e->getMessage()]);
    }
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('message', 'Silahkan login kembali.');
    }
}