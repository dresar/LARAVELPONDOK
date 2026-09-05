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
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('konten');
            $table->timestamp('tanggal_publikasi')->useCurrent();
            $table->timestamp('tanggal_kadaluarsa')->nullable(); // Pengumuman bisa punya tanggal berakhir
            // Kolom untuk menargetkan audiens spesifik (opsional, bisa disesuaikan)
            $table->json('ditujukan_untuk_roles')->nullable(); // Simpan array role ID (misal: [1, 5, 7])
            $table->boolean('untuk_semua_pengguna')->default(true); // Jika true, tampilkan ke semua role (kecuali di override oleh ditujukan_untuk_roles)
            $table->foreignId('dibuat_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};