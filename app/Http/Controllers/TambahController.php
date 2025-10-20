<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tambah;
use App\Models\Siswa;

class TambahController extends Controller
{
    // Menampilkan daftar UID baru & form tambah siswa
    public function index()
{
    $uidBaru = Tambah::all();
    // Ambil daftar kelas dari file config
    $kelasList = config('kelas.list');
    return view('tambah.index', compact('uidBaru', 'kelasList'));
}

    // Menyimpan data siswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kelas' => 'required|string|max:50',
            'uid' => 'required|string|unique:siswa,uid|max:50',
        ]);

        Siswa::create([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'uid' => strtoupper($request->uid),
        ]);

        // Hapus dari tabel tambah setelah ditambahkan ke siswa
        Tambah::where('tag', $request->uid)->delete();

        return redirect()->route('tambah.index')->with('success', 'Siswa berhasil ditambahkan.');
    }
}
