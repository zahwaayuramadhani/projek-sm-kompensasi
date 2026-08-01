@extends('layouts.master')

@section('title', 'Edit Data Kompensasi')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Kompensasi JKB</h2>

    <form action="{{ route('kompensasi.update', $kompensasi->id_kompensasi) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-8">
            <div class="flex items-center gap-2 mb-4 text-blue-600 font-bold border-b pb-2">
                <i class="fas fa-address-card"></i>
                <span class="text-sm tracking-wider uppercase">Data Mahasiswa</span>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Mahasiswa</label>
                <input type="text" value="{{ $mahasiswa->npm }} - {{ $mahasiswa->nama }}" class="w-full bg-gray-100 border border-gray-200 text-gray-700 rounded-lg p-2.5 text-sm" readonly>
                <input type="hidden" name="id_mahasiswa" value="{{ $mahasiswa->id_mahasiswa }}">
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Nama Lengkap</label>
                    <input type="text" value="{{ $mahasiswa->nama }}" class="w-full bg-gray-100 border p-2.5 text-sm rounded-lg" readonly>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Program Studi</label>
                    <input type="text" value="{{ $mahasiswa->prodi->nama_prodi ?? 'Tidak Ada Prodi' }}" class="w-full bg-gray-100 border p-2.5 text-sm rounded-lg" readonly>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <div class="flex items-center gap-2 mb-4 text-blue-600 font-bold border-b pb-2">
                <i class="fas fa-folder-open"></i>
                <span class="text-sm tracking-wider uppercase">Data Kompensasi</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Mata Kuliah</label>
                    <input type="text" name="mata_kuliah" value="{{ old('mata_kuliah', $kompensasi->mata_kuliah) }}" class="w-full bg-gray-50 border p-2.5 text-sm rounded-lg" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $kompensasi->tanggal) }}" class="w-full bg-gray-50 border p-2.5 text-sm rounded-lg" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Dosen</label>
                    <input type="text" name="dosen_pengampu" value="{{ old('dosen_pengampu', $kompensasi->dosen_pengampu) }}" class="w-full bg-gray-50 border p-2.5 text-sm rounded-lg" required>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Jam Alfa</label>
                        <input type="number" name="jam_alfa" id="jam_alfa" value="{{ old('jam_alfa', $kompensasi->jam_alfa) }}" class="w-full bg-gray-50 border p-2.5 text-sm rounded-lg" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Jam Kompen</label>
                        <input type="number" name="jam_kompensasi" id="jam_kompensasi" value="{{ old('jam_kompensasi', $kompensasi->jam_kompensasi) }}" class="w-full bg-gray-50 border p-2.5 text-sm rounded-lg" required>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Keterangan</label>
                <textarea name="keterangan" rows="3" class="w-full bg-gray-50 border p-2.5 text-sm rounded-lg">{{ old('keterangan', $kompensasi->keterangan) }}</textarea>
            </div>
        </div>

        <div class="flex justify-end gap-2 mt-6 border-t pt-4">
            <a href="{{ route('kompensasi.show', $mahasiswa->id_mahasiswa) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 text-xs font-bold px-4 py-2 rounded-md transition">Batal</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold px-4 py-2 rounded-md transition">Simpan Perubahan</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('jam_alfa').addEventListener('input', function() {
        document.getElementById('jam_kompensasi').value = this.value * 3;
    });
</script>
@endsection