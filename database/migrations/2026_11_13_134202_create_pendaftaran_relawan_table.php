<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran_relawan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('profil_relawan_id')
                  ->constrained('profil_relawan')
                  ->cascadeOnDelete();

            $table->foreignId('program_mengajar_id')
                  ->constrained('program_mengajar')
                  ->cascadeOnDelete();

            $table->enum('status_pendaftaran', [
                'menunggu',
                'diterima',
                'ditolak',
                'mengundurkan_diri'
            ])->default('menunggu');

            $table->text('catatan_admin')->nullable();
            $table->timestamp('tanggal_keputusan')->nullable();

            $table->timestamps();

            $table->unique([
                'profil_relawan_id',
                'program_mengajar_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_relawan');
    }
};
