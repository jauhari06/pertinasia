<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ms_chat_detail extends Model
{
    use HasFactory;

    protected $table = 'ms_chat_detail';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_mschat',
        'dari',
        'ke',
        'message',
        'sent',
        'read_user',
        'read_operator',
        'notif',
    ];
}
