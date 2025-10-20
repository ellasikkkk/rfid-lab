<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Kolom-kolom yang boleh diisi melalui form.
     */
    protected $fillable = [
        'unique_id',
        'nama_perangkat',
        'lab_id',
    ];

    /**
     * Mendefinisikan relasi "belongsTo" ke model Lab.
     * Artinya, satu Perangkat (Device) dimiliki oleh satu Lab.
     */
    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }
}