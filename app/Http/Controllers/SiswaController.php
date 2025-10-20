<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    /**
     * Menampilkan daftar semua siswa dengan fitur filter berdasarkan kelas dan nama.
     */
    public function index(Request $request)
    {
        // 1. Ambil input filter dari URL
        $namaFilter = $request->query('nama');
        $kelasFilter = $request->query('kelas');

        // 2. Ambil semua nama kelas yang unik dari database untuk navbar filter
        // Ini cara yang dinamis dan lebih baik daripada menuliskannya manual
        $kelasList = Siswa::select('kelas')->distinct()->orderBy('kelas')->pluck('kelas');

        // 3. Query utama untuk mengambil data siswa
        $query = Siswa::query();

        // Terapkan filter kelas jika dipilih dari navbar
        if ($kelasFilter) {
            $query->where('kelas', $kelasFilter);
        }

        // Terapkan filter nama jika diisi di form pencarian
        if ($namaFilter) {
            $query->where('nama', 'like', '%' . $namaFilter . '%');
        }

        $siswa = $query->orderBy('nama', 'asc')->get();
        
        // Kirim semua data yang dibutuhkan ke view
        return view('siswa.index', compact('siswa', 'kelasList', 'kelasFilter', 'namaFilter'));
    }

    /**
     * Mengupdate data siswa di database.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validatedData = $request->validate([
            'nama'  => 'required|string|max:100',
            'kelas' => 'required|string|max:50',
            'uid'   => ['required', 'string', 'max:50', Rule::unique('siswa')->ignore($siswa->id)],
        ]);

        $siswa->update($validatedData);

        // Redirect kembali ke halaman daftar siswa dengan pesan sukses
        // dan tetap menjaga filter kelas yang aktif
        return redirect()->route('siswa.index', ['kelas' => $request->kelas])
                         ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Menghapus data siswa dari database.
     */
    public function destroy(Siswa $siswa)
    {
        $kelas = $siswa->kelas; // Simpan nama kelas sebelum dihapus
        $siswa->delete();

        // Redirect kembali ke halaman daftar siswa 
        // dan tetap menjaga filter kelas yang aktif
        return redirect()->route('siswa.index', ['kelas' => $kelas])
                         ->with('success', 'Data siswa berhasil dihapus.');
    }
}