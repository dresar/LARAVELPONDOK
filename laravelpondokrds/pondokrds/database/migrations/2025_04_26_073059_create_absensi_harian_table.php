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
        Schema::create('absensi_harian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->date('tanggal');
            $table->foreignId('jenis_absensi_id')->constrained('jenis_absensi')->onDelete('restrict'); // Jangan hapus jenis absensi jika masih ada data
            $table->text('keterangan')->nullable();
            $table->foreignId('dicatat_oleh')->nullable()->constrained('users')->onDelete('set null'); // Petugas/Admin
            $table->timestamps();

            $table->unique(['santri_id', 'tanggal'], 'absensi_harian_unique_per_santri_tanggal'); // Santri hanya punya 1 absensi harian per hari
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_harian');
    }
};