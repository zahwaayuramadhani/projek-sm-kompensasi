@extends('layouts.master')

@section('title', 'Tambah Data Kompensasi - Admin Jurusan')

@section('breadcrumb')
    @parent
    <li class="text-gray-300">/</li>
    <li class="text-blue-500 font-medium">Buat Kompensasi JKB</li>
@endsection

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Custom CSS agar Select2 serasi dengan desain input Tailwind-mu */
    .select2-container--default .select2-selection--single {
        background-color: #f9fafb !important; /* bg-gray-50 */
        border-color: #e5e7eb !important; /* border-gray-200 */
        height: 42px !important;
        border-radius: 0.5rem !important; /* rounded-lg */
        padding-top: 6px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px !important;
    }
</style>

@section('content')
<div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Buat Kompensasi JKB</h2>

    <form action="{{ route('kompensasi.store') }}" method="POST">
        @csrf

        <div class="mb-8">
            <div class="flex items-center gap-2 mb-4 text-blue-600 font-bold border-b pb-2">
                <i class="fas fa-address-card"></i>
                <span class="text-sm tracking-wider uppercase">Data Mahasiswa</span>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Pilih Mahasiswa (NPM - Nama)</label>
                <select name="id_mahasiswa" id="id_mahasiswa" class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-lg p-2.5 text-sm outline-none focus:border-blue-400 focus:bg-white @error('id_mahasiswa') border-red-500 @enderror" required>
                    <option value="">-- Pilih Mahasiswa Terlebih Dahulu --</option>
                    @foreach($mahasiswa as $mhs)
                        <option value="{{ $mhs->id_mahasiswa }}" data-nama="{{ $mhs->nama }}" data-prodi="{{ $mhs->id_prodi }}" data-kelas="{{ $mhs->kelas }}" data-email="{{ $mhs->email ?? 'mahasiswa@pnc.ac.id' }}" {{ old('id_mahasiswa') == $mhs->id_mahasiswa ? 'selected' : '' }}>
                            {{ $mhs->npm }} - {{ $mhs->nama }}
                        </option>
                    @endforeach
                </select>
                @error('id_mahasiswa') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Nama Lengkap</label>
                    <input type="text" id="mhs_nama" class="w-full bg-gray-100 border border-gray-200 text-gray-700 rounded-lg p-2.5 text-sm outline-none" placeholder="Nama Lengkap" readonly>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Program Studi</label>
                    <select id="mhs_prodi" class="w-full bg-gray-100 border border-gray-200 text-gray-500 rounded-lg p-2.5 text-sm outline-none pointer-events-none" disabled>
                        <option value="">-- Pilih Program Studi --</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->id_prodi }}">{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">NPM (Nomor Pokok Mahasiswa)</label>
                    <input type="text" id="mhs_npm" class="w-full bg-gray-100 border border-gray-200 text-gray-700 rounded-lg p-2.5 text-sm outline-none" placeholder="Nomor Pokok Mahasiswa" readonly>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Kelas</label>
                    <input type="text" id="mhs_kelas" class="w-full bg-gray-100 border border-gray-200 text-gray-700 rounded-lg p-2.5 text-sm outline-none" placeholder="Kelas Mahasiswa" readonly>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Alamat Email</label>
                <input type="email" id="mhs_email" class="w-full bg-gray-100 border border-gray-200 text-gray-700 rounded-lg p-2.5 text-sm outline-none" placeholder="Alamat Email Mahasiswa" readonly>
            </div>
        </div>

        <div class="mb-6">
            <div class="flex items-center gap-2 mb-4 text-blue-600 font-bold border-b pb-2">
                <i class="fas fa-folder-open"></i>
                <span class="text-sm tracking-wider uppercase">Kompensasi</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Mata Kuliah</label>
                    <input type="text" name="mata_kuliah" value="{{ old('mata_kuliah') }}" class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-lg p-2.5 text-sm outline-none focus:border-blue-400 focus:bg-white @error('mata_kuliah') border-red-500 @enderror" placeholder="Masukkan Mata Kuliah" required>
                    @error('mata_kuliah') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-lg p-2.5 text-sm outline-none focus:border-blue-400 focus:bg-white @error('tanggal') border-red-500 @enderror" required>
                    @error('tanggal') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Dosen</label>
                    <input type="text" name="dosen_pengampu" value="{{ old('dosen_pengampu') }}" class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-lg p-2.5 text-sm outline-none focus:border-blue-400 focus:bg-white @error('dosen_pengampu') border-red-500 @enderror" placeholder="Nama Lengkap Dosen dan Gelar" required>
                    @error('dosen_pengampu') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Jam Alfa</label>
                        <input type="number" name="jam_alfa" id="jam_alfa" value="{{ old('jam_alfa', 0) }}" class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-lg p-2.5 text-sm outline-none focus:border-blue-400 focus:bg-white" placeholder="Jam Alfa" min="0" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Jam Kompen</label>
                        <input type="number" name="jam_kompensasi" id="jam_kompensasi" value="{{ old('jam_kompensasi', 0) }}" class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-lg p-2.5 text-sm outline-none focus:border-blue-400 focus:bg-white" placeholder="Otomatis x3" min="0" required>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">Keterangan</label>
                <textarea name="keterangan" rows="3" class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-lg p-2.5 text-sm outline-none focus:border-blue-400 focus:bg-white" placeholder="Berikan Keterangan yang Jelas!">{{ old('keterangan') }}</textarea>
            </div>
        </div>

        <div class="flex justify-end gap-2 mt-6 border-t pt-4">
            <a href="{{ route('kompensasi.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 text-xs font-bold px-4 py-2 rounded-md flex items-center gap-1 transition">
                <i class="fas fa-times-circle"></i> Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold px-4 py-2 rounded-md flex items-center gap-1 transition shadow-sm">
                Tambah <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Hidupkan Fitur Pencarian di Dropdown Mahasiswa
        $('#id_mahasiswa').select2({
            placeholder: "-- Pilih atau Cari NPM / Nama Mahasiswa --",
            allowClear: true,
            width: '100%'
        });

        const selectMhs = document.getElementById('id_mahasiswa');
        const inputJamAlfa = document.getElementById('jam_alfa');
        const inputJamKompen = document.getElementById('jam_kompensasi');

        // 2. Event Handler Auto-fill Identitas Mahasiswa berbasis Select2 JQuery
        $('#id_mahasiswa').on('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            
            if(selectedOption && selectedOption.value !== "") {
                document.getElementById('mhs_nama').value = selectedOption.getAttribute('data-nama');
                document.getElementById('mhs_npm').value = selectedOption.text.split(' - ')[0].trim();
                document.getElementById('mhs_kelas').value = selectedOption.getAttribute('data-kelas');
                document.getElementById('mhs_email').value = selectedOption.getAttribute('data-email');
                document.getElementById('mhs_prodi').value = selectedOption.getAttribute('data-prodi');
            } else {
                document.getElementById('mhs_nama').value = "";
                document.getElementById('mhs_npm').value = "";
                document.getElementById('mhs_kelas').value = "";
                document.getElementById('mhs_email').value = "";
                document.getElementById('mhs_prodi').value = "";
            }
        });

        // 3. Fungsi hitung otomatis Jam Kompen (Jam Alfa dikali 3)
        inputJamAlfa.addEventListener('input', function() {
            const alfa = parseInt(this.value) || 0;
            inputJamKompen.value = alfa * 3;
        });
    });
</script>
@endsection