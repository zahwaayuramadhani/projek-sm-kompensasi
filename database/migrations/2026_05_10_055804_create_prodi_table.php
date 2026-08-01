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
        Schema::create('prodi', function (Blueprint $table) {
            $table->increments('id_prodi');
            $table->string('kode_prodi')->unique(); // Contoh: TI, RKS, TRM
            $table->string('nama_prodi');           // Contoh: Teknik Informatika
            $table->integer('kuota_prodi');        // Contoh: 128
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi');
    }
};
