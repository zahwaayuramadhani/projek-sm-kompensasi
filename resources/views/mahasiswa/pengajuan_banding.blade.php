@extends('layouts.master')

@section('title', 'Form Pengajuan Banding')

@section('breadcrumb')
    @parent
    <li class="text-gray-300">/</li>
    <li class="text-blue-500 font-medium">Pengajuan Banding Kompensasi</li>
@endsection

@section('content')
<div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100">

    <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-3">Form Pengajuan Banding Mahasiswa</h2>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('mahasiswa.pengajuan_banding.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Mata Kuliah --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Mata Kuliah</label>
                <input type="text" name="mata_kuliah" value="{{ old('mata_kuliah') }}" placeholder="Contoh: Pemrograman Web" required
                    class="w-full border border-gray-200 bg-gray-50 rounded px-3 py-2 text-sm outline-none focus:border-blue-400 focus:bg-white transition">
                @error('mata_kuliah') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Tanggal Absensi</label>
                <input type="date" name="tanggal_absen" value="{{ old('tanggal_absen') }}" required
                    class="w-full border border-gray-200 bg-gray-50 rounded px-3 py-2 text-sm outline-none focus:border-blue-400 focus:bg-white transition">
                @error('tanggal_absen') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Dosen Pengampu</label>
            <input type="text" name="dosen_pengampu" value="{{ old('dosen_pengampu') }}" placeholder="Nama Lengkap Dosen dan Gelar" required
                class="w-full border border-gray-200 bg-gray-50 rounded px-3 py-2 text-sm outline-none focus:border-blue-400 focus:bg-white transition">
            @error('dosen_pengampu') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Status Absen Semula</label>
                <select name="jenis_absen" required class="w-full border border-gray-200 bg-gray-50 rounded px-3 py-2 text-sm outline-none focus:border-blue-400 focus:bg-white transition cursor-pointer">
                    <option value="Alfa" {{ old('jenis_absen') == 'Alfa' ? 'selected' : '' }}>Alfa</option>
                    <option value="Izin" {{ old('jenis_absen') == 'Izin' ? 'selected' : '' }}>Izin (Tidak Direstui)</option>
                    <option value="Sakit" {{ old('jenis_absen') == 'Sakit' ? 'selected' : '' }}>Sakit (Tidak Direstui)</option>
                </select>
                @error('jenis_absen') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Mengajukan Banding Untuk</label>
                <div class="flex items-center gap-6 mt-2 text-sm text-gray-700">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="jenis_izin" value="Izin" {{ old('jenis_izin', 'Izin') == 'Izin' ? 'checked' : '' }} class="text-blue-500">
                        <span>Izin</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="jenis_izin" value="Sakit" {{ old('jenis_izin') == 'Sakit' ? 'checked' : '' }} class="text-blue-500">
                        <span>Sakit</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="jenis_izin" value="Dispen" {{ old('jenis_izin') == 'Dispen' ? 'checked' : '' }} class="text-blue-500">
                        <span>Dispen</span>
                    </label>
                </div>
                @error('jenis_izin') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Alasan Banding</label>
            <textarea name="alasan" rows="3" placeholder="Tuliskan alasan detail ketidakhadiran Anda..." required
                class="w-full border border-gray-200 bg-gray-50 rounded p-3 text-sm outline-none focus:border-blue-400 focus:bg-white transition resize-none">{{ old('alasan') }}</textarea>
            @error('alasan') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Bukti Pendukung</label>
            <div class="border-2 border-dashed border-gray-300 hover:border-blue-400 bg-gray-50 rounded-lg p-5 transition flex flex-col items-center justify-center relative group cursor-pointer">
                <input type="file" name="bukti" required id="buktiInput" onchange="previewFileName()"
                    class="absolute inset-0 opacity-0 cursor-pointer w-full h-full">
                
                <div id="uploadUI" class="text-center space-y-1 pointer-events-none">
                    <p class="text-sm font-medium text-gray-600" id="fileNamePlaceholder">Unggah Berkas Pendukung (PDF, JPG, PNG)</p>
                    <p class="text-xs text-gray-400">Maksimal ukuran file 2MB</p>
                </div>
            </div>
            @error('bukti') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end gap-1.5 !mt-2 pt-3 border-t border-gray-100">
            <a href="{{ route('dashboard') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3.5 py-1.5 rounded-md text-sm font-medium transition flex items-center gap-1.5">
                <i class="fas fa-times-circle text-gray-500"></i> Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1.5 rounded-md text-sm font-medium transition shadow-sm flex items-center gap-1.5">
                Kirim Pengajuan <i class="fas fa-arrow-right text-[10px]"></i>
            </button>
        </div>
    </form>
</div>

<script>
function previewFileName() {
    const input = document.getElementById('buktiInput');
    const placeholder = document.getElementById('fileNamePlaceholder');
    if (input.files.length > 0) {
        placeholder.textContent = "Berkas terpilih: " + input.files[0].name;
        placeholder.classList.add('text-blue-600', 'font-semibold');
    }
}
</script>
@endsection