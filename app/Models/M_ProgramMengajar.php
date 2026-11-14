<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_ProgramMengajar extends Model
{
    use HasFactory;

    protected $table = 'program_mengajar';

    protected $fillable = [
        'pengajuan_id',
        'admin_id',
        'mata_pelajaran_id',
        'nama_program',
        'deskripsi_program',
        'lokasi',
        'jenjang_pendidikan',
        'kuota_relawan',
        'tanggal_mulai',
        'tanggal_selesai',
        'jam_mulai',
        'jam_selesai',
        'status_program',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(
            M_PengajuanBantuan::class,
            'pengajuan_id'
        );
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(M_MataPelajaran::class);
    }

    public function pendaftaran()
    {
        return $this->hasMany(M_PendaftaranRelawan::class);
    }

    public function laporan()
    {
        return $this->hasOne(M_LaporanKegiatan::class);
    }
}
