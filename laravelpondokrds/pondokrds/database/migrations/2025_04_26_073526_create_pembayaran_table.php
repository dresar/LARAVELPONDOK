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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade'); // Santri yang melakukan pembayaran
            $table->foreignId('tagihan_id')->nullable()->constrained('tagihan')->onDelete('set null'); // Bisa terkait tagihan spesifik atau tidak (misal deposit)
            $table->foreignId('metode_pembayaran_id')->constrained('metode_pembayaran')->onDelete('restrict');
            $table->date('tanggal_pembayaran'); // Tanggal saat santri/wali membayar
            $table->decimal('jumlah_dibayar', 15, 2);
            $table->string('nomor_referensi')->nullable(); // Nomor transaksi bank, VA, dll
            $table->string('bukti_transfer_path')->nullable(); // Path file bukti pembayaran
            $table->enum('status', ['Menunggu Konfirmasi', 'Dikonfirmasi', 'Ditolak', 'Dibatalkan'])->default('Menunggu Konfirmasi');
            $table->text('keterangan')->nullable(); // Keterangan tambahan
            $table->foreignId('dikonfirmasi_oleh')->nullable()->constrained('users')->onDelete('set null'); // Petugas Keuangan
            $table->timestamp('tanggal_konfirmasi')->nullable();
            $table->timestamps(); // created_at: tanggal dicatat, updated_at: tanggal status berubah
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};