<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Device; 
use App\Models\Jadwal;
use App\Models\Siswa;
use App\Models\Tambah;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    /**
     * Method untuk menangani kartu baru, tidak berubah.
     */
    public function tambah(Request $request)
    {
        $uid = strtoupper($request->query('tag'));

        if (!$uid) {
            return response("UID KOSONG", 400);
        }

        $siswaExists = Siswa::where('uid', $uid)->exists();
        if ($siswaExists) {
            return response("UID SUDAH TERDAFTAR", 200);
        }

        Tambah::firstOrCreate(
            ['tag' => $uid],
            ['tag' => $uid]
        );

        return response("UID BARU DITERIMA", 200);
    }

    /**
     * Method absensi yang sudah mendukung multi-lab.
     */
    public function absen(Request $request)
    {
        // 1. Ambil input dari alat RFID
        $uid = strtoupper($request->query('uid'));
        $deviceId = $request->query('device_id'); // <-- Menerima ID unik dari alat
        $waktuSekarang = Carbon::now();

        // 2. Validasi Alat dan cari tahu di Lab mana alat ini berada
        if (!$deviceId) {
            return response("DEVICE ID KOSONG", 400);
        }
        $device = Device::where('unique_id', $deviceId)->first();
        if (!$device) {
            return response("ALAT TIDAK DIKENALI", 403); // Error jika ID alat tidak terdaftar
        }
        $labId = $device->lab_id; // Kita dapatkan ID lab dari alat ini

        // 3. Cari Siswa berdasarkan UID Kartu
        $siswa = Siswa::where('uid', $uid)->first();
        if (!$siswa) {
            return response("BELUM TERDAFTAR", 200);
        }

        // 4. Cari Jadwal yang aktif HARI INI, SAAT INI, dan di LAB INI
        $jadwal = Jadwal::where('hari', $waktuSekarang->dayName)
            ->where('lab_id', $labId) // <-- KUNCI UTAMA: Filter berdasarkan lokasi lab
            ->whereTime('jam_mulai', '<=', $waktuSekarang->toTimeString())
            ->whereTime('jam_selesai', '>=', $waktuSekarang->toTimeString())
            ->first();

        if (!$jadwal) {
            return response("TIDAK ADA JADWAL DI LAB INI", 200);
        }

        // 5. Proses Absensi (logika ini sama seperti sebelumnya)
        $absensi = Absensi::where('siswa_id', $siswa->id)
            ->where('jadwal_id', $jadwal->id)
            ->first();

        if (!$absensi) {
            // KASUS 1: ABSEN MASUK
            $jamMulaiJadwal = Carbon::parse($jadwal->jam_mulai);
            // Toleransi keterlambatan 15 menit (bisa disesuaikan)
            $statusWaktu = $waktuSekarang->lte($jamMulaiJadwal->addMinutes(15)) ? 'Tepat Waktu' : 'Terlambat';

            Absensi::create([
                'siswa_id'    => $siswa->id,
                'jadwal_id'   => $jadwal->id,
                'jam_masuk'   => $waktuSekarang,
                'jam_keluar'  => null,
                'statuswaktu' => $statusWaktu,
            ]);

            return response("MASUK OK", 200);

        } elseif (is_null($absensi->jam_keluar)) {
            // KASUS 2: ABSEN KELUAR
            $absensi->update(['jam_keluar' => $waktuSekarang]);
            return response("KELUAR OK", 200);

        } else {
            // KASUS 3: SUDAH MASUK DAN KELUAR
            return response("SUDAH ABSEN", 200);
        }
    }
}