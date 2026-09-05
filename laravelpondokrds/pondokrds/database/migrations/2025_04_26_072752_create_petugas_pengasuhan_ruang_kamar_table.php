
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
        Schema::create('petugas_pengasuhan_ruang_kamar', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // User dengan role pengasuhan
            $table->foreignId('ruang_kamar_id')->constrained('ruang_kamar')->onDelete('cascade');
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajaran')->onDelete('cascade'); // Penugasan per tahun ajaran
            $table->foreignId('semester_id')->constrained('semester')->onDelete('cascade'); // Penugasan per semester
            $table->primary(['user_id', 'ruang_kamar_id', 'tahun_ajaran_id', 'semester_id'], 'petugas_ruang_kamar_unique'); // Composite primary key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas_pengasuhan_ruang_kamar');
    }
};