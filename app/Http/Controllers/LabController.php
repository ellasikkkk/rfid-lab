<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabController extends Controller
{
    public function show(Request $request, $jurusan)
    {
        $jurusan = strtoupper(urldecode($jurusan));
        $tanggal = $request->query('tanggal', now()->toDateString());
        $filterStatus = $request->query('status', 'semua');

        $siswa = Siswa::query()
            ->where('siswa.kelas', 'like', '%' . $jurusan . '%')
            ->leftJoin('absensi', function ($join) use ($tanggal) {
                $join->on('siswa.id', '=', 'absensi.siswa_id')
                     ->whereDate('absensi.jam_masuk', $tanggal);
            })
            ->leftJoin('jadwals', 'absensi.jadwal_id', '=', 'jadwals.id')
            // --- GABUNGKAN DENGAN TABEL LABS UNTUK MENGAMBIL NAMA LAB ---
            ->leftJoin('labs', 'jadwals.lab_id', '=', 'labs.id') 
            
            ->selectRaw("
                siswa.*,
                absensi.id as absensi_id,
                absensi.jam_masuk,
                absensi.jam_keluar,
                jadwals.mapel as mata_pelajaran,
                labs.nama_lab, -- <-- AMBIL NAMA LAB
                CASE
                    WHEN absensi.jam_masuk IS NOT NULL AND absensi.jam_keluar IS NOT NULL THEN 'Sudah Keluar'
                    WHEN absensi.jam_masuk IS NOT NULL AND absensi.jam_keluar IS NULL THEN 'Masih di Lab'
                    ELSE 'Belum Absen'
                END as status
            ")
            ->when($filterStatus !== 'semua', function ($query) use ($filterStatus) {
                $statusMap = [
                    'masih' => 'Masih di Lab',
                    'keluar' => 'Sudah Keluar',
                    'belum' => 'Belum Absen'
                ];
                return $query->having('status', '=', $statusMap[$filterStatus]);
            })
            ->orderBy('siswa.nama', 'asc')
            ->get();

        return view('lab.show', [
            'jurusan' => $jurusan,
            'tanggal' => $tanggal,
            'siswa' => $siswa,
            'filterStatus' => $filterStatus,
        ]);
    }
}