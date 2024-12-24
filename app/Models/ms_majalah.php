<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_majalah extends Model
{
    use HasFactory;

    protected $table = 'ms_majalah';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'cover_majalah',
        'file_majalah',
        'aktif',
    ];
}
