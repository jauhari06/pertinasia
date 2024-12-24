<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_kewirausahaan extends Model
{
    use HasFactory;

    protected $table = 'ms_kewirausahaan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'nama_jurnal_en',
        'file_cover',
        'link',
        'tipe',
        'aktif',
    ];
}
