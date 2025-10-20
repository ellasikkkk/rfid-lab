<?php
namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;
use App\Models\Siswa;

class JurnalController extends Controller
{
    public function index(Request $request) // <-- Tambahkan Request $request di sini
{
    // 1. Ambil input tanggal dari URL (jika ada)
    $tanggalAwal = $request->input('tanggal_awal');
    $tanggalAkhir = $request->input('tanggal_akhir');

    // 2. Buat query dasar ke model Jurnal
    $query = Jurnal::query();

    // 3. Terapkan filter HANYA JIKA kedua tanggal diisi oleh pengguna
    if ($tanggalAwal && $tanggalAkhir) {
        // whereBetween adalah cara efisien untuk mencari data di antara dua tanggal
        $query->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
    }

    // 4. Ambil data yang sudah difilter (atau semua data jika tidak ada filter), 
    //    urutkan dari yang terbaru
    $jurnals = $query->latest()->get();

    // 5. Kirim data jurnal dan juga nilai filter kembali ke view
    //    agar form filter tetap terisi setelah halaman dimuat ulang.
    return view('jurnal.index', compact('jurnals', 'tanggalAwal', 'tanggalAkhir'));
}

    public function create()
    {
        // Ambil daftar kelas dari config
        $kelasList = config('kelas.list');
        return view('jurnal.create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'nama_guru' => 'required|string|max:255',
            'kelas' => 'required|string',
            'mata_pelajaran' => 'required|string|max:255',
            'materi' => 'required|string',
            'foto_kegiatan' => 'nullable|image|max:2048', // Validasi untuk file gambar
        ]);

        if ($request->hasFile('foto_kegiatan')) {
            $path = $request->file('foto_kegiatan')->store('public/jurnal_photos');
            $validatedData['foto_kegiatan'] = $path;
        }

        $jurnal = Jurnal::create($validatedData);

        // Redirect ke halaman absensi untuk jurnal yang baru dibuat
        return redirect()->route('jurnal.show', $jurnal->id) // Nanti kita buat halaman ini
                         ->with('success', 'Jurnal berhasil dibuat. Silakan lanjutkan dengan absensi siswa.');
    }
public function show(Jurnal $jurnal)
{
    // Ambil semua siswa yang kelasnya sesuai dengan jurnal
    $siswaDiKelas = Siswa::where('kelas', $jurnal->kelas)->orderBy('nama')->get();
    
    // Ambil ID siswa yang sudah diabsen untuk jurnal ini
    $siswaSudahHadirIds = $jurnal->siswaHadir()->pluck('siswa.id')->toArray();

    return view('jurnal.show', compact('jurnal', 'siswaDiKelas', 'siswaSudahHadirIds'));
}

public function storeAbsensi(Request $request, Jurnal $jurnal)
{
    $request->validate([
        'siswa_ids' => 'array', // Pastikan inputnya array
        'siswa_ids.*' => 'exists:siswa,id' // Pastikan setiap ID ada di tabel siswa
    ]);

    // 'sync' akan mencocokkan data absensi dengan checklist dari form
    $jurnal->siswaHadir()->sync($request->input('siswa_ids', []));

    return redirect()->route('jurnal.index')->with('success', 'Absensi untuk jurnal berhasil disimpan.');
}
    public function edit(Jurnal $jurnal)
    {
        $kelasList = config('kelas.list'); // Ambil daftar kelas
        return view('jurnal.edit', compact('jurnal', 'kelasList'));
    }

    /**
     * Mengupdate data jurnal di database.
     */
    public function update(Request $request, Jurnal $jurnal)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'nama_guru' => 'required|string|max:255',
            'kelas' => 'required|string',
            'mata_pelajaran' => 'required|string|max:255',
            'materi' => 'required|string',
            'foto_kegiatan' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto_kegiatan')) {
            // Hapus foto lama jika ada
            // Storage::delete($jurnal->foto_kegiatan);
            $path = $request->file('foto_kegiatan')->store('public/jurnal_photos');
            $validatedData['foto_kegiatan'] = $path;
        }

        $jurnal->update($validatedData);

        return redirect()->route('jurnal.index')->with('success', 'Jurnal berhasil diperbarui.');
    }

    /**
     * Menghapus data jurnal dari database.
     */
    public function destroy(Jurnal $jurnal)
    {
        // Hapus foto dari storage jika ada
        // if ($jurnal->foto_kegiatan) {
        //     Storage::delete($jurnal->foto_kegiatan);
        // }
        
        $jurnal->delete();

        return redirect()->route('jurnal.index')->with('success', 'Jurnal berhasil dihapus.');
    }
}
