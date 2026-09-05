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
        // Cek apakah tabel users sudah ada sebelum mencoba membuatnya
        // Ini untuk berjaga-jaga jika Anda sudah punya migrasi users bawaan Laravel
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('set null'); // FK ke roles, nullable jika user bisa tanpa role sementara (misal: pendaftar sebelum jadi santri)
                $table->string('name'); // Nama tampilan user (misal: Nama Lengkap Santri/Guru/Wali, atau Username Petugas)
                $table->string('email')->unique(); // Email untuk login (harus unik)
                $table->timestamp('email_verified_at')->nullable(); // Untuk fitur verifikasi email jika diperlukan
                $table->string('password');
                $table->boolean('is_active')->default(true); // Status aktif akun (bisa dinonaktifkan tanpa menghapus)
                $table->rememberToken(); // Untuk fitur "Remember Me"
                $table->timestamps(); // created_at dan updated_at
            });
        } else {
             // Jika tabel users sudah ada, tambahkan kolom role_id jika belum ada
            if (!Schema::hasColumn('users', 'role_id')) {
                 Schema::table('users', function (Blueprint $table) {
                    // Add the role_id column before adding the foreign key
                    // Using unsignedBigInteger explicitly to match foreignId type
                    $table->unsignedBigInteger('role_id')->nullable()->after('id');

                    // Add the foreign key constraint
                    $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
                 });
            }
             // Jika tabel users sudah ada, tambahkan kolom is_active jika belum ada
            if (!Schema::hasColumn('users', 'is_active')) {
                 Schema::table('users', function (Blueprint $table) {
                    $table->boolean('is_active')->default(true)->after('password');
                 });
            }
             // Tambahkan kolom lain yang mungkin diperlukan jika belum ada di tabel bawaan
             // Contoh: name (jika diubah dari default Laravel), softDeletes(), dll.
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Jika tabel users sudah ada, hapus foreign key dan kolom yang ditambahkan
        if (Schema::hasTable('users')) {
             Schema::table('users', function (Blueprint $table) {
                 // Drop the foreign key first
                 if (Schema::hasColumn('users', 'role_id')) {
                    $table->dropForeign(['role_id']);
                 }
                 // Drop the columns
                 if (Schema::hasColumn('users', 'role_id')) {
                     $table->dropColumn('role_id');
                 }
                 if (Schema::hasColumn('users', 'is_active')) {
                     $table->dropColumn('is_active');
                 }
             });
             // Jika Anda ingin menghapus tabel users sepenuhnya saat rollback
             // Schema::dropIfExists('users');
        }

    }
};