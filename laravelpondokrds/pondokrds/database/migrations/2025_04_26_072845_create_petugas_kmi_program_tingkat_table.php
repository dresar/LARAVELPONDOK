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
        Schema::create('petugas_kmi_program_tingkat', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // User dengan role petugas_kmi
            $table->foreignId('program_pendidikan_id')->constrained('program_pendidikan')->onDelete('cascade');
            $table->foreignId('tingkat_pendidikan_id')->constrained('tingkat_pendidikan')->onDelete('cascade');
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajaran')->onDelete('cascade'); // Penugasan per tahun ajaran
            $table->foreignId('semester_id')->constrained('semester')->onDelete('cascade'); // Penugasan per semester
            $table->primary(['user_id', 'program_pendidikan_id', 'tingkat_pendidikan_id', 'tahun_ajaran_id', 'semester_id'], 'petugas_kmi_program_tingkat_unique'); // Composite primary key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas_kmi_program_tingkat');
    }
};