<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class page_limitberita_setting extends Model
{
    use HasFactory;

    protected $table = 'page_limitberita_setting';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'limit_berita',
        'aktif',

    ];
}
