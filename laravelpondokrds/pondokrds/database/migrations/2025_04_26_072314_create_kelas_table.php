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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajaran')->onDelete('cascade');
            $table->foreignId('program_pendidikan_id')->constrained('program_pendidikan')->onDelete('cascade');
            $table->foreignId('tingkat_pendidikan_id')->constrained('tingkat_pendidikan')->onDelete('cascade');
            $table->foreignId('wali_kelas_id')->nullable()->constrained('guru')->onDelete('set null'); // Wali kelas bisa dari guru
            $table->string('nama'); // Contoh: 7A, 10 IPA 1
            $table->enum('jenis_kelamin_santri', ['Putra', 'Putri']);
            $table->integer('kapasitas')->nullable();
            $table->timestamps();

            // Menambah unique constraint agar nama kelas unik per tahun ajaran, program, dan tingkat
            $table->unique(['tahun_ajaran_id', 'program_pendidikan_id', 'tingkat_pendidikan_id', 'nama'], 'unique_kelas_per_periode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};