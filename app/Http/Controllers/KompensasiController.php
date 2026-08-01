<?php

namespace App\Http\Controllers;

use App\Models\DataKompensasi;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// Tulis ini di bagian paling atas bersama use lainnya:
use App\Imports\KompensasiImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan sudah install library ini



class KompensasiController extends Controller
{

    public function index(Request $request)
    {
    $prodis = Prodi::all();
    $keyword = $request->keyword;
    $prodiFilter = $request->prodi; 
    $perPage = $request->get('per_page', 10);

    $kompensasi = Mahasiswa::with('prodi')
        ->when($prodiFilter, function ($query) use ($prodiFilter) {
            $query->where('mahasiswa.id_prodi', $prodiFilter);
        })
        ->when($keyword, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('mahasiswa.nama', 'like', '%' . $keyword . '%')
                  ->orWhere('mahasiswa.npm', 'like', '%' . $keyword . '%');
            });
        })
        ->join('data_kompensasi', 'mahasiswa.id_mahasiswa', '=', 'data_kompensasi.id_mahasiswa')
        ->select(
            'mahasiswa.id_mahasiswa',
            'mahasiswa.nama',
            'mahasiswa.npm',
            'mahasiswa.kelas',
            'mahasiswa.id_prodi',
            DB::raw('SUM(data_kompensasi.jam_alfa) as total_alfa'),
            DB::raw('SUM(data_kompensasi.jam_kompensasi) as total_kompensasi')
        )
        ->groupBy('mahasiswa.id_mahasiswa', 'mahasiswa.nama', 'mahasiswa.npm', 'mahasiswa.kelas', 'mahasiswa.id_prodi')
        ->paginate($perPage)
        ->withQueryString(); 

    return view('kompensasi.index', compact('kompensasi', 'prodis'));
}

    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $prodis = Prodi::all();

        return view('kompensasi.create', compact('mahasiswa', 'prodis'));    
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswa,id_mahasiswa',
            'mata_kuliah' => 'required|string',
            'dosen_pengampu' => 'required|string',
            'tanggal' => 'required|date',
            'jam_alfa' => 'required|integer|min:1',
            'jam_kompensasi' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        DataKompensasi::create([
            'id_mahasiswa' => $request->id_mahasiswa,
            'mata_kuliah' => $request->mata_kuliah,
            'dosen_pengampu' => $request->dosen_pengampu,
            'tanggal' => $request->tanggal,
            'jam_alfa' => $request->jam_alfa,
            'jam_kompensasi' => $request->jam_kompensasi,
            'keterangan' => $request->keterangan,
            'satuan' => 'Jam', // Default otomatis sesuai UI
        ]);

        return redirect()->route('kompensasi.index')->with('success', 'Data kompensasi berhasil ditambahkan!');
    }

    public function show($id_mahasiswa)
    {
        $mahasiswa = Mahasiswa::with(['prodi', 'dataKompensasi'])->findOrFail($id_mahasiswa);

        $historiKompensasi = $mahasiswa->dataKompensasi;

        $totalAlfa = $historiKompensasi->sum('jam_alfa');
        $totalKompen = $historiKompensasi->sum('jam_kompensasi');

        return view('kompensasi.show', compact('mahasiswa', 'historiKompensasi', 'totalAlfa', 'totalKompen'));
    }

    public function destroyMassal(Request $request)
        {
            if (!$request->has('id_mahasiswa')) {
                return redirect()->route('kompensasi.index')->with('error', 'Tidak ada data mahasiswa yang dipilih.');
            }

            $idMahasiswaTerpilih = $request->id_mahasiswa;

            DB::table('data_kompensasi')->whereIn('id_mahasiswa', $idMahasiswaTerpilih)->delete();

            return redirect()->route('kompensasi.index')->with('success', 'Seluruh riwayat kompensasi mahasiswa terpilih berhasil dibersihkan!');
    }

    public function destroy($id_kompensasi)
    {
    $kompensasi = DataKompensasi::findOrFail($id_kompensasi);
    
    $id_mahasiswa = $kompensasi->id_mahasiswa;

    $kompensasi->delete();

    return redirect()->route('kompensasi.show', $id_mahasiswa)
        ->with('success', 'Satu riwayat data kompensasi berhasil dihapus!');
    }

    public function importExcel(Request $request)
    {
    $request->validate([
        'file_excel' => 'required|mimes:xlsx,xls,csv|max:2048'
    ]);

    try 
    {
    Excel::import(new KompensasiImport, $request->file('file_excel'));

    return redirect()->route('kompensasi.index')->with('success', 'Data kompensasi berhasil di-import dari Excel!');
    } catch (\Exception $e) {
        return redirect()->route('kompensasi.index')->with('error', 'Gagal meng-import data. Pastikan format kolom/tanggal sesuai.');
    }
    }
    
    public function edit($id_kompensasi)
    {
    $kompensasi = DataKompensasi::findOrFail($id_kompensasi);
    
    $mahasiswa = Mahasiswa::with('prodi')->findOrFail($kompensasi->id_mahasiswa);
    
    return view('kompensasi.edit', compact('kompensasi', 'mahasiswa'));
}

public function update(Request $request, $id_kompensasi)
{
    $request->validate([
        'mata_kuliah'    => 'required|string|max:255',
        'dosen_pengampu' => 'required|string|max:255',
        'tanggal'        => 'required|date',
        'jam_alfa'       => 'required|integer|min:0',
        'jam_kompensasi' => 'required|integer|min:0',
        'keterangan'     => 'nullable|string',
    ]);

    $kompensasi = DataKompensasi::findOrFail($id_kompensasi);
    
    $kompensasi->update([
        'mata_kuliah'    => $request->mata_kuliah,
        'dosen_pengampu' => $request->dosen_pengampu,
        'tanggal'        => $request->tanggal,
        'jam_alfa'       => $request->jam_alfa,
        'jam_kompensasi' => $request->jam_kompensasi,
        'keterangan'     => $request->keterangan,
    ]);

    return redirect()->route('kompensasi.show', $kompensasi->id_mahasiswa)
        ->with('success', 'Data kompensasi berhasil diperbarui!');
}

public function exportPdf(Request $request)
{
    $query = DataKompensasi::query();
    
    if ($request->has('prodi')) {
        $query->whereHas('mahasiswa', function($q) use ($request) {
            $q->where('id_prodi', $request->prodi);
        });
    }
    
$data = DataKompensasi::with('mahasiswa')->get();    
$pdf = Pdf::loadView('kompensasi.pdf', compact('data'));
    return $pdf->download('Data_Kompensasi_' . date('Y-m-d') . '.pdf');
}
}