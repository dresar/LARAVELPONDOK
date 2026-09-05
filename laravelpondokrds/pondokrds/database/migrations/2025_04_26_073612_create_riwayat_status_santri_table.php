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
        Schema::create('riwayat_status_santri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->enum('status', ['Aktif', 'Non-aktif', 'Lulus', 'Pindah', 'Dikeluarkan']);
            $table->date('tanggal_mulai_efektif');
            $table->date('tanggal_selesai_efektif')->nullable(); // Tanggal status ini berakhir (jika berubah lagi)
            $table->text('keterangan')->nullable(); // Alasan perubahan status
            $table->foreignId('dicatat_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_status_santri');
    }
};