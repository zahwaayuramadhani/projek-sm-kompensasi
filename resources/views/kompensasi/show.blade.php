@extends('layouts.master')

@section('title', 'Detail Kompensasi - Admin Jurusan')

@section('breadcrumb')
    @parent
    <li class="text-gray-300">/</li>
    <li class="text-blue-500 font-medium">Detail Kompensasi</li>
@endsection

@section('content')
<div class="container mx-auto">      
    
     @if(Auth::user()->level == 1)
    <div class="mb-6">
        <a href="{{ route('kompensasi.index') }}" class="text-sm text-gray-500 hover:text-blue-600 transition flex items-center gap-2 mb-2">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
    @endif

    @if(Auth::user()->level == 2)
    <div class="mb-6">
        <a href="{{ route('kompensasi.index') }}" class="text-sm text-gray-500 hover:text-blue-600 transition flex items-center gap-2 mb-2">
            <i class="fas fa-arrow-left"></i> Kembali ke Menu
        </a>
    </div>
    @endif


    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="flex flex-col gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-6 border-b pb-4">
                    <div class="bg-blue-100 p-2 rounded-lg"> 
                        <i class="fas fa-id-card text-blue-600"></i>
                    </div>
                    <h3 class="font-bold text-blue-600">Identitas Mahasiswa</h3>
                </div>

                <div class="space-y-4">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Nama Lengkap</p>
                        <p class="font-semibold text-gray-700">{{ $mahasiswa->nama }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">NPM</p>
                        <p class="font-semibold text-gray-700">{{ $mahasiswa->npm }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Program Studi</p>
                        <p class="font-semibold text-gray-700">{{ $mahasiswa->prodi->nama_prodi ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Kelas</p>
                        <p class="font-semibold text-gray-700">{{ $mahasiswa->kelas }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-gray-800 mb-4">Akumulasi Jam</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs text-gray-700">TOTAL KETIDAKHADIRAN</p>
                        <p class="text-xl font-bold text-blue-600">{{ $totalAlfa }} Jam</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-700">KOMPENSASI</p>
                        <div class="mt-2 w-16 h-16 bg-[#63A0EF] rounded-lg flex flex-col items-center justify-center text-white shadow-md">
                            <span class="text-2xl font-bold leading-none">{{ $totalKompen }}</span>
                            <span class="text-[10px]">Jam</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-800 mb-6 uppercase text-sm tracking-widest text-blue-500">Kompensasi</h3>
            
<div class="space-y-4 overflow-y-auto max-h-[500px] pr-2">
    @forelse($historiKompensasi as $item)
        <div class="border rounded-xl p-4 relative hover:border-blue-300 transition-colors bg-gray-50/50">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <h4 class="font-bold text-blue-900">{{ $item->mata_kuliah }}</h4>
                    <p class="text-xs text-gray-500 italic">{{ $item->dosen_pengampu }}</p>
                </div>
                
                {{-- Tampilan Jam Per Baris --}}
                <div class="text-right">
                    <p class="text-sm font-bold text-gray-700">{{ $item->jam_kompensasi }} jam</p>
                    <span class="text-[10px] bg-red-100 text-red-600 px-2 py-1 rounded font-bold uppercase">
                        ALFA ({{ $item->jam_alfa }}j)
                    </span>
                </div>
            </div>

            <div class="text-[10px] text-gray-400 mb-2">
                <i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
            </div>

            @if($item->keterangan)
                <div class="bg-gray-100 p-3 rounded-lg mt-2">
                    <p class="text-xs text-gray-600">{{ $item->keterangan }}</p>
                </div>
            @endif

            @if(Auth::user()->level == 1)
            <div class="flex gap-2 mt-3 pt-3 border-t">
                <a href="{{ route('kompensasi.edit', ['kompensasi' => $item->id_kompensasi]) }}" class="bg-blue-500 text-white p-1 rounded text-xs flex items-center justify-center h-6 w-6"><i class="fas fa-edit"></i></a>
                
                <form action="{{ route('kompensasi.destroy', $item->id_kompensasi) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white p-1 rounded text-xs flex items-center justify-center h-6 w-6 hover:bg-red-600 transition"> <i class="fas fa-trash"></i></button>
                </form>
            </div>
            @endif
        </div>
    @empty
        <div class="text-center py-8 text-gray-400 text-sm">Belum ada riwayat data.</div>
    @endforelse
</div>
        </div>
    </div>

</div>
@endsection