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
        Schema::create('guru_mapel_kelas', function (Blueprint $table) {
            $table->id(); // Menggunakan ID auto-increment
            $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade');
            $table->foreignId('mapel_id')->constrained('mapel')->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained('semester')->onDelete('cascade');
            $table->timestamps();

            // Guru hanya mengajar 1 mapel di 1 kelas pada 1 periode hanya satu kali entri di sini
             $table->unique(['guru_id', 'mapel_id', 'kelas_id', 'tahun_ajaran_id', 'semester_id'], 'guru_mapel_kelas_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru_mapel_kelas');
    }
};