<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_LaporanKegiatan extends Model
{
    use HasFactory;

    protected $table = 'laporan_kegiatan';

    protected $fillable = [
        'program_mengajar_id',
        'user_id',
        'jumlah_anak_hadir',
        'materi_diajarkan',
        'hasil_kegiatan',
        'evaluasi',
        'foto_kegiatan',
    ];

    public function programMengajar()
    {
        return $this->belongsTo(M_ProgramMengajar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
