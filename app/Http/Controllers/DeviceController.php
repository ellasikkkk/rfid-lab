<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Lab; // <-- Kita butuh ini untuk menampilkan pilihan lab
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    // Menampilkan daftar semua perangkat
    public function index()
    {
        $devices = Device::with('lab')->get(); // Ambil juga data lab terkait
        return view('devices.index', compact('devices'));
    }

    // Menampilkan form untuk membuat perangkat baru
    public function create()
    {
        $labs = Lab::all(); // Ambil semua lab untuk dropdown
        return view('devices.create', compact('labs'));
    }

    // Menyimpan perangkat baru ke database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'unique_id' => 'required|string|max:255|unique:devices,unique_id',
            'nama_perangkat' => 'required|string|max:255',
            'lab_id' => 'required|exists:labs,id',
        ]);

        Device::create($validatedData);

        return redirect()->route('devices.index')
                         ->with('success', 'Perangkat baru berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit perangkat
    public function edit(Device $device)
    {
        $labs = Lab::all(); // Ambil semua lab untuk dropdown
        return view('devices.edit', compact('device', 'labs'));
    }

    // Mengupdate perangkat yang ada di database
    public function update(Request $request, Device $device)
    {
        $validatedData = $request->validate([
            'unique_id' => 'required|string|max:255|unique:devices,unique_id,' . $device->id,
            'nama_perangkat' => 'required|string|max:255',
            'lab_id' => 'required|exists:labs,id',
        ]);

        $device->update($validatedData);

        return redirect()->route('devices.index')
                         ->with('success', 'Data perangkat berhasil diperbarui.');
    }

    // Menghapus perangkat dari database
    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('devices.index')
                         ->with('success', 'Data perangkat berhasil dihapus.');
    }
}