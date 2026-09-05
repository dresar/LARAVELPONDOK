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
        Schema::create('dokumen_santri_upload', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->foreignId('jenis_dokumen_upload_id')->constrained('jenis_dokumen_upload')->onDelete('restrict');
            $table->string('nama_file_original'); // Nama file saat diunggah
            $table->string('file_path'); // Path penyimpanan file
            $table->text('keterangan')->nullable();
            $table->foreignId('diunggah_oleh')->nullable()->constrained('users')->onDelete('set null'); // Santri, Wali, atau Petugas
            $table->timestamps(); // created_at: tanggal upload
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_santri_upload');
    }
};