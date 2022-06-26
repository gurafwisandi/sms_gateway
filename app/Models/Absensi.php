<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absensi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "absensi";

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru')->withTrashed();
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa')->withTrashed();
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal')->withTrashed();
    }
}
