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
        Schema::create('data_kompensasi', function (Blueprint $table) {
            $table->increments('id_kompensasi'); 
            
            $table->unsignedInteger('id_mahasiswa'); 
            $table->foreign('id_mahasiswa')
                ->references('id_mahasiswa')
                ->on('mahasiswa')
                ->onDelete('cascade'); 
            $table->string('mata_kuliah');
            $table->string('dosen_pengampu'); 
            $table->date('tanggal');          
            $table->integer('jam_alfa');      
            $table->integer('jam_kompensasi'); 
            $table->string('satuan')->default('Jam'); 
            $table->text('keterangan')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kompensasi');
    }
};