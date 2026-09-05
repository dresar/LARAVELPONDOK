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
        Schema::create('prestasi_santri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->string('nama_prestasi');
            $table->text('deskripsi')->nullable();
            $table->string('tingkat')->nullable(); // Cth: Sekolah, Kabupaten, Provinsi, Nasional, Internasional
            $table->date('tanggal_dicapai')->nullable();
            $table->foreignId('tahun_ajaran_id')->nullable()->constrained('tahun_ajaran')->onDelete('set null'); // Prestasi bisa tanpa TA/Semester spesifik
            $table->foreignId('semester_id')->nullable()->constrained('semester')->onDelete('set null');
            $table->string('dokumen_pendukung_path')->nullable(); // Path file sertifikat/piagam
            $table->foreignId('dicatat_oleh')->nullable()->constrained('users')->onDelete('set null'); // Admin/Petugas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi_santri');
    }
};