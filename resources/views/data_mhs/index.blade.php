@extends('layouts.master')

@section('title', 'Mahasiswa')

@section('breadcrumb')
    @parent
    <li class="text-gray-300">/</li>
    <li class="text-blue-500 font-medium">Mahasiswa</li>
@endsection

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm">

    <div class="flex gap-2 mb-4">
        <a href="{{ route('data_mhs.create') }}" class="bg-[#63A0EF] hover:bg-[#4a90e2] text-white px-4 py-1.5 rounded-md text-sm flex items-center gap-1 transition shadow-sm">
             + Tambah
        </a>
    </div>
    <hr>
    <br>

    <div class="flex justify-between items-center mb-4 text-sm text-gray-600">
    <div>
        <form action="{{ route('data_mhs.index') }}" method="GET" id="perPageForm" class="inline">
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
            <form action="{{ route('data_mhs.index') }}" method="GET" class="flex items-center gap-2">
                <div class="relative flex items-center">
                    <span class="absolute left-3 text-gray-400">
                        <i class="fas fa-search text-xs"></i>
                    </span>
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari nama, npm, email..." 
                        class="border rounded pl-8 pr-8 py-1 outline-none focus:border-blue-400 w-64 text-sm">
                    
                    @if(request('keyword'))
                        <a href="{{ route('data_mhs.index') }}" class="absolute right-2.5 text-gray-400 hover:text-gray-600 transition">
                            <i class="fas fa-times-circle"></i>
                        </a>
                    @endif
                </div>
                <button type="submit" class="bg-[#63A0EF] hover:bg-[#4a90e2] text-white px-3 py-1 rounded-md text-sm flex items-center gap-1 transition shadow-sm">
                    Cari
                </button>
            </form>
        </div>
    </div>


    <div class="overflow-hidden rounded-lg border border-gray-200">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-[#63A0EF] text-white text-sm">
                    <th class="p-2 border border-blue-400 text-left">No</th>
                    <th class="p-2 border border-blue-400 text-left">Nama</th>
                    <th class="p-2 border border-blue-400 text-left">NPM</th>
                    <th class="p-2 border border-blue-400 text-left">Email</th>
                    <th class="p-2 border border-blue-400 text-left">Prodi</th>
                    <th class="p-2 border border-blue-400 text-left">Kelas</th>
                    <th class="p-2 border border-blue-400 text-left">Username</th>
                    <th class="p-2 border border-blue-400 text-center">Aksi</th>
                </tr>
            </thead>
            
            <tbody class="text-sm text-gray-700">
                @foreach ($mahasiswa as $m)
                <tr class="hover:bg-gray-50 border-b">
                    <td class="p-2 border text-center w-10">
                        {{ ($mahasiswa->currentPage() - 1) * $mahasiswa->perPage() + $loop->iteration }}
                    </td>                    <td class="p-2 border font-medium text-gray-900">{{ $m->nama }}</td>
                    <td class="p-2 border font-mono">{{ $m->npm }}</td>
                    <td class="p-2 border">{{ $m->email }}</td>
                    
                    <td class="p-2 border">{{ $m->prodi->nama_prodi ?? 'Prodi Tidak Ditemukan' }}</td>
                    
                    <td class="p-2 border">{{ $m->kelas }}</td>
                    
                    <td class="p-2 border font-mono text-gray-600">{{ $m->user->username ?? '-' }}</td>
                    
                    <td class="p-2 border text-center">
                        <div class="flex justify-center gap-1">
                            <a href="{{ route('data_mhs.edit', $m->id_mahasiswa) }}" class="bg-blue-500 hover:bg-blue-600 text-white p-1 rounded text-xs transition"><i class="fas fa-edit"></i></a>

                            <form action="{{ route('data_mhs.destroy', $m->id_mahasiswa) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Mahasiswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white p-1 rounded text-xs flex items-center justify-center h-6 w-6 hover:bg-red-600 transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

                
                @endforeach
            </tbody>
        </table>
    </div>

<div class="mt-4">
        {{ $mahasiswa->links() }}
    </div>
    </div>
</div>
@endsection