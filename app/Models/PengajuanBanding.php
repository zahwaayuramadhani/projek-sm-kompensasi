<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanBanding extends Model
{
    protected $table = 'pengajuan_banding';
    protected $primaryKey = 'id_pengajuan';
    protected $guarded = [   ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
