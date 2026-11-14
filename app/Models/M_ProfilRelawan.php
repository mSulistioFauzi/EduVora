<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_ProfilRelawan extends Model
{
    use HasFactory;

    protected $table = 'profil_relawan';

    protected $fillable = [
        'user_id',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'pendidikan_terakhir',
        'instansi_pendidikan',
        'pengalaman_mengajar',
        'deskripsi_diri',
        'dokumen_identitas',
        'dokumen_pendidikan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keahlian()
    {
        return $this->hasMany(M_KeahlianRelawan::class, 'profil_relawan_id');
    }

    public function pendaftaran()
    {
        return $this->hasMany(M_PendaftaranRelawan::class);
    }
}
