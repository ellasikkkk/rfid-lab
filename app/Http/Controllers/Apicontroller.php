<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\Absensi;
use Carbon\Carbon;

class ApiController extends Controller
{
    /**
     * Dipanggil saat kartu di-tap.
     * Mencari siswa dan jadwal yang tersedia untuknya saat ini.
     */
    public function getAvailableSchedulesForSiswa($uid)
    {
        $waktuSekarang = Carbon::now();
        $siswa = Siswa::where('uid', strtoupper($uid))->first();

        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }

        // Cari jadwal aktif berdasarkan kelas/jurusan siswa
        $jadwals = Jadwal::where('hari', $waktuSekarang->dayName)
            ->where(function($query) use ($siswa) {
                $query->where('jurusan', $siswa->jurusan) // Asumsi ada kolom 'jurusan' di model Siswa
                      ->orWhere('jurusan', 'like', '%' . $siswa->kelas . '%');
            })
            ->whereTime('jam_mulai', '<=', $waktuSekarang->toTimeString())
            ->whereTime('jam_selesai', '>=', $waktuSekarang->toTimeString())
            ->with('lab') // Ambil juga nama lab-nya
            ->get();

        // Jika tidak ada jadwal, tetap kirim data siswa agar bisa menampilkan nama
        return response()->json([
            'siswa' => $siswa,
            'jadwals' => $jadwals,
        ]);
    }

    /**
     * Dipanggil setelah siswa memilih jadwal di layar.
     * Mencatat absensi masuk atau keluar.
     */
    public function recordAttendance(Request $request)
    {
        $validated = $request->validate([
            'uid' => 'required|string|exists:siswa,uid',
            'jadwal_id' => 'required|integer|exists:jadwals,id',
        ]);

        $waktuSekarang = Carbon::now();
        $siswa = Siswa::where('uid', $validated['uid'])->first();
        $jadwal = Jadwal::with('lab')->find($validated['jadwal_id']);

        // Cek absensi yang mungkin sudah ada
        $absensi = Absensi::where('siswa_id', $siswa->id)
            ->where('jadwal_id', $jadwal->id)
            ->first();

        if (!$absensi) { // Absen Masuk
            $jamMulaiJadwal = Carbon::parse($jadwal->jam_mulai);
            $statusWaktu = $waktuSekarang->lte($jamMulaiJadwal->addMinutes(15)) ? 'Tepat Waktu' : 'Terlambat';

            Absensi::create([
                'siswa_id'    => $siswa->id,
                'jadwal_id'   => $jadwal->id,
                'jam_masuk'   => $waktuSekarang,
                'statuswaktu' => $statusWaktu,
            ]);

            return response()->json([
                'message' => 'Absen Masuk Berhasil!',
                'nama' => $siswa->nama,
                'lab' => $jadwal->lab->nama_lab,
                'waktu' => $waktuSekarang->format('H:i:s')
            ]);

        } elseif (is_null($absensi->jam_keluar)) { // Absen Keluar
            $absensi->update(['jam_keluar' => $waktuSekarang]);

            return response()->json([
                'message' => 'Absen Keluar Berhasil!',
                'nama' => $siswa->nama,
                'lab' => $jadwal->lab->nama_lab,
                'waktu' => $waktuSekarang->format('H:i:s')
            ]);
        } else { // Sudah selesai
            return response()->json(['message' => 'Anda sudah menyelesaikan sesi di lab ini.'], 400);
        }
    }
}