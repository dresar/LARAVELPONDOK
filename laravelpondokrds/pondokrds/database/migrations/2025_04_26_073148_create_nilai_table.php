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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_kelas_id')->constrained('santri_kelas')->onDelete('cascade'); // Relasi ke penempatan santri di kelas
            $table->foreignId('mapel_id')->constrained('mapel')->onDelete('cascade');
            $table->foreignId('jenis_penilaian_id')->constrained('jenis_penilaian')->onDelete('restrict'); // Jangan hapus jenis penilaian jika ada nilai
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained('semester')->onDelete('cascade');
            $table->decimal('nilai', 5, 2); // Nilai bisa koma, skala 0-100 atau lainnya
            $table->text('catatan_guru')->nullable();
            $table->foreignId('dicatat_oleh')->nullable()->constrained('users')->onDelete('set null'); // Biasanya guru
            $table->timestamps();

            // Santri hanya punya 1 nilai untuk 1 mapel dan 1 jenis penilaian di 1 periode kelas
            $table->unique(['santri_kelas_id', 'mapel_id', 'jenis_penilaian_id', 'tahun_ajaran_id', 'semester_id'], 'nilai_unique_per_periode_mapel_jenis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};