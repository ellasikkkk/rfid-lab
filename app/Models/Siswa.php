<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Absensi;

class Siswa extends Model
{
    protected $table = 'siswa'; 
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['uid', 'nama', 'kelas'];

    // Hapus data absensi saat siswa dihapus
    protected static function booted()
{
    static::deleting(function ($siswa) {
        // Baris ini akan otomatis menghapus semua absensi
        // yang memiliki 'siswa_id' yang sama dengan 'id' siswa ini.
        $siswa->absensi()->delete();
    });
}

    // Relasi ke semua absensi siswa
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'siswa_id', 'id');
    }

    // Relasi absensi hari ini
    public function absensiHariIni()
    {
        return $this->hasOne(Absensi::class, 'uid', 'uid')
            ->where('tanggal', now()->toDateString());
    }
}
