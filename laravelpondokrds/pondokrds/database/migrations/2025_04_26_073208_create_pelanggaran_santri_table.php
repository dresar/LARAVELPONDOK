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
        Schema::create('pelanggaran_santri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->foreignId('jenis_pelanggaran_id')->constrained('jenis_pelanggaran')->onDelete('restrict'); // Jangan hapus jenis pelanggaran jika ada data
            $table->date('tanggal');
            $table->text('keterangan')->nullable(); // Detail kejadian
            $table->integer('poin_sanksi')->nullable(); // Menyimpan poin saat kejadian, bisa beda jika master diubah
            $table->foreignId('dicatat_oleh')->nullable()->constrained('users')->onDelete('set null'); // Biasanya petugas pengasuhan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggaran_santri');
    }
};