<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_meta extends Model
{
    use HasFactory;

    protected $table = 'ms_meta';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'teks',
        'tipe',
        'aktif',
    ];
}
