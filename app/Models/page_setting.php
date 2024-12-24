<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class page_setting extends Model
{
    use HasFactory;

    protected $table = 'page_setting';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ikon',
        'page_name',
    ];
}
