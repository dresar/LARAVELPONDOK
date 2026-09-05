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
        Schema::create('wali', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // FK ke user, nullable jika wali belum punya akun portal
            $table->string('nama_lengkap');
            $table->string('nik')->nullable()->unique();
            $table->enum('hubungan_dengan_santri', ['Ayah', 'Ibu', 'Wali'])->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
             $table->string('email')->nullable()->unique(); // Email wali (beda dengan email user jika punya akun)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wali');
    }
};