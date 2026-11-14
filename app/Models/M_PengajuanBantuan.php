<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_PengajuanBantuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_bantuan';

    protected $fillable = [
        'profil_mitra_id',
        'judul_pengajuan',
        'deskripsi_kondisi',
        'jumlah_anak',
        'jenjang_pendidikan',
        'fasilitas_tersedia',
        'waktu_yang_diharapkan',
        'foto_pendukung',
        'status_pengajuan',
        'catatan_admin',
        'diperiksa_pada',
    ];

    protected $casts = [
        'diperiksa_pada' => 'datetime',
    ];

    public function profilMitra()
    {
        return $this->belongsTo(M_ProfilMitra::class, 'profil_mitra_id');
    }

    public function programMengajar()
    {
        return $this->hasMany(M_ProgramMengajar::class, 'pengajuan_id');
    }
}
