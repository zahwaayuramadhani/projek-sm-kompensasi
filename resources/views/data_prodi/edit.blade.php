@extends('layouts.master')

@section('title', 'Edit Data Prodi')

@section('breadcrumb')
    @parent
    <li class="text-gray-300">/</li>
    <li class="text-blue-500 font-medium">Edit Data Prodi</li>
@endsection

@section('content')
<div class="container mx-auto px-4">
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden w-full">
        <div class="flex items-center gap-3 px-6 pt-5 pb-1">
            <div class="bg-blue-100 p-2 rounded-lg"> 
                <i class="fas fa-edit text-blue-600"></i>
            </div>
            <h3 class="font-bold text-gray-800 uppercase tracking-wider text-sm">Edit Data Prodi</h3>
        </div>

        <div class="px-6 py-4">
            <form action="{{ route('data_prodi.update', $prodi->id_prodi) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="flex flex-col mb-2">
                    <label class="text-[11px] font-bold text-gray-700 mb-0.5 ml-1 uppercase">Program Studi</label>
                    <input type="text" name="nama_prodi" value="{{ old('nama_prodi', $prodi->nama_prodi) }}" placeholder="Contoh : Teknik Informatika" 
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition text-sm">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="flex flex-col">
                        <label class="text-[11px] font-bold text-gray-700 mb-0.5 ml-1 uppercase">Kode Prodi</label>
                        <input type="text" name="kode_prodi" value="{{ old('kode_prodi', $prodi->kode_prodi) }}" placeholder="Contoh : TI" 
                            class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition text-sm">
                    </div>
                    <div class="flex flex-col">
                        <label class="text-[11px] font-bold text-gray-700 mb-0.5 ml-1 uppercase">Kuota Prodi</label>
                        <input type="text" name="kuota_prodi" value="{{ old('kuota_prodi', $prodi->kuota_prodi) }}" placeholder="Masukan Kuota Prodi" 
                            class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition text-sm">
                    </div>
                </div>

                <div class="flex justify-end gap-2 pt-2 pb-2">
                    <a href="{{ route('data_prodi.index') }}" class="px-4 py-1.5 bg-gray-200 text-gray-700 rounded-md text-sm flex items-center gap-1 transition shadow-sm hover:bg-gray-300 font-medium">
                        <i class="fas fa-times-circle text-gray-500"></i> Batal
                    </a>
                    <button type="submit" class="bg-[#63A0EF] hover:bg-[#4a90e2] text-white px-4 py-1.5 rounded-md text-sm flex items-center gap-1 transition shadow-sm font-medium">
                        Simpan Perubahan <i class="fas fa-save text-[10px]"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection