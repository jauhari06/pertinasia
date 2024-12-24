<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class page_permalink_setting extends Model
{
    use HasFactory;

    protected $table = 'page_permalink_setting';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tipe',
        'tipe_permalink',
        'ifcustom',
        'aktif',
    ];
}
