<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_kehidupankampus extends Model
{
    use HasFactory;

    protected $table = 'ms_kehidupankampus';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_jurnal',
        'nama_jurnal_en',
        'file_cover',
        'link',
        'tipe',
        'aktif',
    ];
}
