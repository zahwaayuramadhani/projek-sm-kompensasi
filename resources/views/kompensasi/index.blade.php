@extends('layouts.master')

@section('title', 'Data Kompensasi - Admin Jurusan')

@section('breadcrumb')
    @parent
    <li class="text-gray-300">/</li>
    <li class="text-blue-500 font-medium">Kompensasi</li>
@endsection

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm">
    
<div class="flex gap-2 mb-6">
    {{-- Tombol Semua --}}
    <a href="{{ route('kompensasi.index') }}" 
       class="px-4 py-1.5 rounded-md text-sm font-medium transition duration-200 shadow-sm 
       {{ !request('prodi') ? 'bg-[#63A0EF] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
        Semua
    </a>
    
    {{-- Tombol Prodi --}}
    @foreach($prodis as $prodi)
        <a href="{{ route('kompensasi.index', array_merge(request()->query(), ['prodi' => $prodi->id_prodi])) }}" 
           class="px-4 py-1.5 rounded-md text-sm font-medium transition duration-300 shadow-sm 
           {{ request('prodi') == $prodi->id_prodi 
              ? 'bg-[#63A0EF] text-white cursor-default' 
              : 'bg-white text-gray-600 border border-gray-200 hover:bg-blue-50 hover:border-[#63A0EF] hover:text-[#63A0EF]' }}">
            {{ $prodi->kode_prodi }}
        </a>
    @endforeach
</div>

<form id="form-hapus-massal" action="{{ route('kompensasi.destroyMassal') }}" method="POST">
    @csrf
    @method('DELETE')
    
<div class="flex gap-2 mb-4">
    @if(Auth::user()->level == 1)
    {{-- Tambah: Biru Muda (Soft Blue) --}}
    <a href="{{ route('kompensasi.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1.5 rounded-md text-sm flex items-center gap-1 transition shadow-sm">
        <i class="fas fa-plus"></i> Tambah
    </a>

    {{-- Hapus: Merah (Red) --}}
    <button type="button" id="btn-hapus-terpilih" class="bg-rose-500 hover:bg-rose-600 text-white px-3 py-1.5 rounded text-sm flex items-center gap-1 cursor-not-allowed" disabled>
        <i class="fas fa-trash"></i> Hapus Terpilih
    </button>

    {{-- Import: Hijau (Emerald) --}}
    <button type="button" onclick="toggleModal('modal-import')" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded text-sm flex items-center gap-1 transition">
        <i class="fas fa-file-excel"></i> Import Excel
    </button>
    @endif

<button type="button" onclick="window.location.href='{{ route('kompensasi.exportPdf', request()->query()) }}'" 
    class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded text-sm flex items-center gap-1 transition shadow-sm">
    <i class="fas fa-file-pdf"></i> Export PDF
</button>
</div>
</form>


    <div class="flex justify-between items-center mb-4 text-sm text-gray-600">
        <div>
                <form id="perPageForm" action="{{ request()->url() }}" method="GET">
                    @if(request('keyword'))
                    <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                @endif
                
                Show 
                <select name="per_page" onchange="document.getElementById('perPageForm').submit()" class="border rounded px-1 py-1 mx-1 outline-none cursor-pointer">
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page') == 10 || !request('per_page') ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                </select> 
                entries per page
            </form>
        </div>
        <div>
            <form action="{{ route('kompensasi.index') }}" method="GET" class="flex items-center gap-2">
                @if(request('per_page'))
                    <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                @endif
                <div class="relative flex items-center">
                    <span class="absolute left-3 text-gray-400">
                        <i class="fas fa-search text-xs"></i>
                    </span>
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari nama, npm, kelas..." 
                        class="border rounded pl-8 pr-8 py-1 outline-none focus:border-blue-400 w-64 text-sm">
                    
                    @if(request('keyword'))
                        <a href="{{ route('kompensasi.index') }}" class="absolute right-2.5 text-gray-400 hover:text-gray-600 transition">
                            <i class="fas fa-times-circle"></i>
                        </a>
                    @endif
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition">
                    Cari
                </button>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-[#63A0EF] text-white text-sm">
                     @if(Auth::user()->level == 1)
                    <th class="p-2 border border-blue-400 text-center w-10"><input type="checkbox" id="select-all"></th>
                    @endif
                    <th class="p-2 border border-blue-400 text-left">No</th>
                    <th class="p-2 border border-blue-400 text-left">Kelas</th>
                    <th class="p-2 border border-blue-400 text-left">NPM</th>
                    <th class="p-2 border border-blue-400 text-left">Nama</th>
                    <th class="p-2 border border-blue-400 text-left">Alfa</th>
                    <th class="p-2 border border-blue-400 text-left">Kompensasi</th>
                    <th class="p-2 border border-blue-400 text-left">Satuan</th>
                    @if(Auth::user()->level == 1)
                    <th class="p-2 border border-blue-400 text-center">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
                @forelse($kompensasi as $item)
                    <tr class="hover:bg-gray-50 border-b">
                         @if(Auth::user()->level == 1)
                        <td class="p-2 border text-center">
                            <input type="checkbox" name="id_mahasiswa[]" value="{{ $item->id_mahasiswa }}" form="form-hapus-massal" class="cb-mahasiswa">
                        </td>
                        @endif
                        <td class="p-2 border text-center">
                            {{ ($kompensasi->currentPage() - 1) * $kompensasi->perPage() + $loop->iteration }}
                        </td>
                        <td class="p-2 border">{{ $item->kelas ?? '-' }}</td>
                        <td class="p-2 border font-mono">{{ $item->npm ?? '-' }}</td>
                        <td class="p-2 border font-medium text-gray-900">{{ $item->nama ?? 'N/A' }}</td>
                        <td class="p-2 border font-semibold text-orange-600">{{ $item->total_alfa }}</td>
                        <td class="p-2 border font-semibold text-blue-600">{{ $item->total_kompensasi }}</td>
                        <td class="p-2 border text-gray-400 italic">Jam</td>
                        @if(Auth::user()->level == 1)
                        <td class="p-2 border text-center">
                            <div class="flex justify-center gap-1">
                                <a href="{{ route('kompensasi.show', $item->id_mahasiswa) }}" class="bg-cyan-400 hover:bg-cyan-500 text-white p-1 rounded text-xs transition flex items-center justify-center w-6 h-6">
                                    <i class="fas fa-eye"></i>
                                </a>
                                {{-- // dialihkan --}}
                            {{-- {{-- <a href="{{ route('kompensasi.edit', $item->id_mahasiswa) }}" class="bg-blue-500 text-white p-1 rounded text-xs w-6 h-6">
                                <i class="fas fa-edit"></i>
                            </a> 
                                
                            <button type="button" onclick="hapusSatuData('{{ $item->id_mahasiswa }}')" class="bg-red-500 text-white p-1 rounded text-xs w-6 h-6 hover:bg-red-600 transition">
                                <i class="fas fa-trash"></i>
                            </button> --}}
                            </div>
                        </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="p-4 border text-center text-gray-500 bg-gray-50">
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

<form id="form-hapus-satuan" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<div class="mt-4">
        {{ $kompensasi->links() }}
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('.cb-mahasiswa');
        const btnHapusTerpilih = document.getElementById('btn-hapus-terpilih');
        const formHapusMassal = document.getElementById('form-hapus-massal');

        function toggleButtonState() {
            const checkedCount = document.querySelectorAll('.cb-mahasiswa:checked').length;
            if (checkedCount > 0) {
                btnHapusTerpilih.removeAttribute('disabled');
                btnHapusTerpilih.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                btnHapusTerpilih.setAttribute('disabled', 'true');
                btnHapusTerpilih.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => {
                cb.checked = this.checked;
            });
            toggleButtonState();
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                const allChecked = document.querySelectorAll('.cb-mahasiswa:checked').length === checkboxes.length;
                selectAll.checked = allChecked;
                toggleButtonState();
            });
        });

        btnHapusTerpilih.addEventListener('click', function() {
            const totalTerpilih = document.querySelectorAll('.cb-mahasiswa:checked').length;
            if (confirm(`Apakah Anda yakin ingin menghapus seluruh data kompensasi dari ${totalTerpilih} mahasiswa yang terpilih?`)) {
                formHapusMassal.submit();
            }
        });
    });

    function hapusSatuData(id) {
        if (confirm('Apakah Anda yakin ingin menghapus seluruh riwayat kompensasi mahasiswa ini?')) {
            const form = document.getElementById('form-hapus-satuan');
            form.action = `/kompensasi/${id}`;
            form.submit();
        }
    }

    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.toggle('hidden');
    }
</script>
@endsection

<div id="modal-import" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900 bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full overflow-hidden">
        <div class="bg-green-500 text-white px-4 py-3 flex justify-between items-center">
            <h3 class="font-semibold text-sm flex items-center gap-1"><i class="fas fa-file-excel"></i> Import Data Kompensasi via Excel</h3>
            <button type="button" onclick="toggleModal('modal-import')" class="text-white hover:text-gray-200 text-lg">&times;</button>
        </div>
        <form action="{{ route('kompensasi.importExcel') }}" method="POST" enctype="multipart/form-data" class="p-4">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-700 mb-2">Pilih File Excel (.xlsx / .xls)</label>
                <input type="file" name="file_excel" accept=".xlsx, .xls, .csv" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 border rounded-lg p-1">
                <p class="text-[11px] text-gray-400 mt-1">*Pastikan kolom header sesuai: npm, mata_kuliah, dosen_pengampu, tanggal, jam_alfa, jam_kompensasi, keterangan.</p>
            </div>
            <div class="flex justify-end gap-2 border-t pt-3">
                <button type="button" onclick="toggleModal('modal-import')" class="px-3 py-1.5 bg-gray-100 text-gray-700 text-xs rounded hover:bg-gray-200 transition">Batal</button>
                <button type="submit" class="px-3 py-1.5 bg-green-500 text-white text-xs rounded hover:bg-green-600 transition">Mulai Import</button>
            </div>
        </form>
    </div>
</div>