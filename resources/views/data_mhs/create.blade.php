@extends('layouts.master')

@section('title', 'Tambah Data Mahasiswa')

@section('breadcrumb')
    @parent
    <li class="text-gray-300">/</li>
    <li class="text-blue-500 font-medium">Tambah Data Mahasiswa</li>
@endsection

@section('content')
<div class="container mx-auto px-4 pb-6">

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded text-sm" role="alert">
            <p class="font-bold">Gagal Menyimpan!</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden w-full">
        <form action="{{ route('data_mhs.store') }}" method="POST">
            @csrf

            {{-- Header: Data Mahasiswa --}}
            <div class="flex items-center gap-3 px-6 pt-5 pb-1">
                <div class="bg-blue-100 p-2 rounded-lg">
                    <i class="fas fa-user-plus text-blue-600"></i>
                </div>
                <h3 class="font-bold text-gray-800 uppercase tracking-wider text-sm">Tambah Data Mahasiswa</h3>
            </div>

            <div class="px-6 py-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="flex flex-col">
                        <label class="text-[11px] font-bold text-gray-700 mb-0.5 ml-1 uppercase">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama') }}"
                            class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition text-sm @error('nama') border-red-500 @enderror">
                        @error('nama') <p class="text-red-500 text-[10px] mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[11px] font-bold text-gray-700 mb-0.5 ml-1 uppercase">Program Studi</label>
                        <select name="id_prodi" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition text-sm text-gray-700 @error('id_prodi') border-red-500 @enderror">
                            <option value="">-- Pilih Program Studi --</option>
                            @foreach ($prodi as $p)
                                <option value="{{ $p->id_prodi }}" {{ old('id_prodi') == $p->id_prodi ? 'selected' : '' }}>
                                    {{ $p->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_prodi') <p class="text-red-500 text-[10px] mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="flex flex-col">
                        <label class="text-[11px] font-bold text-gray-700 mb-0.5 ml-1 uppercase">NPM (Nomor Pokok Mahasiswa)</label>
                        <input type="text" name="npm" id="npm" value="{{ old('npm') }}"
                            class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition text-sm @error('npm') border-red-500 @enderror">
                        @error('npm') <p class="text-red-500 text-[10px] mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[11px] font-bold text-gray-700 mb-0.5 ml-1 uppercase">Kelas</label>
                        <select name="kelas" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition text-sm text-gray-700 @error('kelas') border-red-500 @enderror">
                            <option value="">-- Pilih Kelas --</option>
                            {{-- TINGKAT 1 --}}
                            <option value="1A" {{ old('kelas') == '1A' ? 'selected' : '' }}>1A</option>
                            <option value="1B" {{ old('kelas') == '1B' ? 'selected' : '' }}>1B</option>
                            <option value="1C" {{ old('kelas') == '1C' ? 'selected' : '' }}>1C</option>
                            <option value="1D" {{ old('kelas') == '1D' ? 'selected' : '' }}>1D</option>

                            {{-- TINGKAT 2 --}}
                            <option value="2A" {{ old('kelas') == '2A' ? 'selected' : '' }}>2A</option>
                            <option value="2B" {{ old('kelas') == '2B' ? 'selected' : '' }}>2B</option>
                            <option value="2C" {{ old('kelas') == '2C' ? 'selected' : '' }}>2C</option>
                            <option value="2D" {{ old('kelas') == '2D' ? 'selected' : '' }}>2D</option>

                            {{-- TINGKAT 3 --}}
                            <option value="3A" {{ old('kelas') == '3A' ? 'selected' : '' }}>3A</option>
                            <option value="3B" {{ old('kelas') == '3b' ? 'selected' : '' }}>3B</option>
                            <option value="3C" {{ old('kelas') == '3C' ? 'selected' : '' }}>3C</option>
                            <option value="3D" {{ old('kelas') == '3D' ? 'selected' : '' }}>3D</option>

                            {{-- TINGKAT 4 --}}
                            <option value="3A" {{ old('kelas') == '4A' ? 'selected' : '' }}>4A</option>
                            <option value="3B" {{ old('kelas') == '4B' ? 'selected' : '' }}>4B</option>
                            <option value="3C" {{ old('kelas') == '4C' ? 'selected' : '' }}>4C</option>
                            <option value="3D" {{ old('kelas') == '4D' ? 'selected' : '' }}>4D</option>
                        </select>
                        @error('kelas') <p class="text-red-500 text-[10px] mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex flex-col mb-6">
                    <label class="text-[11px] font-bold text-gray-700 mb-0.5 ml-1 uppercase">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition text-sm @error('email') border-red-500 @enderror">
                    @error('email') <p class="text-red-500 text-[10px] mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <hr class="border-gray-100 mb-5">

                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-lock text-blue-600"></i>
                    <h3 class="font-bold text-gray-800 uppercase tracking-wider text-sm">Kredensial Akun Mahasiswa</h3>
                </div>

                <div class="flex flex-col mb-4">
                    <label class="text-[11px] font-bold text-gray-700 mb-0.5 ml-1 uppercase">Username <span class="normal-case text-gray-400 font-normal">(Otomatis disamakan dengan NPM)</span></label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" readonly
                        class="w-full px-4 py-2 bg-gray-100 border border-gray-200 text-gray-500 rounded-lg outline-none cursor-not-allowed transition text-sm">
                    @error('username') <p class="text-red-500 text-[10px] mt-1 ml-1">Username/NPM ini sudah terdaftar.</p> @enderror
                </div>

                <div class="bg-blue-50 text-blue-600 px-4 py-3 rounded-lg text-[11.5px] flex items-center gap-2 mb-4 border border-blue-100">
                    <i class="fas fa-info-circle"></i>
                    <p><strong>Info:</strong> Pastikan Anda memberikan dan mencatat password ini untuk diserahkan kepada Mahasiswa agar dapat melakukan Login.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="flex flex-col">
                        <label class="text-[11px] font-bold text-gray-700 mb-0.5 ml-1 uppercase">Password</label>
                        <input type="password" name="password" placeholder="Minimal 3 karakter"
                            class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition text-sm @error('password') border-red-500 @enderror">
                        @error('password') <p class="text-red-500 text-[10px] mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[11px] font-bold text-gray-700 mb-0.5 ml-1 uppercase">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password"
                            class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition text-sm">
                    </div>
                </div>

                <div class="flex justify-end gap-2 pt-2 pb-2">
                    <a href="{{ route('data_mhs.index') }}" type="button" class="px-5 py-2 bg-gray-200 text-gray-700 rounded-md text-sm flex items-center gap-1 transition shadow-sm hover:bg-gray-300 font-medium">
                        Batal
                    </a>
                    <button type="submit" class="bg-[#2563EB] hover:bg-blue-700 text-white px-5 py-2 rounded-md text-sm flex items-center gap-2 transition shadow-sm font-medium">
                        <i class="fas fa-save"></i> Simpan Data
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

{{-- Script sinkronisasi real-time NPM ke kolom Username --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const npmInput = document.getElementById('npm');
        const usernameInput = document.getElementById('username');

        // Isi otomatis sewaktu reload halaman jika ada old input
        if(npmInput.value) {
            usernameInput.value = npmInput.value;
        }

        npmInput.addEventListener('input', function() {
            usernameInput.value = this.value;
        });
    });
</script>
@endsection