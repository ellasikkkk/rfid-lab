<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    /**
     * Menampilkan daftar semua guru.
     */
    public function index()
    {
        $gurus = Guru::orderBy('nama_guru')->get();
        return view('guru.index', compact('gurus'));
    }

    /**
     * Menampilkan form untuk membuat data guru baru.
     */
    public function create()
    {
        return view('guru.create');
    }

    /**
     * Menyimpan data guru baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_guru' => 'required|string|max:255|unique:gurus,nama_guru',
            'nip' => 'nullable|string|max:50|unique:gurus,nip',
        ]);

        Guru::create($validatedData);

        return redirect()->route('guru.index')->with('success', 'Data guru baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan data spesifik (tidak digunakan).
     */
    public function show(Guru $guru)
    {
        return redirect()->route('guru.index');
    }

    /**
     * Menampilkan form untuk mengedit data guru.
     */
    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    /**
     * Mengupdate data guru di database.
     */
    public function update(Request $request, Guru $guru)
    {
        $validatedData = $request->validate([
            'nama_guru' => [
                'required',
                'string',
                'max:255',
                Rule::unique('gurus')->ignore($guru->id),
            ],
            'nip' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('gurus')->ignore($guru->id),
            ],
        ]);

        $guru->update($validatedData);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Menghapus data guru dari database.
     */
    public function destroy(Guru $guru)
    {
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}