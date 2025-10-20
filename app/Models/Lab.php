<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Kolom-kolom yang boleh diisi melalui form.
     */
    protected $fillable = [
        'nama_lab',
        'lokasi',
    ];
}