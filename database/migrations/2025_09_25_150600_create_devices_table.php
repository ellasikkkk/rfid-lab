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
    Schema::create('devices', function (Blueprint $table) {
        $table->id();
        $table->string('unique_id')->unique(); // Contoh: "LAB-TKJ-01", "LAB-TKJ-02"
        $table->string('nama_perangkat'); // Contoh: "Reader Pintu Masuk Lab TKJ 1"
        $table->foreignId('lab_id')->constrained('labs'); // Menghubungkan alat ini ke satu lab
        $table->timestamps();
    });
}
};
