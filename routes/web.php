<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TambahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AbsensiManualController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AbsenController; 
use App\Http\Controllers\LabManagementController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\GuruController;
use App\Models\Absensi;
use App\Models\Tambah;

// halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// halaman yang butuh login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // KESALAHAN #1 SUDAH DIPASTIKAN BENAR DI SINI
    Route::get('/absensi-lab', [AbsenController::class, 'index'])->name('absensi.lab');

    Route::resource('siswa', SiswaController::class);
    Route::get('/tambah', [TambahController::class, 'index'])->name('tambah.index');
});

Route::get('lab/{jurusan}', [LabController::class, 'show'])->name('lab.show');

// redirect root "/" langsung ke login atau dashboard (opsional)
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route untuk menangani aksi checkout manual
    Route::put('absensi/{absen}/checkout', [AbsensimanualController::class, 'manualCheckout'])->name('absensi.checkout');

    Route::resource('siswa', SiswaController::class);
    Route::resource('jadwal', JadwalController::class);
    // Route untuk menampilkan halaman tambah
    Route::get('/tambah', [TambahController::class, 'index'])->name('tambah.index');
    
    // Route untuk memproses form tambah
    Route::post('/tambah', [TambahController::class, 'store'])->name('tambah.store'); 
    Route::resource('labs', LabManagementController::class); 
    Route::resource('devices', DeviceController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('jurnal', JurnalController::class);
    Route::post('jurnal/{jurnal}/absensi', [JurnalController::class, 'storeAbsensi'])->name('jurnal.absensi.store');
    Route::resource('mata-pelajaran', MataPelajaranController::class);
    Route::resource('guru', GuruController::class);
});