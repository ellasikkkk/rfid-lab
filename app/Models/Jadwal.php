<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Jadwal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Kolom-kolom yang boleh diisi melalui form.
     */
    protected $fillable = [
        'hari',
        'mapel',
        'jurusan',
        'jam_ke',
        'kelas',
        'lab_id', 
        'nama_guru',
        'jam_mulai',
        'jam_selesai',
    ];

    /**
     * Accessor untuk menerjemahkan nama hari ke Bahasa Indonesia.
     * Dipanggil di view dengan {{ $jadwal->hari_indo }}
     */
    protected function hariIndo(): Attribute
    {
        return Attribute::make(
            get: function () {
                $days = [
                    'Monday'    => 'Senin',
                    'Tuesday'   => 'Selasa',
                    'Wednesday' => 'Rabu',
                    'Thursday'  => 'Kamis',
                    'Friday'    => 'Jumat',
                    'Saturday'  => 'Sabtu',
                    'Sunday'    => 'Minggu',
                ];
                return $days[$this->hari] ?? $this->hari;
            }
        );
    }

    /**
     * Relasi ke model Lab.
     * Satu Jadwal dimiliki oleh satu Lab.
     */
    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }
}