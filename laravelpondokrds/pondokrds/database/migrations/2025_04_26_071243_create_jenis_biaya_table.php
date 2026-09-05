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
        Schema::create('jenis_biaya', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique(); // SPP, Uang Buku, Daftar Ulang, Iuran Kegiatan
            $table->text('deskripsi')->nullable();
            $table->decimal('default_jumlah', 15, 2)->default(0); // Opsional: jumlah default
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_biaya');
    }
};