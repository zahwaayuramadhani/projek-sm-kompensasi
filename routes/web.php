    <?php

    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\DataMahasiswaController;
    use App\Http\Controllers\DataProdiController;
    use App\Http\Controllers\KompensasiController;
    use App\Http\Controllers\PengajuanBandingController;
    use Illuminate\Support\Facades\Route;

    // Route untuk user belum login (guest)
    Route::middleware('guest')->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('/login', 'index')->name('login');
            Route::post('/login', 'login')->name('login.proses');

            Route::get('/register', 'showRegister')->name('register');
            Route::post('/register', 'register');
        });
    });

    // Route untuk user yang sudah login (auth)
    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/kompensasi/export-pdf', [KompensasiController::class, 'exportPdf'])->name('kompensasi.exportPdf');

        // MIDDLEWARE LEVEL 1: ADMIN
        Route::group(['middleware' => ['auth','level:1']], function () {
            Route::resource('/data_prodi', DataProdiController::class);
            Route::get('/data_mhs/search', [DataMahasiswaController::class, 'search'])->name('data_mhs.search');
            Route::resource('/data_mhs', DataMahasiswaController::class);
            
            Route::resource('/pengajuan_banding', PengajuanBandingController::class);

            Route::patch('/data-banding/{id}/update-status', [PengajuanBandingController::class, 'updateStatus'])
                ->name('data_banding.update_status');
                    
            Route::post('/kompensasi/import-excel', [KompensasiController::class, 'importExcel'])->name('kompensasi.importExcel');
            Route::delete('/kompensasi/destroy-massal', [KompensasiController::class, 'destroyMassal'])->name('kompensasi.destroyMassal');
            Route::resource('/kompensasi', KompensasiController::class);
            });

            Route::get('/mahasiswa/{id}/edit', [DataMahasiswaController::class, 'edit'])->name('data_mhs.edit');

        // MIDDLEWARE LEVEL 2: MAHASISWA
        Route::group(['middleware' => ['auth','level:2']], function () {
            Route::get('/mahasiswa/kompensasi', [KompensasiController::class, 'index'])->name('mahasiswa.kompensasi.index');
            Route::get('/mahasiswa/pengajuan_banding', [PengajuanBandingController::class, 'create'])->name('mahasiswa.pengajuan_banding.create');
            Route::post('/mahasiswa/pengajuan_banding', [PengajuanBandingController::class, 'store'])->name('mahasiswa.pengajuan_banding.store');
            Route::get('/mahasiswa/riwayat-banding', [PengajuanBandingController::class, 'riwayat'])->name('mahasiswa.riwayat_banding');
            // Route::get('/kompensasi', [KompensasiController::class, 'show'])->name('kompensasiShow');
        });
    });