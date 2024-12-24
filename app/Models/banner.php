<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class banner extends Model
{
    use HasFactory;

    protected $table = 'banner';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'banner',
        'deskripsi',
        'keterangan',
        'url',
        'urut',
        'aktif',
    ];
}
