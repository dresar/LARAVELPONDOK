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
        Schema::create('santri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // FK ke user, nullable jika santri belum punya akun portal
            $table->string('nis')->unique()->nullable(); // Nomor Induk Santri (internal)
            $table->string('nisn')->unique()->nullable(); // Nomor Induk Siswa Nasional
            $table->string('nik')->unique()->nullable(); // Nomor Induk Kependudukan
            $table->string('nama_lengkap');
            $table->string('nama_panggilan')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'])->default('Islam');
            $table->string('kewarganegaraan')->default('WNI');
            $table->integer('anak_ke')->nullable();
            $table->integer('jumlah_saudara')->nullable();
            $table->enum('status_dalam_keluarga', ['Anak Kandung', 'Anak Angkat', 'Anak Tiri'])->nullable();
            $table->string('bahasa_sehari_hari')->nullable();

            // Informasi Alamat
            $table->text('alamat_lengkap');
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kelurahan_desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota_kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();

            // Informasi Kontak
            $table->string('telepon_rumah')->nullable();
            $table->string('hp_santri')->nullable(); // Jika santri diizinkan punya HP

            // Informasi Fisik
            $table->integer('tinggi_badan')->nullable(); // dalam cm
            $table->integer('berat_badan')->nullable(); // dalam kg
            $table->string('golongan_darah')->nullable(); // A, B, AB, O

            // Riwayat Pendidikan Sebelumnya
            $table->string('pendidikan_sebelumnya')->nullable(); // SD, SMP, SMA, dll.
            $table->string('nama_sekolah_sebelumnya')->nullable();
            $table->text('alamat_sekolah_sebelumnya')->nullable();
            $table->integer('tahun_lulus_sebelumnya')->nullable();

            // Informasi Pesantren
            $table->foreignId('tahun_masuk_id')->constrained('tahun_ajaran')->onDelete('restrict'); // FK ke tahun ajaran masuk
            $table->foreignId('program_masuk_id')->constrained('program_pendidikan')->onDelete('restrict'); // FK ke program pendidikan masuk
            $table->foreignId('tingkat_masuk_id')->constrained('tingkat_pendidikan')->onDelete('restrict'); // FK ke tingkat pendidikan masuk

            // Penempatan Saat Ini (bisa berubah, riwayat ada di riwayat_kamar_santri & riwayat_kelas_santri)
            $table->foreignId('kamar_saat_ini_id')->nullable()->constrained('ruang_kamar')->onDelete('set null'); // FK ke ruang kamar saat ini
            $table->string('nomor_kasur')->nullable(); // Detail penempatan dalam kamar
            $table->string('nomor_lemari')->nullable(); // Detail penempatan dalam kamar

            // Status Aktif Santri (status detail ada di riwayat_status_santri)
            $table->enum('status_aktif', ['Aktif', 'Non-aktif', 'Lulus', 'Pindah', 'Dikeluarkan'])->default('Aktif'); // Status ringkas saat ini

            // Foto Santri
            $table->string('foto_santri_path')->nullable(); // Path file foto

            $table->timestamps();
            $table->softDeletes(); // Untuk soft delete santri
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santri');
    }
};