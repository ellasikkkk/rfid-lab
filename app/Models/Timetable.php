<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Ini adalah "daftar izin" kolom yang boleh diisi melalui form.
     * Pastikan semua nama kolom dari form Anda ada di sini.
     */
    protected $fillable = [
        'nama_mapel',
        'nama_guru',
        'kelas',
        'hari',
        'jam_ke',
        'waktu_mulai',
        'waktu_selesai',
    ];
}