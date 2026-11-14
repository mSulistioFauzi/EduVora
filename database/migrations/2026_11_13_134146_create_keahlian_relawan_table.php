<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keahlian_relawan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('profil_relawan_id')
                  ->constrained('profil_relawan')
                  ->cascadeOnDelete();

            $table->foreignId('mata_pelajaran_id')
                  ->constrained('mata_pelajaran')
                  ->cascadeOnDelete();

            $table->string('tingkat_keahlian')->nullable();

            $table->timestamps();

            $table->unique([
                'profil_relawan_id',
                'mata_pelajaran_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keahlian_relawan');
    }
};
