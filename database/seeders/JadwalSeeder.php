<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jadwal; // Import model Jadwal

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jadwal::create(['hari' => 'Monday', 'jam_mulai' => '08:00:00', 'jam_selesai' => '16:00:00']);
        Jadwal::create(['hari' => 'Tuesday', 'jam_mulai' => '08:00:00', 'jam_selesai' => '16:00:00']);
        Jadwal::create(['hari' => 'Wednesday', 'jam_mulai' => '08:00:00', 'jam_selesai' => '16:00:00']);
        Jadwal::create(['hari' => 'Thursday', 'jam_mulai' => '08:00:00', 'jam_selesai' => '16:00:00']);
        Jadwal::create(['hari' => 'Friday', 'jam_mulai' => '08:00:00', 'jam_selesai' => '16:00:00']);
    }
}