<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_popup extends Model
{
    use HasFactory;

    protected $table = 'ms_popup';
    protected $primaryKey = 'id';
    protected $fillable = [
        'gambar',
        'url',
        'aktif',
    ];
}
