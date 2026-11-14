<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_KeahlianRelawan extends Model
{
    use HasFactory;

    protected $table = 'keahlian_relawan';

    protected $fillable = [
        'profil_relawan_id',
        'mata_pelajaran_id',
        'tingkat_keahlian',
    ];

    public function profilRelawan()
    {
        return $this->belongsTo(M_ProfilRelawan::class);
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(M_MataPelajaran::class);
    }
}
