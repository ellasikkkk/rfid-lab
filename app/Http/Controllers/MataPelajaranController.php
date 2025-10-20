<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MataPelajaranController extends Controller
{
    /**
     * Menampilkan daftar semua mata pelajaran.
     */
    public function index()
    {
        $mataPelajarans = MataPelajaran::orderBy('nama_mapel')->get();
        return view('mata-pelajaran.index', compact('mataPelajarans'));
    }

    /**
     * Menampilkan form untuk membuat mata pelajaran baru.
     */
    public function create()
    {
        return view('mata-pelajaran.create');
    }

    /**
     * Menyimpan mata pelajaran baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_mapel' => 'required|string|max:255|unique:mata_pelajarans,nama_mapel',
            'jurusan' => 'nullable|string|max:255',
        ]);

        MataPelajaran::create($validatedData);

        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata pelajaran baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan data spesifik (tidak digunakan, tapi ada karena --resource).
     */
    public function show(MataPelajaran $mataPelajaran)
    {
        return redirect()->route('mata-pelajaran.index');
    }

    /**
     * Menampilkan form untuk mengedit mata pelajaran.
     */
    public function edit(MataPelajaran $mataPelajaran)
    {
        return view('mata-pelajaran.edit', compact('mataPelajaran'));
    }

    /**
     * Mengupdate mata pelajaran di database.
     */
    public function update(Request $request, MataPelajaran $mataPelajaran)
    {
        $validatedData = $request->validate([
            'nama_mapel' => [
                'required',
                'string',
                'max:255',
                Rule::unique('mata_pelajarans')->ignore($mataPelajaran->id),
            ],
            'jurusan' => 'nullable|string|max:255',
        ]);

        $mataPelajaran->update($validatedData);

        return redirect()->route('mata-pelajaran.index')->with('success', 'Data mata pelajaran berhasil diperbarui.');
    }

    /**
     * Menghapus mata pelajaran dari database.
     */
    public function destroy(MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->delete();

        return redirect()->route('mata-pelajaran.index')->with('success', 'Data mata pelajaran berhasil dihapus.');
    }
}