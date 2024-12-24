<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_linkkategori extends Model
{
    use HasFactory;

    protected $table = 'ms_linkkategori';
    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = [
        'nama_kategori',
        'nama_kategori_en',
        'aktif',
    ];

    public function link()
    {
        return $this->hasMany(ms_link::class, 'id_kategori', 'id');
    }
}
