<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_kegiatan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('program_mengajar_id')
                  ->unique()
                  ->constrained('program_mengajar')
                  ->cascadeOnDelete();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->restrictOnDelete();

            $table->unsignedInteger('jumlah_anak_hadir')->default(0);
            $table->text('materi_diajarkan');
            $table->text('hasil_kegiatan')->nullable();
            $table->text('evaluasi')->nullable();
            $table->string('foto_kegiatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_kegiatan');
    }
};
