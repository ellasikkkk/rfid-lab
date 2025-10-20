<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\Jadwal; // <-- Pastikan Model Jadwal di-import
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // --- Statistik Umum Kehadiran Siswa ---
        $totalSiswa = Siswa::count();
        $hadirHariIni = Absensi::whereDate('jam_masuk', $today)->pluck('siswa_id')->unique();
        $jumlahHadir = $hadirHariIni->count();
        $masihDiLab = Absensi::whereIn('siswa_id', $hadirHariIni)->whereDate('jam_masuk', $today)->whereNull('jam_keluar')->count();
        $pulangHariIni = $jumlahHadir - $masihDiLab;
        $tidakHadir = $totalSiswa - $jumlahHadir;

        // --- LOGIKA BARU: MENGAMBIL SEMUA JADWAL UNTUK HARI INI ---
        // Carbon::now()->dayName akan menghasilkan nama hari dalam bahasa Inggris (e.g., 'Sunday')
        $jadwalHariIni = Jadwal::where('hari', $today->dayName)
                                ->with('lab') // Ambil data relasi lab untuk ditampilkan
                                ->orderBy('jam_mulai', 'asc') // Urutkan dari jadwal paling pagi
                                ->get();

        // --- Mengambil 10 absensi terbaru (Tetap Sama) ---
        $latest = Absensi::with(['siswa', 'jadwal.lab'])
            ->whereDate('jam_masuk', $today)
            ->orderByDesc('jam_masuk')
            ->take(10)
            ->get();

        // Kirim data baru '$jadwalHariIni' ke view
        return view('home', compact(
            'totalSiswa',
            'pulangHariIni',
            'tidakHadir',
            'masihDiLab',
            'jadwalHariIni', // <-- DATA BARU UNTUK DITAMPILKAN DI VIEW
            'latest'
        ));
    }
}