<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_PendaftaranRelawan extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_relawan';

    protected $fillable = [
        'profil_relawan_id',
        'program_mengajar_id',
        'status_pendaftaran',
        'catatan_admin',
        'tanggal_keputusan',
    ];

    protected $casts = [
        'tanggal_keputusan' => 'datetime',
    ];

    public function profilRelawan()
    {
        return $this->belongsTo(M_ProfilRelawan::class);
    }

    public function programMengajar()
    {
        return $this->belongsTo(M_ProgramMengajar::class);
    }
}
