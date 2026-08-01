<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// Pastikan semua model di-import dengan benar
use App\Models\DataKompensasi; 
use App\Models\Mahasiswa;
use App\Models\PengajuanBanding;
use App\Models\Prodi;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->level == 2) {
            $user = Auth::user();
            $adaKompensasi = DataKompensasi::whereHas('mahasiswa', function($q) use ($user) {
            $q->where('id_user', $user->id);
        })->exists();
            return view('mahasiswa.dashboard', compact('adaKompensasi'));
        }

        $totalKompensasi = DB::table('data_kompensasi')->distinct('id_mahasiswa')->count();
        $totalMahasiswa  = DB::table('mahasiswa')->count();
        $totalPengajuan  = DB::table('pengajuan_banding')->count();
        $totalProdi      = DB::table('prodi')->count();

        return view('admin.dashboard', compact(
            'totalKompensasi', 
            'totalMahasiswa', 
            'totalPengajuan', 
            'totalProdi'
        ));
    }
}