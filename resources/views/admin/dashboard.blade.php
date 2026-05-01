@extends('layouts.master')

@section('title', 'Admin Jurusan Dashboard')

@section('breadcrumb')
    @parent
    <li class="text-gray-300">/</li>
    <li class="text-blue-500 font-medium">Dashboard</li>
@endsection

@section('content')


<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-start mb-3">
            <div class="text-[#63A0EF] text-xl"><i class="fas fa-shapes"></i></div>
            <div class="text-right">
                <p class="text-[9px] uppercase font-bold text-gray-400">Total Kompensasi</p>
                <p class="text-2xl font-bold text-gray-800">2</p>
            </div>
        </div>
        <button class="w-full py-1.5 bg-slate-50 hover:bg-blue-50 text-gray-500 text-[10px] font-bold rounded-lg border border-gray-100 transition flex items-center justify-center gap-1">
            LIHAT <i class="fas fa-chevron-right text-[8px]"></i>
        </button>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-start mb-3">
            <div class="text-emerald-500 text-xl"><i class="fas fa-user"></i></div>
            <div class="text-right">
                <p class="text-[9px] uppercase font-bold text-gray-400">Total Mahasiswa</p>
                <p class="text-2xl font-bold text-gray-800">5</p>
            </div>
        </div>
        <button class="w-full py-1.5 bg-slate-50 hover:bg-emerald-50 text-gray-500 text-[10px] font-bold rounded-lg border border-gray-100 transition flex items-center justify-center gap-1">
            LIHAT <i class="fas fa-chevron-right text-[8px]"></i>
        </button>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-start mb-3">
            <div class="text-orange-400 text-xl"><i class="fas fa-pencil-alt"></i></div>
            <div class="text-right">
                <p class="text-[9px] uppercase font-bold text-gray-400">Pengajuan Banding</p>
                <p class="text-2xl font-bold text-gray-800">5</p>
            </div>
        </div>
        <button class="w-full py-1.5 bg-slate-50 hover:bg-orange-50 text-gray-500 text-[10px] font-bold rounded-lg border border-gray-100 transition flex items-center justify-center gap-1">
            LIHAT <i class="fas fa-chevron-right text-[8px]"></i>
        </button>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-start mb-3">
            <div class="text-rose-400 text-xl"><i class="fas fa-book"></i></div>
            <div class="text-right">
                <p class="text-[9px] uppercase font-bold text-gray-400">Total Program Studi</p>
                <p class="text-2xl font-bold text-gray-800">5</p>
            </div>
        </div>
        <button class="w-full py-1.5 bg-slate-50 hover:bg-rose-50 text-gray-500 text-[10px] font-bold rounded-lg border border-gray-100 transition flex items-center justify-center gap-1">
            LIHAT <i class="fas fa-chevron-right text-[8px]"></i>
        </button>
    </div>

</div>
@endsection