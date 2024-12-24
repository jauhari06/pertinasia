<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_daftarkkn extends Model
{
    use HasFactory;

    protected $table = 'ms_daftarkkn';
    protected $primaryKey = 'id';
    protected $fillable = [
        'no_pendaftar',
        'nama',
        'nim',
        'fakultas',
        'prodi',
        'angkatan',
        'kelas',
        'jenis_kelamin',
        'agama',
        'tmp_lahir',
        'tgl_lahir',
        'alamat',
        'no_tlp',
        'no_hp',
        'status',
        'ukr_jaket',
        'tgl_daftar',
    ];
}
