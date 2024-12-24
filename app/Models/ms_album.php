<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_album extends Model
{
    use HasFactory;

    protected $table = 'ms_album';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_album',
        'nama_album_en',
        'aktif',
    ];

    public function foto()
    {
        return $this->hasMany(ms_foto::class, 'id_album', 'id');
    }
}
