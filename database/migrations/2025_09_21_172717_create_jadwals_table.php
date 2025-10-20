<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            // Menyimpan nama hari: Senin, Selasa, dst.
            $table->string('hari'); 
            // Menyimpan jam mulai lab
            $table->time('jam_mulai');
            // Menyimpan jam selesai lab
            $table->time('jam_selesai');
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};