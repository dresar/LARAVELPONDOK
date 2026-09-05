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
        Schema::create('absensi_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_kelas_id')->constrained('santri_kelas')->onDelete('cascade'); // Relasi ke penempatan santri di kelas
            $table->foreignId('jadwal_pelajaran_id')->constrained('jadwal_pelajaran')->onDelete('cascade'); // Relasi ke jadwal pelajaran
            $table->date('tanggal'); // Tanggal pelajaran berlangsung
            $table->foreignId('jenis_absensi_id')->constrained('jenis_absensi')->onDelete('restrict');
            $table->text('keterangan')->nullable();
            $table->foreignId('dicatat_oleh')->nullable()->constrained('users')->onDelete('set null'); // Guru atau Petugas
            $table->timestamps();

            // Santri_kelas hanya punya 1 status absensi per jadwal pelajaran per tanggal
            $table->unique(['santri_kelas_id', 'jadwal_pelajaran_id', 'tanggal'], 'absensi_pelajaran_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_pelajaran');
    }
};