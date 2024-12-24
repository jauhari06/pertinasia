<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_anggota extends Model
{
    use HasFactory;

    protected $table = 'ms_anggota';
    protected $primaryKey = 'id';
    protected $fillable = [
        'no_anggota',
        'nama',
        'tmp_lahir',
        'tgl_lahir',
        'alamat',
        'nik',
        'npwp',
        'status',
    ];
}
