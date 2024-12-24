<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_kategoriberita extends Model
{
    use HasFactory;

    protected $table = 'ms_kategoriberita';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_kategori',
        'nama_kategori_en',
        'tipe',
        'aktif',
    ];
}
