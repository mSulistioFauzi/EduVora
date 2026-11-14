<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_bantuan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('profil_mitra_id')
                  ->constrained('profil_mitra')
                  ->cascadeOnDelete();

            $table->string('judul_pengajuan');
            $table->text('deskripsi_kondisi');
            $table->unsignedInteger('jumlah_anak');
            $table->string('jenjang_pendidikan')->default('SD');
            $table->text('fasilitas_tersedia')->nullable();
            $table->text('waktu_yang_diharapkan')->nullable();
            $table->string('foto_pendukung')->nullable();

            $table->enum('status_pengajuan', [
                'menunggu',
                'disetujui',
                'perlu_revisi',
                'ditolak'
            ])->default('menunggu');

            $table->text('catatan_admin')->nullable();
            $table->timestamp('diperiksa_pada')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_bantuan');
    }
};
