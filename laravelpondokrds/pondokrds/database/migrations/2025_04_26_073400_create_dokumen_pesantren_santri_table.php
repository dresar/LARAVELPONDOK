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
        Schema::create('dokumen_pesantren_santri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->foreignId('jenis_dokumen_pesantren_id')->constrained('jenis_dokumen_pesantren')->onDelete('restrict');
            $table->string('nama_dokumen'); // Nama spesifik dokumen (misal: Sertifikat Tahfidz Juz 30)
            $table->string('nomor_dokumen')->unique()->nullable(); // Nomor unik dokumen jika ada
            $table->date('tanggal_terbit')->nullable();
            $table->string('file_path'); // Path penyimpanan file dokumen
            $table->foreignId('diterbitkan_oleh')->nullable()->constrained('users')->onDelete('set null'); // Petugas/Admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_pesantren_santri');
    }
};