<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_link extends Model
{
    use HasFactory;

    protected $table = 'ms_link';
    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = [
        'nama_link',
        'nama_link_en',
        'link',
        'tipe',
        'aktif',
        'id_kategori',
    ];

    public function kategori()
    {
        return $this->belongsTo(ms_linkkategori::class, 'id_kategori', 'id');
    }
}
