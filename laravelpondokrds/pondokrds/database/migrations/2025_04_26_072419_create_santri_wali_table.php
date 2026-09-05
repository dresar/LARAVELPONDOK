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
        Schema::create('santri_wali', function (Blueprint $table) {
            $table->foreignId('santri_id')->constrained('santri')->onDelete('cascade');
            $table->foreignId('wali_id')->constrained('wali')->onDelete('cascade');
            $table->primary(['santri_id', 'wali_id']); // Composite primary key
            $table->string('keterangan_hubungan')->nullable(); // Cth: Wali karena ortu meninggal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
        {
            Schema::dropIfExists('santri_wali');
        }
};
