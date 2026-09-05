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
        Schema::create('jenis_absensi', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique(); // Hadir, Sakit, Izin, Alpha
            $table->string('kode')->unique(); // H, S, I, A
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_absensi');
    }
};