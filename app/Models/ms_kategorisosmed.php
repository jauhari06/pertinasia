<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_kategorisosmed extends Model
{
    use HasFactory;

    protected $table = 'ms_kategorisosmed';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_kategori',
        'nama_kategori_en',
        'aktif',
    ];
}
