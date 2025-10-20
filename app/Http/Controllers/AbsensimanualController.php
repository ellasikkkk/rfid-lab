<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AbsensimanualController extends Controller
{
    /**
     * Mengisi jam keluar secara manual untuk siswa yang lupa tap kartu.
     */
    public function manualCheckout(Absensi $absen)
    {
        // Pastikan kita hanya meng-update jika jam_keluar masih kosong
        if (is_null($absen->jam_keluar)) {
            $absen->update([
                'jam_keluar' => Carbon::now() // Isi jam_keluar dengan waktu sekarang
            ]);
            return back()->with('success', 'Siswa berhasil di-checkout secara manual.');
        }

        return back()->with('error', 'Siswa ini sudah melakukan checkout sebelumnya.');
    }
}