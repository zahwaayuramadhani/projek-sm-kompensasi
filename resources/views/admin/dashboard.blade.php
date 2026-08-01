@extends('layouts.master')

@section('title', 'Admin Jurusan Dashboard')

@section('breadcrumb')
    @parent
    <li class="text-gray-300">/</li>
    <li class="text-blue-500 font-medium">Dashboard</li>
@endsection

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    
    <a href="{{ route('kompensasi.index') }}" class="block bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-300 transition group">
        <div class="flex justify-between items-start mb-3">
            <div class="text-[#63A0EF] text-xl transition group-hover:scale-110"><i class="fas fa-shapes"></i></div>
            <div class="text-right">
                <p class="text-[9px] uppercase font-bold text-gray-400">Total Kompensasi</p>
                {{-- Angka dinamis dari database (pakai ?? 0 untuk jaga-jaga jika kosong) --}}
                <p class="text-2xl font-bold text-gray-800">{{ $totalKompensasi ?? 0 }}</p>
            </div>
        </div>
        <div class="w-full py-1.5 bg-slate-50 group-hover:bg-blue-50 group-hover:text-blue-600 text-gray-500 text-[10px] font-bold rounded-lg border border-gray-100 transition flex items-center justify-center gap-1">
            LIHAT <i class="fas fa-chevron-right text-[8px]"></i>
        </div>
    </a>

    <a href="{{ route('data_mhs.index') }}" class="block bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-emerald-300 transition group">
        <div class="flex justify-between items-start mb-3">
            <div class="text-emerald-500 text-xl transition group-hover:scale-110"><i class="fas fa-user"></i></div>
            <div class="text-right">
                <p class="text-[9px] uppercase font-bold text-gray-400">Total Mahasiswa</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalMahasiswa ?? 0 }}</p>
            </div>
        </div>
        <div class="w-full py-1.5 bg-slate-50 group-hover:bg-emerald-50 group-hover:text-emerald-600 text-gray-500 text-[10px] font-bold rounded-lg border border-gray-100 transition flex items-center justify-center gap-1">
            LIHAT <i class="fas fa-chevron-right text-[8px]"></i>
        </div>
    </a>

    {{-- Card 3: Pengajuan Banding --}}
    <a href="{{ route('pengajuan_banding.index') }}" class="block bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-orange-300 transition group">
        <div class="flex justify-between items-start mb-3">
            <div class="text-orange-400 text-xl transition group-hover:scale-110"><i class="fas fa-pencil-alt"></i></div>
            <div class="text-right">
                <p class="text-[9px] uppercase font-bold text-gray-400">Pengajuan Banding</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalPengajuan ?? 0 }}</p>
            </div>
        </div>
        <div class="w-full py-1.5 bg-slate-50 group-hover:bg-orange-50 group-hover:text-orange-600 text-gray-500 text-[10px] font-bold rounded-lg border border-gray-100 transition flex items-center justify-center gap-1">
            LIHAT <i class="fas fa-chevron-right text-[8px]"></i>
        </div>
    </a>

    <a href="{{ route('data_prodi.index') }}" class="block bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-rose-300 transition group">
        <div class="flex justify-between items-start mb-3">
            <div class="text-rose-400 text-xl transition group-hover:scale-110"><i class="fas fa-book"></i></div>
            <div class="text-right">
                <p class="text-[9px] uppercase font-bold text-gray-400">Total Program Studi</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalProdi ?? 0 }}</p>
            </div>
        </div>
        <div class="w-full py-1.5 bg-slate-50 group-hover:bg-rose-50 group-hover:text-rose-600 text-gray-500 text-[10px] font-bold rounded-lg border border-gray-100 transition flex items-center justify-center gap-1">
            LIHAT <i class="fas fa-chevron-right text-[8px]"></i>
        </div>
    </a>

</div>
@endsection