<aside class="w-56 bg-[#63A0EF] text-white flex flex-col shrink-0 min-h-screen">    
    <div class="px-5 h-16 flex items-center gap-2 border-b border-white/10 mb-2">
        <div class="shrink-0">
            <img src="{{ asset('img/jkb.png') }}" 
                 alt="Logo" 
                 class="w-8 h-8 object-contain rounded">
        </div>
        <span class="font-bold text-base text-white tracking-tight uppercase">SM-Kompensasi</span>
    </div>

    <nav class="flex-1 px-3 py-2 space-y-1 overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded transition text-xs font-semibold {{ request()->routeIs('dashboard') ? 'bg-white/25 text-white' : 'text-white hover:bg-white/10' }}">
            <i class="fas fa-tachometer-alt w-4 text-center"></i>
            <span>Dashboard</span>
        </a>

        <!-- Kompensasi -->
        <div class="pt-4 pb-1">
            <p class="px-3 text-[9px] font-bold text-blue-100 uppercase tracking-widest opacity-80">Kompensasi</p>
        </div>
        <a href="{{ route('kompensasi.index') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded transition text-xs {{ request()->routeIs('kompensasi.*') ? 'bg-white/25 text-white font-semibold' : 'text-white hover:bg-white/10' }}">
            <i class="fas fa-shapes w-4 text-center"></i>
            <span>Kompensasi</span>
        </a>
        
        @if(Auth::user()->level == 1)
        <a href="{{ route('pengajuan_banding.index') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded transition text-xs {{ request()->routeIs('pengajuan_banding.*') ? 'bg-white/25 text-white font-semibold' : 'text-white hover:bg-white/10' }}">
            <i class="fas fa-pencil-alt w-4 text-center"></i>
            <span>Pengajuan Banding</span>
        </a>
            
        <!-- Data -->
        <div class="pt-4 pb-1">
            <p class="px-3 text-[9px] font-bold text-blue-100 uppercase tracking-widest opacity-80">Data</p>
        </div>
        <a href="{{ route('data_mhs.index') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded transition text-xs {{ request()->routeIs('data_mhs.*') ? 'bg-white/25 text-white font-semibold' : 'text-white hover:bg-white/10' }}">
            <i class="fas fa-user w-4 text-center"></i>
            <span>Data Mahasiswa</span>
        </a>
        <a href="{{ route('data_prodi.index') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded transition text-xs {{ request()->routeIs('data_prodi.*') ? 'bg-white/25 text-white font-semibold' : 'text-white hover:bg-white/10' }}">
            <i class="fas fa-book w-4 text-center"></i>
            <span>Data Program Studi</span>
        </a>
        @endif

        @if(Auth::user()->level == 2)
        <a href="" 
           class="flex items-center gap-2 px-3 py-2 rounded transition text-xs {{ request()->routeIs('pengajuan_banding.*') ? 'bg-white/25 text-white font-semibold' : 'text-white hover:bg-white/10' }}">
            <i class="fas fa-pencil-alt w-4 text-center"></i>
            <span>Pengajuan Banding</span>
        </a>

        <a href="" 
           class="flex items-center gap-2 px-3 py-2 rounded transition text-xs {{ request()->routeIs('riwayat_banding.*') ? 'bg-white/25 text-white font-semibold' : 'text-white hover:bg-white/10' }}">
            <i class="fas fa-history text-xs w-4 text-center"></i>
            <span>Riwayat Banding</span>
        </a>
        @endif
        
        <div class="pt-4 pb-1">
            <p class="px-3 text-[9px] font-bold text-blue-100 uppercase tracking-widest opacity-80">Menu Lainnya</p>
        </div>
        <form action="{{ route('logout') }}" method="get" class="block">
            @csrf
            <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 hover:bg-white/10 rounded transition text-xs text-white">
                <i class="fas fa-sign-out-alt w-4 text-center transform rotate-180"></i>
                <span>Keluar</span>
            </button>
        </form>
    </nav>
</aside>