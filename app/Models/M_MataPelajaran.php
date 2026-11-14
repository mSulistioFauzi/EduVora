<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'nama_mata_pelajaran',
        'keterangan',
    ];

    public function keahlianRelawan()
    {
        return $this->hasMany(M_KeahlianRelawan::class);
    }

    public function programMengajar()
    {
        return $this->hasMany(M_ProgramMengajar::class);
    }
}
