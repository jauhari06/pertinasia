<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_online extends Model
{
    protected $table = 'user_online';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'session_id',
        'timestamp',
    ];
}
