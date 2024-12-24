<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_video extends Model
{
    use HasFactory;

    protected $table = 'ms_video';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'judul',
        'judul_en',
        'link',
        'aktif',
    ];
}
