<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Lab; // <-- PENTING: Import model Lab
use App\Models\MataPelajaran; // Import
use App\Models\Guru; // Import
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JadwalController extends Controller
{
    // Menampilkan daftar jadwal, difilter berdasarkan jurusan
    public function index(Request $request)
{
    $labs = Lab::all();
    
    // Default filter sekarang adalah 'semua', bukan lab pertama
    $labFilterId = $request->query('lab', 'semua');

    $jadwals = Jadwal::query();

    // Terapkan filter HANYA JIKA 'labFilterId' bukan 'semua'
    if ($labFilterId && $labFilterId !== 'semua') {
        $jadwals->where('lab_id', $labFilterId);
    }
    
    $jadwals = $jadwals->with('lab')->orderBy('hari')->get();
    
    return view('jadwal.index', compact('jadwals', 'labs', 'labFilterId'));
}

    // Menampilkan form untuk membuat jadwal baru
    public function create()
{
    $labs = Lab::all();
    $mataPelajarans = MataPelajaran::all(); // Ambil semua mapel
    $gurus = Guru::all(); // Ambil semua guru

    return view('jadwal.create', compact('labs', 'mataPelajarans', 'gurus'));
}


    // Menyimpan jadwal baru ke database dengan validasi tumpang tindih berdasarkan LAB
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'hari' => 'required|string',
        'mapel' => 'required|string|max:255',
        'nama_guru' => 'nullable|string|max:255',
        'kelas' => 'required|string|max:255', // <-- INI YANG HILANG
        'jam_ke' => 'nullable|string|max:50',
        'jurusan' => 'required|string|max:255',
        'lab_id' => 'required|exists:labs,id',
        'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        'jam_mulai' => [
            'required',
            'date_format:H:i',
            function ($attribute, $value, $fail) use ($request) {
                $jamMulai = $request->input('jam_mulai');
                $jamSelesai = $request->input('jam_selesai');
                $hari = $request->input('hari');
                $labId = $request->input('lab_id');

                $jadwalTumpangTindih = Jadwal::where('hari', $hari)
                    ->where('lab_id', $labId)
                    ->where('jam_mulai', '<', $jamSelesai)
                    ->where('jam_selesai', '>', $jamMulai)
                    ->exists();

                if ($jadwalTumpangTindih) {
                    $fail('Jadwal tumpang tindih dengan jadwal lain di LAB dan HARI yang sama.');
                }
            },
        ],
    ]);

    // Sekarang $validatedData sudah berisi 'kelas'
    Jadwal::create($validatedData);

    return redirect()->route('jadwal.index')->with('success', 'Jadwal baru berhasil ditambahkan.');
}

    // Menampilkan form untuk mengedit jadwal
    public function edit(Jadwal $jadwal)
{
    $labs = Lab::all();
    $mataPelajarans = MataPelajaran::all();
    $gurus = Guru::all();

    return view('jadwal.edit', compact('jadwal', 'labs', 'mataPelajarans', 'gurus'));
}

    // Mengupdate jadwal yang ada di database dengan validasi tumpang tindih berdasarkan LAB
    public function update(Request $request, Jadwal $jadwal)
    {
        $validatedData = $request->validate([
            'hari' => 'required|string',
            'mapel' => 'required|string|max:255',
            'nama_guru' => 'nullable|string|max:255',
            'jurusan' => 'required|string|max:255',
            'kelas' => 'required|string|max:255', 
            'jam_ke' => 'nullable|string|max:50',
            'lab_id' => 'required|exists:labs,id', // Pastikan lab yang dipilih valid
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'jam_mulai' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($request, $jadwal) {
                    $jamMulai = $request->input('jam_mulai');
                    $jamSelesai = $request->input('jam_selesai');
                    $hari = $request->input('hari');
                    $labId = $request->input('lab_id');

                    $jadwalTumpangTindih = Jadwal::where('hari', $hari)
                        ->where('lab_id', $labId) // <-- KUNCI UTAMA: Cek hanya di lab yang sama
                        ->where('id', '!=', $jadwal->id) // Abaikan jadwal yang sedang diedit
                        ->where(function ($query) use ($jamMulai, $jamSelesai) {
                            $query->where('jam_mulai', '<', $jamSelesai)
                                  ->where('jam_selesai', '>', $jamMulai);
                        })
                        ->exists();

                    if ($jadwalTumpangTindih) {
                        $fail('Jadwal tumpang tindih dengan jadwal lain di LAB dan HARI yang sama.');
                    }
                },
            ],
        ]);

        $jadwal->update($validatedData);

        return redirect()->route('jadwal.index', ['jurusan' => $request->jurusan])
                         ->with('success', 'Jadwal berhasil diperbarui.');
    }

    // Menghapus jadwal dari database
    public function destroy(Jadwal $jadwal)
    {
        $jurusan = $jadwal->jurusan;
        $jadwal->delete();

        return redirect()->route('jadwal.index', ['jurusan' => $jurusan])
                         ->with('success', 'Jadwal berhasil dihapus.');
    }
}