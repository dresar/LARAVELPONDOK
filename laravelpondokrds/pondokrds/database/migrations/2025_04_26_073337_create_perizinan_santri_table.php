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
        Schema::create('perizinan_santri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->foreignId('jenis_izin_id')->constrained('jenis_izin')->onDelete('restrict');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai'); // Tanggal harus kembali
            $table->text('tujuan')->nullable(); // Alasan izin (misal: pulang ke rumah, berobat ke kota)
            $table->text('keterangan_santri')->nullable(); // Keterangan tambahan dari santri/wali
            $table->foreignId('diajukan_oleh')->nullable()->constrained('users')->onDelete('set null'); // Santri atau Wali yang mengajukan
            $table->timestamp('tanggal_pengajuan')->useCurrent();

            $table->enum('status', ['Diajukan', 'Disetujui', 'Ditolak', 'Dibatalkan', 'Selesai', 'Terlambat Kembali'])->default('Diajukan');
            $table->text('alasan_penolakan')->nullable();
            $table->foreignId('disetujui_oleh')->nullable()->constrained('users')->onDelete('set null'); // Petugas Pengasuhan/Admin
            $table->timestamp('tanggal_persetujuan')->nullable();

            $table->date('tanggal_kembali_aktual')->nullable(); // Tanggal santri benar-benar kembali
            $table->foreignId('dicatat_kembali_oleh')->nullable()->constrained('users')->onDelete('set null'); // Petugas yang mencatat santri kembali

            $table->timestamps(); // created_at: tanggal diajukan, updated_at: tanggal status berubah
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perizinan_santri');
    }
};