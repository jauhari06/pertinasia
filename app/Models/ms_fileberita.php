<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Codec\TimestampLastCombCodec;

class ms_fileberita extends Model
{
    use HasFactory;

    protected $table = 'ms_fileberita';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_berita',
        'nama_file',
        'file',
    ];

    public function berita()
    {
        return $this->belongsTo(ms_berita::class, 'id_berita', 'id');
    }
}
