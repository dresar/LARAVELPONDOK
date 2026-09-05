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
        Schema::create('tingkat_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique(); // Kelas 7, Kelas 8, Marhalah Ula, Tingkat 1 Tahfidz
            $table->text('deskripsi')->nullable();
            $table->integer('level')->nullable(); // Opsional: untuk pengurutan atau logika naik kelas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tingkat_pendidikan');
    }
};