<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenController;

/*
|--------------------------------------------------------------------------
| API Routes for ESP32 System (Fase 1)
|--------------------------------------------------------------------------
|
| Rute-rute ini khusus untuk menerima data dari perangkat ESP32.
| URL akan otomatis diawali dengan /api, contoh: /api/v1/absen
|
*/

Route::prefix('v1')->group(function () {
    
    // Endpoint untuk menangani pendaftaran kartu baru
    // URL: /api/v1/tambah?tag=UID_KARTU
    Route::get('/tambah', [AbsenController::class, 'tambah']);

    // Endpoint untuk menangani absensi masuk/keluar
    // URL: /api/v1/absen?uid=UID_KARTU&device_id=ID_ALAT
    Route::get('/absen', [AbsenController::class, 'absen']); 

});

// Catatan: Route untuk ApiController (Raspberry Pi) telah dihapus untuk sementara
// agar kita bisa fokus pada sistem ESP32. Kita akan menambahkannya kembali di Fase 2.