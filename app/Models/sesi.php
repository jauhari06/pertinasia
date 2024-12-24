<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class sesi extends Model
{
    use HasFactory;

    protected $table = 'sesi';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'sesi',
    ];
}
