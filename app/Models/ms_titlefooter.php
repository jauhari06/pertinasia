<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_titlefooter extends Model
{
    use HasFactory;

    protected $table = 'ms_titlefooter';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'teks',
        'teks_en',
        'tipe',
        'aktif',
    ];
}
