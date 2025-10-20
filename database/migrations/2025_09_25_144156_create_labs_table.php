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
    Schema::create('labs', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lab'); // Contoh: "Lab TKJ 1", "Lab Boga"
        $table->string('lokasi')->nullable();
        $table->timestamps();
    });
}
};
