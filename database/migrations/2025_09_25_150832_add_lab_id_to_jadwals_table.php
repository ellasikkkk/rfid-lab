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
    Schema::table('jadwals', function (Blueprint $table) {
        // Kolom jurusan bisa Anda hapus atau biarkan untuk informasi tambahan
        // $table->dropColumn('jurusan'); 

        // Tambahkan foreign key ke tabel labs
        $table->foreignId('lab_id')->nullable()->constrained('labs')->after('id');
    });
}
};
