<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_sertifikat extends Model
{
    use HasFactory;

    protected $table = 'ms_sertifikat';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_anggota',
        'bidang',
        'sub_bidang',
        'kualifikasi',
        'tgl_penetapan',
        'masa_berlaku',
        'sesi',
    ];
}
