<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_berita extends Model
{
    use HasFactory;

    protected $table = 'ms_berita';
    protected $primaryKey = 'id';
    public $timestamps = false;
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
    ];

    public function kategori()
    {
        return $this->belongsTo(ms_kategoriberita::class, 'id_kategori', 'id');
    }

    public function fileberita()
    {
        return $this->hasMany(ms_fileberita::class, 'id_berita', 'id');
    }
    
}
