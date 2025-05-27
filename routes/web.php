<?php
// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BeasiswaController as AdminBeasiswaController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Peserta\DashboardController as PesertaDashboardController;
use App\Http\Controllers\Peserta\BeasiswaController as PesertaBeasiswaController;
use App\Http\Controllers\Peserta\PendaftaranController as PesertaPendaftaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes untuk autentikasi
Route::get('/masuk', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/masuk', [LoginController::class, 'login']);
Route::post('/keluar', [LoginController::class, 'logout'])->name('logout');

Route::get('/daftar', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/daftar', [RegisterController::class, 'register'])->name('register.post');

// Routes untuk Admin (hanya bisa diakses oleh admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('beasiswa', AdminBeasiswaController::class);
    // Manajemen Pendaftaran
    Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
        Route::get('/', [AdminPendaftaranController::class, 'index'])->name('index');
        Route::get('/{pendaftaran}', [AdminPendaftaranController::class, 'show'])->name('show');
        Route::patch('/{pendaftaran}/terima', [AdminPendaftaranController::class, 'terima'])->name('terima');
        Route::patch('/{pendaftaran}/tolak', [AdminPendaftaranController::class, 'tolak'])->name('tolak');
    });
});

// Routes untuk Peserta (hanya bisa diakses oleh peserta)
Route::middleware(['auth', 'peserta'])->prefix('peserta')->name('peserta.')->group(function () {
    Route::get('/dashboard', [PesertaDashboardController::class, 'index'])->name('dashboard');
    // Lihat Beasiswa
    Route::prefix('beasiswa')->name('beasiswa.')->group(function () {
        Route::get('/', [PesertaBeasiswaController::class, 'index'])->name('index');
        Route::get('/{beasiswa}', [PesertaBeasiswaController::class, 'show'])->name('show');
        Route::get('/{beasiswa}/daftar', [PesertaBeasiswaController::class, 'daftar'])->name('daftar');
        Route::post('/{beasiswa}/daftar', [PesertaBeasiswaController::class, 'storeDaftar'])->name('store-daftar');
    });
    // Lihat Pendaftaran
    Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
        Route::get('/', [PesertaPendaftaranController::class, 'index'])->name('index');
        Route::get('/{pendaftaran}', [PesertaPendaftaranController::class, 'show'])->name('show');
    });
});

// Route model binding untuk parameter yang menggunakan nama khusus
Route::bind('beasiswa', function ($value) {
    return \App\Models\Beasiswa::findOrFail($value);
});

Route::bind('pendaftaran', function ($value) {
    return \App\Models\PendaftaranBeasiswa::findOrFail($value);
});