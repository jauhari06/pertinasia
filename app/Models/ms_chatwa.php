<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_chatwa extends Model
{
    use HasFactory;

    protected $table = 'ms_chatwa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_chat',
        'nomer',
        'aktif',
    ];
}
