<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_kerjasama extends Model
{
    use HasFactory;

    protected $table = 'ms_kerjasama';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_jurnal',
        'file_cover',
        'link',
        'aktif',
    ];
}
