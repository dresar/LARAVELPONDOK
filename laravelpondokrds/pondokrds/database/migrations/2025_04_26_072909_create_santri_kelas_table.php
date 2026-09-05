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
        Schema::create('santri_kelas', function (Blueprint $table) {
            $table->id(); // Menggunakan ID auto-increment karena ini riwayat penempatan
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained('semester')->onDelete('cascade');
            $table->date('tanggal_masuk_kelas')->nullable(); // Tanggal mulai efektif di kelas ini
            $table->date('tanggal_keluar_kelas')->nullable(); // Tanggal selesai efektif di kelas ini
            $table->timestamps();

            // Santri hanya bisa terdaftar di satu kelas pada satu tahun ajaran dan semester yang sama
            $table->unique(['santri_id', 'tahun_ajaran_id', 'semester_id'], 'santri_kelas_unique_per_periode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santri_kelas');
    }
};