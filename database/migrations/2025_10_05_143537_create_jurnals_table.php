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
    Schema::create('jurnals', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal');
        $table->time('jam_mulai');
        $table->time('jam_selesai');
        $table->string('nama_guru');
        $table->string('kelas');
        $table->string('mata_pelajaran');
        $table->text('materi');
        $table->string('foto_kegiatan')->nullable(); // Kolom untuk path foto
        $table->timestamps();
    });
}
};
