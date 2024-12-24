<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_pendidikan extends Model
{
    use HasFactory;

    protected $table = 'ms_pendidikan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_anggota',
        'nama_sekolah',
        'jenjang',
        'jurusan',
        'tahun_lulus',
        'no_ijazah',
        'sesi',
    ];
}
