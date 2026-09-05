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
        Schema::create('catatan_kesehatan_santri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->date('tanggal_periksa');
            $table->string('keluhan')->nullable();
            $table->text('diagnosa')->nullable();
            $table->text('tindakan_pengobatan')->nullable();
            $table->string('petugas_medis')->nullable(); // Nama dokter/perawat jika ada
            $table->foreignId('dicatat_oleh')->nullable()->constrained('users')->onDelete('set null'); // Petugas Kesehatan/Pengasuhan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_kesehatan_santri');
    }
};