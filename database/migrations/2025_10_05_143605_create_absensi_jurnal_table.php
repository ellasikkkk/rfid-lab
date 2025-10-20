<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('absensi_jurnal', function (Blueprint $table) {
        $table->id();
        $table->foreignId('jurnal_id')->constrained('jurnals')->onDelete('cascade');
        $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
        $table->timestamp('waktu_hadir')->useCurrent();
        // Tidak perlu timestamps() di sini
    });
}
};
