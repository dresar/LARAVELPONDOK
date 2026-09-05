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
        Schema::create('item_tagihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tagihan_id')->constrained('tagihan')->onDelete('cascade');
            $table->foreignId('jenis_biaya_id')->constrained('jenis_biaya')->onDelete('restrict'); // Jangan hapus jenis biaya jika ada di item tagihan
            $table->string('deskripsi')->nullable(); // Deskripsi spesifik item (misal: Uang Makan September)
            $table->decimal('jumlah', 15, 2); // Jumlah untuk item ini
            $table->integer('qty')->default(1);
            $table->decimal('subtotal', 15, 2); // jumlah * qty
             $table->decimal('jumlah_terbayar', 15, 2)->default(0); // Jumlah yang sudah dialokasikan ke item ini
             $table->enum('status', ['Belum Lunas', 'Sebagian Lunas', 'Lunas'])->default('Belum Lunas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_tagihan');
    }
};