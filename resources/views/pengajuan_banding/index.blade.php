@extends('layouts.master')

@section('title', 'Data Pengajuan Banding - Admin Jurusan')

@section('breadcrumb')
    @parent
    <li class="text-gray-300">/</li>
    <li class="text-blue-500 font-medium">Pengajuan Banding Kompensasi</li>
@endsection

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm">

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-[#63A0EF] text-white text-sm">
                    <th class="p-2 border border-blue-400 text-left w-12">No</th>
                    <th class="p-2 border border-blue-400 text-left w-36">NPM</th>
                    <th class="p-2 border border-blue-400 text-left">Nama</th>
                    <th class="p-2 border border-blue-400 text-left w-28">Jenis Izin</th>
                    <th class="p-2 border border-blue-400 text-left w-24">Bukti</th>
                    <th class="p-2 border border-blue-400 text-center w-32">Status</th>
                    <th class="p-2 border border-blue-400 text-center w-36">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
                @forelse($allBanding as $index => $banding)
                <tr class="hover:bg-gray-50 border-b">
                    {{-- Penomoran Otomatis Memperhitungkan Pagination --}}
                    <td class="p-2 border text-center">
                        {{ ($allBanding->currentPage() - 1) * $allBanding->perPage() + $loop->iteration }}
                    </td>
                    <td class="p-2 border font-mono">{{ $banding->mahasiswa->npm ?? '-' }}</td>
                    <td class="p-2 border font-medium">{{ $banding->mahasiswa->nama ?? 'Data Mahasiswa Hilang' }}</td>
                    
                    <td class="p-2 border">
                        @if(strtolower($banding->jenis_izin) == 'sakit')
                            <span class="px-2 py-0.5 rounded text-xs font-semibold bg-blue-100 text-blue-700">
                                {{ $banding->jenis_izin }}
                            </span>
                        @elseif(strtolower($banding->jenis_izin) == 'izin')
                            <span class="px-2 py-0.5 rounded text-xs font-semibold bg-purple-100 text-purple-700">
                                {{ $banding->jenis_izin }}
                            </span>
                        @elseif(strtolower($banding->jenis_izin) == 'dispen')
                            <span class="px-2 py-0.5 rounded text-xs font-semibold bg-amber-100 text-amber-700">
                                {{ $banding->jenis_izin }}
                            </span>
                        @else
                            <span class="px-2 py-0.5 rounded text-xs font-semibold bg-gray-100 text-gray-700">
                                {{ $banding->jenis_izin }}
                            </span>
                        @endif
                    </td>

                    <td class="p-2 border">
                        <a href="{{ asset('storage/' . $banding->bukti) }}" target="_blank" class="text-blue-500 hover:underline font-medium">
                            Disini
                        </a>
                    </td>
                    <td class="p-2 border text-center">
                        <div class="flex justify-center">
                            @if($banding->status == 'Menunggu')
                                <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded text-xs font-medium">Menunggu</span>
                            @elseif($banding->status == 'Diterima')
                                <span class="bg-green-200 text-green-900 px-2 py-1 rounded text-xs font-medium">Diterima</span>
                            @else
                                <span class="bg-red-200 text-red-900 px-2 py-1 rounded text-xs font-medium">Ditolak</span>
                            @endif
                        </div>    
                    </td>
                    <td class="p-2 border text-center">
                        <div class="flex justify-center gap-1">
                            @if($banding->status == 'Menunggu')
                                <form action="{{ route('data_banding.update_status', $banding->id_pengajuan) }}" method="POST" class="inline">
                                    @csrf 
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="Diterima">
                                    <button type="submit" title="Terima" class="bg-green-200 text-green-700 p-1.5 rounded text-xs hover:bg-green-300 transition">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>

                                <form action="{{ route('data_banding.update_status', $banding->id_pengajuan) }}" method="POST" class="inline">
                                    @csrf 
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="Ditolak">
                                    <button type="submit" title="Tolak" class="bg-red-200 text-red-700 p-1.5 rounded text-xs hover:bg-red-300 transition">
                                        <i class="fas fa-close"></i>
                                    </button>
                                </form>
                            @endif
                            
                            <a href="{{ route('pengajuan_banding.show', $banding->id_pengajuan) }}" title="Lihat Detail" class="bg-cyan-400 text-white p-1.5 rounded text-xs hover:bg-cyan-500 transition">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-400 italic bg-gray-50 border">
                        Belum ada pengajuan banding kompensasi yang masuk.
                    </td>
                </tr>
                @endempty
            </tbody>
        </table>
    </div>

    <div class="mt-4 flex justify-between items-center text-xs text-gray-500">
        <p>
            Showing {{ $allBanding->firstItem() ?? 0 }} to {{ $allBanding->lastItem() ?? 0 }} of {{ $allBanding->total() }} entries
        </p>
        <div>
            {{ $allBanding->links() }}
        </div>
    </div>
</div>
@endsection