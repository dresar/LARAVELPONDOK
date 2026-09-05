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
        Schema::create('jadwal_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            // $table->foreignId('guru_mapel_kelas_id')->constrained('guru_mapel_kelas')->onDelete('cascade'); // Referensi ke penugasan guru
            // Alternatif: Langsung referensi mapel dan guru jika penugasan sudah di tabel ini
            $table->foreignId('mapel_id')->constrained('mapel')->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade');
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained('semester')->onDelete('cascade');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('ruangan')->nullable();
            $table->timestamps();

            // Unique constraint opsional: 1 kelas tidak bisa punya 2 mapel/guru di jam yang sama
            $table->unique(['kelas_id', 'hari', 'jam_mulai', 'jam_selesai', 'tahun_ajaran_id', 'semester_id'], 'jadwal_kelas_unique_per_jam');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelajaran');
    }
};