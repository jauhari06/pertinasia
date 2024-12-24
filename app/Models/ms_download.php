<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_download extends Model
{
    use HasFactory;

    protected $table = 'ms_download';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_file',
        'file',
        'aktif',
    ];
}
