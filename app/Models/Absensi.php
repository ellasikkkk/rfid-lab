<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Siswa;

class Absensi extends Model
{
    protected $table = 'absensi';  // pakai tabel absensi
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'siswa_id',
        'jadwal_id',
        'jam_masuk',
        'jam_keluar',
        'jenis_absen',   // masuk atau keluar
        'is_manual',
        'status',         // Hadir, Izin, Sakit, Alpha
        'statuswaktu'
    ];

    protected $casts = [
        'is_manual' => 'boolean',
        'jam_masuk' => 'datetime:Y-m-d H:i:s',
        'jam_keluar'=> 'datetime:Y-m-d H:i:s',
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    // --- Helper Methods ---
    public function sudahAbsenMasuk(): bool
    {
        return !is_null($this->jam_masuk);
    }

    public function sudahAbsenKeluar(): bool
    {
        return !is_null($this->jam_keluar);
    }

    public function markAsManual(): void
    {
        $this->update(['is_manual' => true]);
    }

    public function markAsRfid(): void
    {
        $this->update(['is_manual' => false]);
    }

    public function isManual(): bool
    {
        return $this->is_manual === true;
    }

    public function isRfid(): bool
    {
        return $this->is_manual === false;
    }

    // Scope untuk data hari ini
    public function scopeHariIni(Builder $query): Builder
    {
        return $query->whereDate('jam_masuk', now()->toDateString())
                     ->orWhereDate('jam_keluar', now()->toDateString());
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }
}

