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
        Schema::create('alokasi_pembayaran_item', function (Blueprint $table) {
            $table->foreignId('pembayaran_id')->constrained('pembayaran')->onDelete('cascade');
            $table->foreignId('item_tagihan_id')->constrained('item_tagihan')->onDelete('cascade');
            $table->decimal('jumlah_dialokasikan', 15, 2);
            $table->primary(['pembayaran_id', 'item_tagihan_id'], 'alokasi_unique'); // Composite primary key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alokasi_pembayaran_item');
    }
};