<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\M_MataPelajaran;

class MataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $mataPelajaran = [
            [
                'nama_mata_pelajaran' => 'Matematika',
                'keterangan' => 'Pembelajaran berhitung dan logika matematika.',
            ],
            [
                'nama_mata_pelajaran' => 'Bahasa Indonesia',
                'keterangan' => 'Pembelajaran membaca, menulis, dan berbahasa.',
            ],
            [
                'nama_mata_pelajaran' => 'Bahasa Inggris',
                'keterangan' => 'Pembelajaran dasar bahasa Inggris.',
            ],
            [
                'nama_mata_pelajaran' => 'IPA',
                'keterangan' => 'Pembelajaran ilmu pengetahuan alam.',
            ],
            [
                'nama_mata_pelajaran' => 'IPS',
                'keterangan' => 'Pembelajaran ilmu pengetahuan sosial.',
            ],
            [
                'nama_mata_pelajaran' => 'Pendidikan Pancasila',
                'keterangan' => 'Pembelajaran nilai Pancasila dan kewarganegaraan.',
            ],
            [
                'nama_mata_pelajaran' => 'Seni Budaya',
                'keterangan' => 'Pembelajaran seni dan kreativitas.',
            ],
            [
                'nama_mata_pelajaran' => 'Pendidikan Jasmani',
                'keterangan' => 'Pembelajaran olahraga dan kesehatan.',
            ],
            [
                'nama_mata_pelajaran' => 'Pendidikan Agama',
                'keterangan' => 'Pembelajaran pendidikan agama.',
            ],
        ];

        foreach ($mataPelajaran as $data) {
            M_MataPelajaran::firstOrCreate(
                ['nama_mata_pelajaran' => $data['nama_mata_pelajaran']],
                ['keterangan' => $data['keterangan']]
            );
        }
    }
}
