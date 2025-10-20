<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use Illuminate\Http\Request;

class LabManagementController extends Controller
{
    // Menampilkan daftar semua lab
    public function index()
    {
        $labs = Lab::all();
        return view('labs.index', compact('labs'));
    }

    // Menampilkan form untuk membuat lab baru
    public function create()
    {
        return view('labs.create');
    }

    // Menyimpan lab baru ke database
    public function store(Request $request)
{
    // Simpan hasil validasi ke dalam variabel
    $validatedData = $request->validate([
        'nama_lab' => 'required|string|max:255|unique:labs,nama_lab',
        'lokasi' => 'nullable|string|max:255',
    ]);

    // Gunakan variabel tersebut untuk membuat data baru
    Lab::create($validatedData);

    return redirect()->route('labs.index')
                     ->with('success', 'Ruangan lab baru berhasil ditambahkan.');
}

// Menampilkan form untuk mengedit lab
public function edit(Lab $lab)
{
    return view('labs.edit', compact('lab'));
}

// Mengupdate lab yang ada di database
public function update(Request $request, Lab $lab)
{
    // Simpan hasil validasi ke dalam variabel
    $validatedData = $request->validate([
        'nama_lab' => 'required|string|max:255|unique:labs,nama_lab,' . $lab->id,
        'lokasi' => 'nullable|string|max:255',
    ]);

    // Gunakan variabel tersebut untuk mengupdate data
    $lab->update($validatedData);

    return redirect()->route('labs.index')
                     ->with('success', 'Data lab berhasil diperbarui.');
}


    // Menghapus lab dari database
    public function destroy(Lab $lab)
    {
        // PENTING: Tambahkan logika untuk menangani jadwal yang masih terhubung dengan lab ini jika diperlukan
        // Untuk saat ini, kita langsung hapus saja.
        $lab->delete();

        return redirect()->route('labs.index')
                         ->with('success', 'Data lab berhasil dihapus.');
    }
}