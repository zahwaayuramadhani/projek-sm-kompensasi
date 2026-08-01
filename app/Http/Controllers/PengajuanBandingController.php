<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanBanding; 
use Illuminate\Support\Facades\Storage;
use App\Models\Mahasiswa; 
use App\Models\User; 

class PengajuanBandingController extends Controller
{
    public function index()
    {
        $allBanding = PengajuanBanding::with('mahasiswa')->latest()->paginate(10);
        return view('pengajuan_banding.index', compact('allBanding'));
    }
       
    public function show($id)
    {
        $banding = PengajuanBanding::with('mahasiswa')->findOrFail($id);
        return view('pengajuan_banding.show', compact('banding'));
    }

    public function create()
    {
        return view('mahasiswa.pengajuan_banding');
    }

    public function store(Request $request)
    {
    //     // Debugging:
    // if (!Auth::user()->mahasiswa) {
    //     dd("User login saat ini:", Auth::user(), "Data relasi mahasiswa ditemukan?", Auth::user()->mahasiswa);
    // }

    $user = Auth::user();
    $mahasiswa = $user->mahasiswa()->first(); 

    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Data profil mahasiswa tidak ditemukan untuk akun ini.');
    }

    $banding = new PengajuanBanding();
    $banding->id_mahasiswa = $mahasiswa->id_mahasiswa;

        $request->validate([
            'mata_kuliah'     => 'required|string|max:255',
            'tanggal_absen'   => 'required|date',
            'dosen_pengampu'  => 'required|string|max:255',
            'jenis_absen'     => 'required|in:Alfa,Izin,Sakit', // Ditambahkan sesuai form baru
            'jenis_izin'      => 'required|in:Izin,Sakit,Dispen',
            'alasan'          => 'required|string',
            'bukti'           => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', // Maksimal berkas 2MB
        ]);

        try {
            $pathBukti = null;
            if ($request->hasFile('bukti')) {
                $pathBukti = $request->file('bukti')->store('bukti_banding', 'public');
            }

            $banding = new PengajuanBanding();
            $banding->id_mahasiswa   = Auth::user()->mahasiswa->id_mahasiswa; 
            $banding->mata_kuliah     = $request->mata_kuliah;
            $banding->tanggal_absen   = $request->tanggal_absen;
            $banding->dosen_pengampu  = $request->dosen_pengampu;
            $banding->jenis_absen     = $request->jenis_absen; 
            $banding->jenis_izin      = $request->jenis_izin;  
            $banding->alasan          = $request->alasan;
            $banding->bukti           = $pathBukti;
            $banding->status          = 'Menunggu'; 
            $banding->save(); // Boom! Data tersimpan aman ke database

            return redirect()->back()->with('success', 'Pengajuan banding berhasil dikirim!');

        } catch (\Exception $e) {
            if (isset($pathBukti)) {
                Storage::disk('public')->delete($pathBukti);
            }
            return redirect()->back()->withInput()->with('error', 'Gagal mengirim pengajuan: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
    $request->validate([
        'status' => 'required|in:Diterima,Ditolak'
    ]);

    $banding = PengajuanBanding::findOrFail($id);

    $banding->status = $request->status;
    $banding->save();

    return redirect()->back()->with('success', 'Status pengajuan banding ' . $banding->mahasiswa->nama . ' berhasil diperbarui menjadi ' . $request->status . '!');
    }

    public function riwayat()
    {
        $user = auth()->user();

        if (!$user->mahasiswa) {
            return redirect()->back()->with('error', 'Profil mahasiswa tidak ditemukan.');
        }

        $mahasiswa = $user->mahasiswa; 

        $riwayat = \App\Models\PengajuanBanding::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                    ->orderBy('created_at', 'DESC')
                    ->get();

        return view('mahasiswa.riwayat_banding', compact('riwayat'));
    }
}