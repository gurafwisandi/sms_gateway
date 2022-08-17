<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "jadwal";

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas')->withTrashed();
    }

    public function matpel()
    {
        return $this->belongsTo(Matpel::class, 'id_matpel')->withTrashed();
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user')->withTrashed();
    }
}
