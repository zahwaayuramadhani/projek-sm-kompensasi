@extends('layouts.master')

@section('title', 'Riwayat Pengajuan Banding')

@section('breadcrumb')
    @parent
    <li class="text-gray-300">/</li>
    <li class="text-blue-500 font-medium">Riwayat Banding Kompensasi</li>
@endsection

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="space-y-3">
        @forelse($riwayat as $item)
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition">
                <div class="flex justify-between items-center mb-2">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-0.5 text-xs font-bold rounded-full bg-red-100 text-red-700">
                            {{ $item->jenis_absen }}
                        </span>
                        <h3 class="font-bold text-base text-[rgba(9,51,97,1)]">{{ $item->mata_kuliah }}</h3>
                    </div>
                    
                    <span class="px-4 py-1 text-xs font-bold rounded-lg 
                        {{ $item->status == 'Diterima' ? 'bg-green-100 text-green-700' : 
                        ($item->status == 'Ditolak' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                        {{ strtoupper($item->status) }}
                    </span>
                </div>

                <hr class="border-gray-200 my-3">

                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">{{ $item->dosen_pengampu }}</p>
                        <div class="flex items-center text-xs text-gray-400 mt-2">
                            <i class="far fa-calendar-alt mr-1.5"></i> 
                            {{ \Carbon\Carbon::parse($item->tanggal_absen)->format('d F Y') }}
                        </div>
                    </div>
                    
                    <button type="button" 
                            onclick="showBukti('{{ asset('storage/' . $item->bukti) }}')"
                            class="px-4 py-2 bg-blue-600 text-white text-xs font-semibold rounded-lg hover:bg-blue-700 transition">
                        Lihat Bukti
                    </button>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">Belum ada riwayat pengajuan.</p>
        @endforelse
    </div>
</div>

<div id="modalBukti" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50 px-4" onclick="closeModal()">
    <div class="bg-white p-2 rounded-lg max-w-lg w-full shadow-2xl" onclick="event.stopPropagation()">
        <img id="imageBukti" src="" alt="Bukti Kompensasi" class="w-full h-auto rounded-md">
        <button onclick="closeModal()" class="mt-3 w-full py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm font-bold text-gray-600 transition">
            Tutup
        </button>
    </div>
</div>

<script>
    function showBukti(url) {
        document.getElementById('imageBukti').src = url;
        document.getElementById('modalBukti').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('modalBukti').classList.add('hidden');
    }
</script>
@endsection