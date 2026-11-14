<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_ProfilMitra extends Model
{
    use HasFactory;

    protected $table = 'profil_mitra';

    protected $fillable = [
        'user_id',
        'nama_organisasi',
        'jabatan',
        'nomor_telepon',
        'alamat_wilayah',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'dokumen_pendukung',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pengajuanBantuan()
    {
        return $this->hasMany(M_PengajuanBantuan::class);
    }
}
