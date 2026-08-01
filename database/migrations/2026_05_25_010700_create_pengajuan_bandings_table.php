<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan_banding', function (Blueprint $table) {
            $table->id('id_pengajuan'); 
            

            $table->unsignedInteger('id_mahasiswa'); 
            $table->foreign('id_mahasiswa')
                ->references('id_mahasiswa')
                ->on('mahasiswa')
                ->onDelete('cascade');
            
            $table->string('mata_kuliah');
            $table->date('tanggal_absen');
            $table->string('dosen_pengampu');
            $table->enum('jenis_absen', ['Alfa', 'Izin', 'Sakit'])->default('Alfa');
            $table->enum('jenis_izin', ['Izin', 'Sakit', 'Dispen']);
            $table->text('alasan');
            $table->string('bukti'); 
            $table->enum('status', ['Menunggu', 'Diterima', 'Ditolak'])->default('Menunggu');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_banding');
    }
};