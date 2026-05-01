@extends('layouts.master')

@section('title', 'Sistem Manajemen Kompensasi')

@section('breadcrumb')
    @parent
    <li class="text-gray-300">/</li>
    <li class="text-blue-500 font-medium">Dashboard</li>
@endsection

@section('content')
<div class="p-6">
    <div class="grid grid-cols-1 gap-6 max-w-5xl">
        <!-- Card 1: Informasi Kompensasi -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 flex items-start space-x-4">
                <!-- Icon Circle -->
                <div class="flex-shrink-0 w-10 h-10 bg-[#002384] text-white rounded-full flex items-center justify-center shadow-md">
                    <i class="fas fa-info-circle text-lg"></i>
                </div>
                
                <div class="flex-1">
                    <h2 class="text-lg font-bold text-gray-800 mb-3">Informasi Kompensasi</h2>
                    <div class="text-gray-600 leading-relaxed space-y-2">
                        <p class="flex items-center">
                            <span class="w-1.5 h-1.5 bg-[#63A0EF] rounded-full mr-2"></span>
                            Silakan cek apakah nama kamu masuk dalam daftar kompensasi.
                        </p>
                        <p class="flex items-center">
                            <span class="w-1.5 h-1.5 bg-[#63A0EF] rounded-full mr-2"></span>
                            Jika terdaftar, kamu dapat mengajukan banding dengan menyertakan bukti pendukung.
                        </p>
                        <p class="flex items-center">
                            <span class="w-1.5 h-1.5 bg-[#63A0EF] rounded-full mr-2"></span>
                            Pengajuan banding akan diproses oleh admin.
                        </p>
                        <p class="flex items-center">
                            <span class="w-1.5 h-1.5 bg-[#63A0EF] rounded-full mr-2"></span>
                            Jika disetujui, kamu tidak perlu menjalani kompensasi.
                        </p>
                        <p class="flex items-center">
                            <span class="w-1.5 h-1.5 bg-[#63A0EF] rounded-full mr-2"></span>
                            Jika ditolak, maka kamu tetap wajib menjalani kompensasi.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Pelaksanaan Kompensasi -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 flex items-start space-x-4">
                <!-- Icon Circle -->
                <div class="flex-shrink-0 w-10 h-10 bg-[#63A0EF] text-white rounded-full flex items-center justify-center shadow-md">
                    <i class="fas fa-calendar-check text-lg"></i>
                </div>
                
                <div>
                    <h2 class="text-lg font-bold text-gray-800 mb-1">Pelaksanaan Kompensasi</h2>
                    <p class="text-gray-600 italic">
                        Kompensasi akan dilaksanakan <span class="font-semibold text-[#002384]">2 Minggu setelah UAS</span>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection