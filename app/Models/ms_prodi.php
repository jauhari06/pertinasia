<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_prodi extends Model
{
    use HasFactory;

    protected $table = 'ms_prodi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_prodi',
        'aktif',
    ];
}
