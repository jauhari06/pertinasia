<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_agenda extends Model
{
    use HasFactory;

    protected $table = 'ms_agenda';
    protected $primaryKey = 'id';
    protected $fillable = [
        'judul',
        'judul_en',
        'tgl_jam',
        'id_kategori',
        'deskripsi',
        'deskripsi_en',
        'file',
        'aktif',
        'tipe',
        'viewer',
        'id_menu',
        'tgl_jam_publish',
        'waktu',
        'tempat',
    ];
}
