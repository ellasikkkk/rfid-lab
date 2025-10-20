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
    Schema::create('gurus', function (Blueprint $table) {
        $table->id();
        $table->string('nama_guru')->unique();
        $table->string('nip')->nullable()->unique();
        $table->timestamps();
    });
}
};
