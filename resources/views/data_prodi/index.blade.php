@extends('layouts.master')

@section('title', 'Program Studi')

@section('breadcrumb')
    @parent
    <li class="text-gray-300">/</li>
    <li class="text-blue-500 font-medium">Program Studi</li>
@endsection

@section('content')
<div class="bg-white p-6 rounded-lg shadow-sm">

    <div class="flex gap-2 mb-4">
        <a href="{{ route('data_prodi.create') }}" class="bg-[#63A0EF] hover:bg-[#4a90e2] text-white px-4 py-1.5 rounded-md text-sm flex items-center gap-1 transition shadow-sm">
             + Tambah
        </a>
    </div>


    <div class="overflow-hidden rounded-lg border border-gray-200">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-[#63A0EF] text-white text-sm">
                    <th class="p-2 border border-blue-400 text-left">No</th>
                    <th class="p-2 border border-blue-400 text-left">Kode Prodi   </th>
                    <th class="p-2 border border-blue-400 text-left">Program Studi</th>
                    <th class="p-2 border border-blue-400 text-left">Kuota Prodi</th>
                    <th class="p-2 border border-blue-400 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
                @foreach ($prodi as $index => $p)        
                <tr class="hover:bg-gray-50 border-b">
                    <td class="p-2 border text-center">{{ $index + 1 }}</td>
                    <td class="p-2 border">{{ $p->kode_prodi }}</td>
                    <td class="p-2 border">{{ $p->nama_prodi }}</td>
                    <td class="p-2 border">{{ $p->kuota_prodi }}</td>
                    <td class="p-2 border text-center">
                        <div class="flex justify-center items-center gap-1">
                            <a href="{{ route('data_prodi.edit', $p->id_prodi) }}" class="bg-blue-500 text-white p-1 rounded text-xs flex items-center justify-center h-6 w-6">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <form action="{{ route('data_prodi.destroy', $p->id_prodi) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Program Studi ini?')">
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
</div>
@endsection