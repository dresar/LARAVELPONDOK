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
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained('semester')->onDelete('cascade');
            $table->string('nomor_tagihan')->unique(); // Nomor tagihan unik (misal: TG-202309-S001)
            $table->string('deskripsi_tagihan')->nullable(); // Contoh: Tagihan Bulanan September 2024
            $table->date('tanggal_tagihan');
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->decimal('total_tagihan', 15, 2); // Jumlah total dari item_tagihan
            $table->decimal('sisa_tagihan', 15, 2)->default(0); // Sisa yang belum dibayar
            $table->enum('status', ['Belum Lunas', 'Sebagian Lunas', 'Lunas', 'Dibatalkan'])->default('Belum Lunas');
            $table->foreignId('dibuat_oleh')->nullable()->constrained('users')->onDelete('set null'); // Petugas Keuangan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};