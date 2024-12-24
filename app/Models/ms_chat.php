<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_chat extends Model
{
    use HasFactory;

    protected $table = 'ms_chat';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_operator',
        'nama_penanya',
        'email_penanya',
        'no_gerbong',
        'no_kursi',
        'tgl_jam',
        'stts',
    ];
}
