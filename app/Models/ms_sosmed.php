<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_sosmed extends Model
{
    use HasFactory;

    protected $table = 'ms_sosmed';
    protected $primaryKey = 'id';
    protected $fillable = [
        'icon',
        'nama_sosmed',
        'link',
        'aktif',
        'id_kategori',
    ];
}
