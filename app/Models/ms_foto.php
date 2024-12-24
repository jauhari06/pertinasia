<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_foto extends Model
{
    use HasFactory;

    protected $table = 'ms_foto';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_album',
        'foto',
        'keterangan',
        'keterangan_en',
        'aktif',
    ];

    public function album()
    {
        return $this->belongsTo(ms_album::class, 'id_album', 'id');
    }
}
