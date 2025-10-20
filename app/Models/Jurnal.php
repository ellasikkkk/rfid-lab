<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // Relasi ke Siswa yang hadir di sesi jurnal ini
    public function siswaHadir()
    {
        return $this->belongsToMany(Siswa::class, 'absensi_jurnal', 'jurnal_id', 'siswa_id');
    }
}