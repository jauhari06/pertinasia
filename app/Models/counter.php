<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class counter extends Model
{
    use HasFactory;

    protected $table = 'counter';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'jml_pengunjung',
        'tgl',
    ];
}
