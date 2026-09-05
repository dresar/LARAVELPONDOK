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
        Schema::create('jenis_penilaian', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique(); // Harian, UTS, UAS, Praktik, Sikap
            $table->text('deskripsi')->nullable();
            $table->integer('bobot')->default(0); // Bobot dalam persentase untuk nilai akhir
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_penilaian');
    }
};