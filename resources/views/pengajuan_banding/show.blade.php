@extends('layouts.master')

@section('title', 'Detail Pengajuan Banding')

@section('breadcrumb')
    @parent
    <li class="text-gray-300">/</li>
    <li class="text-blue-500 font-medium">Detail Pengajuan Banding Kompensasi</li>
@endsection

@section('content')
<div class="max-w-6xl mx-auto pb-8">
    
    {{-- Header & Back Button --}}
    <div class="mb-6">
        <a href="{{ route('pengajuan_banding.index') }}" class="text-sm text-gray-500 hover:text-blue-600 transition flex items-center gap-2 mb-2">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2">
            <div class="bg-white p-8 rounded-xl border border-gray-100 shadow-sm h-full">
                <h2 class="text-lg mb-6 font-bold text-blue-600">Pengajuan Banding Kompensasi</h2>
                
                <div class="p-6 rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-grey-800 font-semibold text-lg leading-tight">{{ $banding->mata_kuliah }}</p>
                            <p class="text-sm text-gray-500 mt-1">{{ $banding->dosen_pengampu }}</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-bold rounded-md bg-red-100 text-red-600">{{ $banding->jenis_absen }}</span>
                    </div>
                    
                    <hr class="border-gray-100 mb-4">
                    
                    <div class="flex items-center text-sm font-bold text-gray-700 mb-4">
                        <i class="fas fa-calendar-alt text-gray-400 mr-2"></i> 
                        {{ \Carbon\Carbon::parse($banding->tanggal_absen)->format('d F Y') }}
                    </div>
                    
                    <div class="bg-gray-50 p-4 rounded-lg text-sm text-gray-600 border border-gray-200 mb-6 leading-relaxed">
                        {{ $banding->alasan }}
                    </div>

                    <a href="{{ asset('storage/' . $banding->bukti) }}" target="_blank" class="block w-full text-center py-2.5 border border-gray-200 hover:bg-gray-50 text-gray-600 font-semibold rounded-lg text-sm transition">
                        Lihat Bukti
                    </a>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">

                <div class="flex items-center gap-3 mb-6 border-b pb-4">
                    <div class="bg-blue-100 p-2 rounded-lg"> 
                        <i class="fas fa-id-card text-blue-600"></i>
                    </div>
                    <h3 class="font-bold text-blue-600">Identitas Mahasiswa</h3>
                </div>
                
                <div class="space-y-5">
                    <div>
                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider mb-1">Nama Lengkap</p>
                        <p class="font-semibold text-gray-800 text-base">{{ $banding->mahasiswa->nama ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider mb-1">NPM</p>
                        <p class="font-semibold text-gray-800 text-base">{{ $banding->mahasiswa->npm ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider mb-1">Kelas</p>
                        <p class="font-semibold text-gray-800 text-base">{{ $banding->mahasiswa->kelas ?? '-' }}</p>
                    </div>
                </div>
            </div>

            @if($banding->status == 'Menunggu')
                <div class="space-y-3">
                    {{-- Form TERIMA --}}
                    <form action="{{ route('data_banding.update_status', $banding->id_pengajuan) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="Diterima">
                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-green-50 border border-green-200 text-green-600 font-semibold py-2.5 rounded-lg hover:bg-green-100 transition text-sm shadow-sm">
                            <i class="fas fa-check"></i> Terima
                        </button>
                    </form>

                    <form action="{{ route('data_banding.update_status', $banding->id_pengajuan) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="Ditolak">
                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-50 border border-red-200 text-red-600 font-semibold py-2.5 rounded-lg hover:bg-red-100 transition text-sm shadow-sm">
                            <i class="fas fa-times"></i> Tolak
                        </button>
                    </form>
                </div>
            @else
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                    <p class="text-xs uppercase font-bold text-gray-400 tracking-wider mb-3">Status Pengajuan</p>
                    <div class="inline-block px-6 py-2 rounded-lg font-bold uppercase tracking-wider text-sm 
                        {{ $banding->status == 'Diterima' ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200' }}">
                        {{ $banding->status }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection