<?php

namespace App\Imports;

use App\Models\DataKompensasi;
use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KompensasiImport implements ToModel, WithHeadingRow
{
    /**
     * Mapping data dari setiap baris Excel ke database
     */
    public function model(array $row)
    {
        
$mahasiswa = Mahasiswa::query()->where('npm', $row['npm'])->first();
        if (!$mahasiswa) {
            return null;
        }

        return new DataKompensasi([
            'id_mahasiswa'   => $mahasiswa->id_mahasiswa,
            'mata_kuliah'    => $row['mata_kuliah'],
            'dosen_pengampu' => $row['dosen_pengampu'],
            'tanggal'        => \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal'])),
            'jam_alfa'       => (int) $row['jam_alfa'],
            'jam_kompensasi' => (int) $row['jam_kompensasi'],
            'keterangan'     => $row['keterangan'] ?? '-',
            'satuan'         => 'Jam', // Otomatis default sistem
        ]);
    }
}