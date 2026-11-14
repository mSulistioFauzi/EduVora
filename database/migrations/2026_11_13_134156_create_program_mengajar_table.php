<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_mengajar', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengajuan_id')
                  ->nullable()
                  ->constrained('pengajuan_bantuan')
                  ->nullOnDelete();

            $table->foreignId('admin_id')
                  ->constrained('users')
                  ->restrictOnDelete();

            $table->foreignId('mata_pelajaran_id')
                  ->constrained('mata_pelajaran')
                  ->restrictOnDelete();

            $table->string('nama_program');
            $table->text('deskripsi_program')->nullable();
            $table->text('lokasi');
            $table->string('jenjang_pendidikan')->default('SD');

            $table->unsignedInteger('kuota_relawan')->default(1);

            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();

            $table->enum('status_program', [
                'draf',
                'dibuka',
                'ditutup',
                'selesai',
                'dibatalkan'
            ])->default('draf');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_mengajar');
    }
};
