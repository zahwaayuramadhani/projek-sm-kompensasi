<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKompensasi extends Model
{
    use HasFactory;

    protected $table = 'data_kompensasi';

    protected $primaryKey = 'id_kompensasi';

    protected $fillable = [
        'id_mahasiswa',
        'mata_kuliah',
        'dosen_pengampu',
        'tanggal',
        'jam_alfa',
        'jam_kompensasi',
        'satuan',
        'keterangan',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}