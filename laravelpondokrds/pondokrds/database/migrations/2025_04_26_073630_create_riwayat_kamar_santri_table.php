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
        Schema::create('riwayat_kamar_santri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->foreignId('ruang_kamar_id')->constrained('ruang_kamar')->onDelete('restrict'); // Jangan hapus kamar jika ada di riwayat
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained('semester')->onDelete('cascade');
            $table->date('tanggal_masuk_kamar');
            $table->date('tanggal_keluar_kamar')->nullable(); // Jika pindah kamar atau non-aktif
            $table->string('nomor_kasur')->nullable(); // Detail penempatan saat itu
            $table->string('nomor_lemari')->nullable(); // Detail penempatan saat itu
            $table->text('keterangan')->nullable();
            $table->foreignId('dicatat_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

             // Santri hanya di satu kamar per periode
            $table->unique(['santri_id', 'tahun_ajaran_id', 'semester_id'], 'santri_kamar_unique_per_periode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_kamar_santri');
    }
};