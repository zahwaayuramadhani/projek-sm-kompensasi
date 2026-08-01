<header class="w-full bg-white h-12 flex items-center justify-end px-5 shadow-sm z-20 border-b border-gray-100 shrink-0">
    <div class="flex items-center gap-3">
        <span class="text-gray-700 text-xs font-semibold px-8">
            {{ Auth::user()->level == 1 ? Auth::user()->name : (Auth::user()->mahasiswa->nama ?? Auth::user()->name) }}
            
            <span class="text-gray-300 font-normal mx-2">|</span>
            
            <span class="text-blue-500 font-medium">
                {{ Auth::user()->level == 1 ? 'Admin Jurusan' : 'Mahasiswa' }}
            </span>
        </span>
    </div>
</header>